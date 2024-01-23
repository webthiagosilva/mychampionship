<?php

namespace App\Repositories;

use DateTime;
use Illuminate\Support\Facades\DB;

class ChampionshipRepository
{
	const DEFAULT_ITEMS_PER_PAGE = 3;

	public function getChampionshipById(int $championshipId): ?array
	{
		$championship = DB::connection('mysql')
			->table('campeonatos')
			->select('*')
			->where('id', $championshipId)
			->first();

		return (array) $championship;
	}

	public function getChampionshipSimulationDetails(int $championshipId): array
	{
		$championship = DB::connection('mysql')
			->table('campeonatos')
			->select('id', 'data_inicio', 'data_fim', 'time_vencedor_id')
			->where('id', $championshipId)
			->first();

		$teams =  DB::connection('mysql')
			->table('campeonato_times')
			->select(
				'times.id',
				'times.nome',
				'campeonato_times.data_inscricao',
				'campeonato_times.pontos_acumulados'
			)
			->join('times', 'times.id', '=', 'campeonato_times.time_id')
			->where('campeonato_times.campeonato_id', $championshipId)
			->get();

		$games =  DB::connection('mysql')
			->table('jogos')
			->join('times as time_casa', 'jogos.time_casa_id', '=', 'time_casa.id')
			->join('times as time_visitante', 'jogos.time_visitante_id', '=', 'time_visitante.id')
			->leftJoin('times as time_vencedor', 'jogos.vencedor_id', '=', 'time_vencedor.id')
			->select(
				'time_casa.id as time_casa_id',
				'time_casa.nome as nome_time_casa',
				'jogos.placar_casa',
				'time_visitante.id as time_visitante_id',
				'time_visitante.nome as nome_time_visitante',
				'jogos.placar_visitante',
				'jogos.fase',
				'jogos.data_jogo',
				'jogos.vencedor_id as time_vencedor_id',
				'time_vencedor.nome as nome_time_vencedor'
			)
			->where('jogos.campeonato_id', $championshipId)
			->get()
			->groupBy('fase');

		$result = [
			'campeonato' => $championship,
			'times' => $teams,
			'jogos' => $games
		];

		return $result;
	}

	public function createChampionship(array $teamIds): int
	{
		$championshipId = DB::connection('mysql')
			->table('campeonatos')
			->insertGetId([
				'created_at' => new DateTime(),
				'updated_at' => new DateTime(),
			]);

		$this->attachTeams($championshipId, $teamIds);

		return $championshipId;
	}

	public function attachTeams(int $championshipId, array $teamIds): bool
	{
		$pivotData = array_map(function ($teamId) use ($championshipId) {
			return [
				'campeonato_id' => $championshipId,
				'time_id' => $teamId,
				'data_inscricao' => new DateTime(),
				'created_at' => new DateTime(),
				'updated_at' => new DateTime(),
			];
		}, $teamIds);

		return DB::connection('mysql')
			->table('campeonato_times')
			->insert($pivotData);
	}

	public function updateChampionship(int $championshipId, array $updateData): int
	{
		return DB::connection('mysql')
			->table('campeonatos')
			->where('id', $championshipId)
			->update($updateData);
	}

	public function getChampionshipHistoryDetails(int $page): array
	{
		$championships = DB::connection('mysql')
			->table('campeonatos')
			->select(
				'campeonatos.id',
				'campeonatos.data_inicio',
				'campeonatos.data_fim',
				'time_vencedor.nome as nome_time_vencedor'
			)
			->join('times as time_vencedor', 'campeonatos.time_vencedor_id', '=', 'time_vencedor.id')
			->orderBy('campeonatos.data_inicio', 'desc')
			->paginate(self::DEFAULT_ITEMS_PER_PAGE, ['*'], 'page', $page);

		foreach ($championships as $championship) {
			$championship->jogos = DB::table('jogos')
				->join('times as time_casa', 'jogos.time_casa_id', '=', 'time_casa.id')
				->join('times as time_visitante', 'jogos.time_visitante_id', '=', 'time_visitante.id')
				->leftJoin('times as time_vencedor', 'jogos.vencedor_id', '=', 'time_vencedor.id')
				->select(
					'time_casa.nome as nome_time_casa',
					'jogos.placar_casa',
					'time_visitante.nome as nome_time_visitante',
					'jogos.placar_visitante',
					'jogos.fase',
					'time_vencedor.nome as nome_time_vencedor'
				)
				->where('jogos.campeonato_id', $championship->id)
				->orderBy('jogos.fase')
				->get();
		}

		return $championships->toArray();
	}
}
