<?php

namespace App\Repositories;

use DateTime;
use Illuminate\Support\Facades\DB;

class ChampionshipRepository
{
	public function getChampionshipById(int $championshipId): ?array
	{
		$championship = DB::connection('mysql')
			->table('campeonatos')
			->select('*')
			->where('id', $championshipId)
			->first();

		return (array) $championship;
	}

	public function getChampionshipDetails(int $championshipId): array
	{
		$championship = DB::connection('mysql')
			->table('campeonatos')
			->where('id', $championshipId)
			->first();

		$teams =  DB::connection('mysql')
			->table('campeonato_times')
			->join('times', 'times.id', '=', 'campeonato_times.time_id')
			->where('campeonato_times.campeonato_id', $championshipId)
			->get();

		$games =  DB::connection('mysql')
			->table('jogos')
			->join('times as time_casa', 'jogos.time_casa_id', '=', 'time_casa.id')
			->join('times as time_visitante', 'jogos.time_visitante_id', '=', 'time_visitante.id')
			->leftJoin('times as time_vencedor', 'jogos.vencedor_id', '=', 'time_vencedor.id')
			->select('jogos.*', 'time_casa.nome as nome_time_casa', 'time_visitante.nome as nome_time_visitante', 'time_vencedor.nome as nome_time_vencedor')
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
}
