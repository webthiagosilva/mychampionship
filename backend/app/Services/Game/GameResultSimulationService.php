<?php

namespace App\Services\Game;

use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
use App\Services\Game\Strategies\AccumulatedScoreTieBreakerService;
use App\Services\Game\Strategies\AwayGameTieBreakerService;
use App\Services\Game\Strategies\RegistrationOrderTieBreakerService;
use Illuminate\Support\Facades\Process;
use Illuminate\Process\Exceptions\ProcessFailedException;
use DateTime;
use Exception;

class GameResultSimulationService
{
	private GameRepository $gameRepository;
	private TeamRepository $teamRepository;

	private $tieBreakerStrategys = [];

	public function __construct(
		GameRepository $gameRepository,
		TeamRepository $teamRepository,
	) {
		$this->gameRepository = $gameRepository;
		$this->teamRepository = $teamRepository;

		$this->tieBreakerStrategys[] = new AccumulatedScoreTieBreakerService($this->teamRepository);
		$this->tieBreakerStrategys[] = new RegistrationOrderTieBreakerService($this->teamRepository);
		$this->tieBreakerStrategys[] = new AwayGameTieBreakerService($this->gameRepository);
	}

	public function simulateResult(array $game): void
	{
		[$homeScore, $awayScore] = $this->simulateGameScore();
		$winnerId = null;

		if ($homeScore == $awayScore) {
			foreach ($this->tieBreakerStrategys as $strategy) {
				$winnerId = $strategy->determineWinner($game, $homeScore, $awayScore);
				if ($winnerId !== null) break;
			}
		} else {
			$winnerId = $homeScore > $awayScore
				? $game['time_casa_id']
				: $game['time_visitante_id'];
		}

		if ($winnerId === null) throw new Exception('Could not determine winner');

		$updateData['vencedor_id'] = $winnerId;
		$updateData['placar_casa'] = $homeScore;
		$updateData['placar_visitante'] = $awayScore;
		$updateData['data_jogo'] = new DateTime();

		$this->gameRepository->updateGameResult($game['id'], $updateData);
		$this->updateAccumulatedPoints($game, $homeScore, $awayScore);
	}

	private function simulateGameScore(): array
	{
		$scriptPath = base_path('teste.py');

		$result = Process::run("python3 $scriptPath");

		if ($result->failed()) throw new ProcessFailedException($result);

		$output = $result->output();

		[$homeScore, $awayScore] = explode(';', $output);

		return [(int) $homeScore, (int) $awayScore];
	}

	private function updateAccumulatedPoints(array $game, int $homeScore, int $awayScore): void
	{
		$homeTeam = $this->teamRepository->getAccumulatedChampionshipPoints($game['campeonato_id'], $game['time_casa_id']);
		$awayTeam = $this->teamRepository->getAccumulatedChampionshipPoints($game['campeonato_id'], $game['time_visitante_id']);

		$homeTeamAccumulatedPoints = $homeTeam['pontos_acumulados'] + $homeScore - $awayScore;
		$awayTeamAccumulatedPoints = $awayTeam['pontos_acumulados'] + $awayScore - $homeScore;

		$this->teamRepository->updateAccumulatedChampionshipPoints(
			$game['campeonato_id'],
			$game['time_casa_id'],
			$homeTeamAccumulatedPoints
		);

		$this->teamRepository->updateAccumulatedChampionshipPoints(
			$game['campeonato_id'],
			$game['time_visitante_id'],
			$awayTeamAccumulatedPoints
		);
	}
}
