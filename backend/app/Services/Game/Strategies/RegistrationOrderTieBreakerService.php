<?php

namespace App\Services\Game\Strategies;

use App\Repositories\TeamRepository;
use App\Interfaces\TieBreakerStrategyInterface;

class RegistrationOrderTieBreakerService implements TieBreakerStrategyInterface
{
	private TeamRepository $teamRepository;

	public function __construct(TeamRepository $teamRepository)
	{
		$this->teamRepository = $teamRepository;
	}

	public function determineWinner(array $game, int $homeScore, int $awayScore): ?int
	{
		$registeredTeams = $this->teamRepository->getTeamsByRegistrationOrder(
			$game['campeonato_id'],
			[
				$game['time_casa_id'],
				$game['time_visitante_id']
			]
		);		

		if ($registeredTeams[0]['data_inscricao'] === $registeredTeams[1]['data_inscricao']) return null;

		return $registeredTeams[0]['data_inscricao'] < $registeredTeams[1]['data_inscricao']
			? $registeredTeams[0]['time_id']
			: $registeredTeams[1]['time_id'];
	}
}
