<?php


namespace App\Services\Championship;

use App\Enums\ChampionshipStages;
use App\Repositories\ChampionshipRepository;
use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
use App\Services\Game\GameResultSimulationService;
use DateTime;

class ChampionshipProgressionService
{
	private GameRepository $gameRepository;
	private TeamRepository $teamRepository;
	private ChampionshipRepository $championshipRepository;
	private GameResultSimulationService $gameResultSimulationService;

	public function __construct(
		GameRepository $gameRepository,
		TeamRepository $teamRepository,
		ChampionshipRepository $championshipRepository,
		GameResultSimulationService $gameResultSimulationService
	) {
		$this->gameRepository = $gameRepository;
		$this->teamRepository = $teamRepository;
		$this->championshipRepository = $championshipRepository;
		$this->gameResultSimulationService = $gameResultSimulationService;
	}

	public function progressChampionship(int $championshipId): void
	{
		$this->championshipRepository->updateChampionship($championshipId, ['data_inicio' => new DateTime()]);

		foreach (ChampionshipStages::cases() as $stage) {
			$this->setupMatchesForStage($championshipId, $stage);

			$stageGames = $this->gameRepository->getGamesByChampionshipIdAndStage($championshipId, $stage);

			foreach ($stageGames as $game) {
				$this->gameResultSimulationService->simulateResult($game);
			}

			if ($stage == ChampionshipStages::FINAL) {
				$this->updateChampionshipWinner($championshipId);
			}
		}
	}	

	private function createRandomMatches(int $championshipId, array $teams, ChampionshipStages $stage): void
	{
		shuffle($teams);

		$games = [];
		for ($i = 0; $i < count($teams); $i += 2) {
			$games[] = [
				'campeonato_id' => $championshipId,
				'fase' => $stage->value,
				'time_casa_id' => $teams[$i]['id'],
				'time_visitante_id' => $teams[$i + 1]['id'],
				'created_at' => new DateTime(),
				'updated_at' => new DateTime(),
			];
		}

		$this->gameRepository->createGames($games);
	}

	private function updateChampionshipWinner(int $championshipId): void
	{
		$winners = $this->gameRepository->getWinnersOfStage($championshipId, ChampionshipStages::FINAL);
		$winnerId = $winners[0]['vencedor_id'];

		$this->championshipRepository->updateChampionship($championshipId, [
			'time_vencedor_id' => $winnerId,
			'data_fim' => new DateTime(),
		]);
	}

	private function setupMatchesForStage(int $championshipId, ChampionshipStages $stage): void
	{
		if ($stage == ChampionshipStages::QUARTER_FINALS) {
			$this->setupQuarterFinals($championshipId);
		} elseif ($stage == ChampionshipStages::SEMI_FINALS) {
			$this->setupSemiFinals($championshipId);
		} elseif ($stage == ChampionshipStages::THIRD_PLACE) {
			$this->setupThirdPlace($championshipId);
		} elseif ($stage == ChampionshipStages::FINAL) {
			$this->setupFinal($championshipId);
		}
	}

	private function setupQuarterFinals(int $championshipId): void
	{
		$teams = $this->teamRepository->getTeamsByChampionshipId($championshipId);
		$this->createRandomMatches($championshipId, $teams, ChampionshipStages::QUARTER_FINALS);
	}

	private function setupSemiFinals(int $championshipId): void
	{
		$teams = $this->gameRepository->getWinnersOfStage($championshipId, ChampionshipStages::QUARTER_FINALS);
		$this->createRandomMatches($championshipId, $teams, ChampionshipStages::SEMI_FINALS);
	}

	private function setupThirdPlace(int $championshipId): void
	{
		$teams = $this->gameRepository->getLosersOfStage($championshipId, ChampionshipStages::SEMI_FINALS);
		$this->createRandomMatches($championshipId, $teams, ChampionshipStages::THIRD_PLACE);
	}

	private function setupFinal(int $championshipId): void
	{
		$teams = $this->gameRepository->getWinnersOfStage($championshipId, ChampionshipStages::SEMI_FINALS);
		$this->createRandomMatches($championshipId, $teams, ChampionshipStages::FINAL);
	}
}
