<?php

namespace App\Http\Controllers;

use App\Services\Team\TeamService;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class TeamsController extends Controller
{
	private TeamService $teamService;

	public function __construct(TeamService $teamService)
	{
		$this->teamService = $teamService;
	}

	public function index(Request $request): JsonResponse
	{
		try {
			$data = $this->teamService->listAllTeams();
		} catch (Exception $e) {
			return ResponseHelper::error($e->getMessage(), $e->getCode());
		}

		return ResponseHelper::success($data, 'Teams listed successfully');
	}

	public function show(Request $request, int $id): JsonResponse
	{
		try {
			$data = $this->teamService->showTeamById($id);
		} catch (Exception $e) {
			return ResponseHelper::error($e->getMessage(), $e->getCode());
		}

		return ResponseHelper::success($data, 'Team retrieved successfully');
	}
}
