<?php

namespace App\Services\Championship;

use App\Repositories\ChampionshipRepository;
use App\Interfaces\ChampionshipInterface;
use Exception;

class ChampionshipSimulationService implements ChampionshipInterface
{
	private ChampionshipRepository $championshipRepository;
	private ChampionshipProgressionService $championshipProgressionService;

	public function __construct(
		ChampionshipRepository $championshipRepository,
		ChampionshipProgressionService $championshipProgressionService,
	) {
		$this->championshipRepository = $championshipRepository;
		$this->championshipProgressionService = $championshipProgressionService;
	}

	public function simulateChampionship(array $data): array
	{
		$teamIds = array_column($data['teams'], 'id');

		if (count($teamIds) !== self::DEFAULT_TEAMS_PER_CHAMPIONSHIP) {
			throw new Exception('Invalid number of teams');
		}

		$championshipId = $this->championshipRepository->createChampionship($teamIds);

		$this->championshipProgressionService->progressChampionship($championshipId);

		$simulationResult = $this->championshipRepository->getChampionshipDetails($championshipId);

		return $simulationResult;
	}
}
