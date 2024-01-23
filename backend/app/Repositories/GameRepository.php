<?php

namespace App\Repositories;

use App\Enums\ChampionshipStages;
use Illuminate\Support\Facades\DB;

class GameRepository
{
	public function createGames(array $games): bool
	{
		return DB::connection('mysql')
			->table('jogos')
			->insert($games);
	}

	public function updateGameResult(int $gameId, array $game): bool
	{
		return DB::connection('mysql')
			->table('jogos')
			->where('id', $gameId)
			->update($game);
	}

	public function getGamesByChampionshipId(int $championshipId): array
	{
		return DB::connection('mysql')
			->table('jogos')
			->select('*')
			->where('campeonato_id', $championshipId)
			->orderBy('fase', 'asc')
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getGamesByChampionshipIdAndStage(int $championshipId, ChampionshipStages $stage): array
	{
		return DB::connection('mysql')
			->table('jogos')
			->where('campeonato_id', $championshipId)
			->where('fase', $stage->value)
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getLosersOfStage(int $championshipId, ChampionshipStages $stage): array
	{
		$homeLosers = DB::connection('mysql')
			->table('jogos')
			->join('times', 'times.id', '=', 'jogos.time_casa_id')
			->where('jogos.campeonato_id', $championshipId)
			->where('jogos.fase', $stage->value)
			->whereColumn('jogos.vencedor_id', '!=', 'jogos.time_casa_id')
			->select('*')
			->distinct();

		$awayLosers = DB::connection('mysql')
			->table('jogos')
			->join('times', 'times.id', '=', 'jogos.time_visitante_id')
			->where('jogos.campeonato_id', $championshipId)
			->where('jogos.fase', $stage->value)
			->whereColumn('jogos.vencedor_id', '!=', 'jogos.time_visitante_id')
			->select('*')
			->distinct();

		return $homeLosers->union($awayLosers)
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function getWinnersOfStage(int $championshipId, ChampionshipStages $stage): array
	{
		return DB::connection('mysql')
			->table('jogos')
			->select('*')
			->join('times', 'times.id', '=', 'jogos.vencedor_id')
			->where('campeonato_id', $championshipId)
			->where('fase', $stage->value)
			->get()
			->map(fn ($item) => (array) $item)
			->toArray();
	}

	public function countAwayWins(int $teamId, int $championshipId): int
	{
		return DB::table('jogos')
			->where('campeonato_id', $championshipId)
			->where('time_visitante_id', $teamId)
			->where('vencedor_id', $teamId)
			->count();
	}
}
