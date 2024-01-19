<?php

namespace App\Services\Team;

use App\Repositories\TeamRepository;

class TeamService
{
	private TeamRepository $teamRepository;

	public function __construct(TeamRepository $teamRepository)
	{
		$this->teamRepository = $teamRepository;
	}

	public function listAllTeams(): array
	{
		$data = $this->teamRepository->listAllTeams();

		return $data;
	}

	public function showTeamById(int $teamId): array
	{
		$data = $this->teamRepository->getTeamById($teamId);

		return $data;
	}
}
