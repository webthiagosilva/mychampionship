<?php


namespace App\Services\Game\Strategies;

use App\Interfaces\TieBreakerStrategyInterface;
use App\Repositories\GameRepository;

class AwayGameTieBreakerService implements TieBreakerStrategyInterface
{
	private GameRepository $gameRepository;

	public function __construct(GameRepository $gameRepository)
	{
		$this->gameRepository = $gameRepository;
	}

	public function determineWinner(array $game, int $homeScore, int $awayScore): ?int
	{
		$awayWinsHomeTeam = $this->gameRepository->countAwayWins($game['time_casa_id'], $game['campeonato_id']);
		$awayWinsAwayTeam = $this->gameRepository->countAwayWins($game['time_visitante_id'], $game['campeonato_id']);

		if ($awayWinsHomeTeam === $awayWinsAwayTeam) return null;

		return $awayWinsHomeTeam > $awayWinsAwayTeam
			? $game['time_casa_id']
			: $game['time_visitante_id'];
	}
}
