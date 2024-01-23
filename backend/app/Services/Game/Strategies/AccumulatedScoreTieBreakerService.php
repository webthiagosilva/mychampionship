<?php

namespace App\Services\Game\Strategies;

use App\Repositories\TeamRepository;
use App\Interfaces\TieBreakerStrategyInterface;

class AccumulatedScoreTieBreakerService implements TieBreakerStrategyInterface
{
    private TeamRepository $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function determineWinner(array $game, int $homeScore, int $awayScore): ?int
    {
        $totalHomeScore = $this->teamRepository->calculateTeamScore($game['time_casa_id'], $game['campeonato_id']);
        $totalHomeScore += $homeScore - $awayScore;

        $totalAwayScore = $this->teamRepository->calculateTeamScore($game['time_visitante_id'], $game['campeonato_id']);
        $totalAwayScore += $awayScore - $homeScore;

        if ($totalHomeScore === $totalAwayScore) return null;

        return $totalHomeScore > $totalAwayScore
            ? $game['time_casa_id']
            : $game['time_visitante_id'];
    }
}
