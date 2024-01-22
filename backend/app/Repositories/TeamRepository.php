<?php

namespace App\Repositories;

use DateTime;
use Illuminate\Support\Facades\DB;

class TeamRepository
{
	public function listAllTeams(): array
	{
		return DB::connection('mysql')
			->table('times')
			->select('*')
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getTeamById(int $teamId): array
	{
		$result = DB::connection('mysql')
			->table('times')
			->select('*')
			->where('id', $teamId)
			->first();

		return (array) $result;
	}

	public function getTeamsByIds(array $teamIds): array
	{
		return DB::connection('mysql')
			->table('times')
			->select('*')
			->whereIn('id', $teamIds)
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getTeamsByChampionshipId(int $championshipId): array
	{
		return DB::connection('mysql')
			->table('campeonato_times')
			->select(
				'times.id',
				'times.nome',				
				'campeonato_times.data_inscricao',
				'campeonato_times.pontos_acumulados',
			)
			->join('times', 'times.id', '=', 'campeonato_times.time_id')
			->where('campeonato_times.campeonato_id', $championshipId)
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getTeamsByRegistrationOrder(int $championshipId, array $teamIds): array
	{
		return DB::connection('mysql')
			->table('campeonato_times')
			->select('*')
			->where('campeonato_id', $championshipId)
			->whereIn('time_id', $teamIds)
			->orderBy('data_inscricao', 'asc')
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function calculateTeamScore(int $teamId, int $championshipId): int
	{
		$result = DB::connection('mysql')
			->table('jogos')
			->selectRaw('
				SUM(CASE 
					WHEN time_casa_id = ? THEN placar_casa - placar_visitante
					WHEN time_visitante_id = ? THEN placar_visitante - placar_casa
					ELSE 0
				END) AS score', [$teamId, $teamId])
			->where('campeonato_id', $championshipId)
			->where(function ($query) use ($teamId) {
				$query->where('time_casa_id', $teamId)
					->orWhere('time_visitante_id', $teamId);
			})
			->first();

		return (int) ($result->score ?? 0);
	}

	public function getAccumulatedChampionshipPoints(int $championshipId, int $teamId): array
	{
		$result = DB::connection('mysql')
			->table('campeonato_times')
			->select('pontos_acumulados')
			->where('campeonato_id', $championshipId)
			->where('time_id', $teamId)
			->first();

		return (array) $result;
	}

	public function updateAccumulatedChampionshipPoints(int $championshipId, int $teamId, int $accumulatedPoints): bool
	{
		return DB::connection('mysql')
			->table('campeonato_times')
			->where('campeonato_id', $championshipId)
			->where('time_id', $teamId)
			->update([
				'pontos_acumulados' => $accumulatedPoints,
				'updated_at' => new DateTime(),
			]);
	}
}
