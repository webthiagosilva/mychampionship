<?php

namespace App\Http\Controllers;

use App\Services\Championship\ChampionshipSimulationService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ChampionshipRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class ChampionshipsController extends Controller
{
	private ChampionshipSimulationService $championshipSimulationService;

	public function __construct(ChampionshipSimulationService $championshipSimulationService)
	{
		$this->championshipSimulationService = $championshipSimulationService;
	}

	public function simulate(ChampionshipRequest $request): JsonResponse
	{
		try {
			$data = $request->validated();
			$result = $this->championshipSimulationService->simulateChampionship($data);
		} catch (Exception $e) {
			return ResponseHelper::error($e->getMessage(), $e->getCode());
		}

		return ResponseHelper::success($result, 'Championship simulated successfully');
	}
}
