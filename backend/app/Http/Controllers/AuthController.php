<?php

namespace App\Http\Controllers;

use App\Services\Auth\RegisterUserService;
use App\Services\Auth\GenerateAccessTokenService;
use App\Services\Auth\RevokeAccessTokenService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\TokenRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class AuthController extends Controller
{
	private RegisterUserService $registerUserService;
	private GenerateAccessTokenService $generateAccessTokenService;
	private RevokeAccessTokenService $revokeAccessTokenService;

	public function __construct(
		RegisterUserService $registerUserService,
		GenerateAccessTokenService $generateAccessTokenService,
		RevokeAccessTokenService $revokeAccessTokenService
	) {
		$this->registerUserService = $registerUserService;
		$this->generateAccessTokenService = $generateAccessTokenService;
		$this->revokeAccessTokenService = $revokeAccessTokenService;
	}

	public function registerNewUser(RegisterRequest $request): JsonResponse
	{
		try {
			$attributes = $request->validated();
			$data = $this->registerUserService->execute($attributes);
		} catch (Exception $e) {
			return ResponseHelper::error($e->getMessage(), $e->getCode());
		}

		return ResponseHelper::success($data, 'User registered successfully', Response::HTTP_CREATED);
	}

	public function generateAccessToken(TokenRequest $request): JsonResponse
	{
		try {
			$attributes = $request->validated();
			$data = $this->generateAccessTokenService->execute($attributes);
		} catch (Exception $e) {
			return ResponseHelper::error($e->getMessage(), $e->getCode());
		}

		return ResponseHelper::success($data, 'Token generated successfully');
	}

	public function revokeAccessToken(): JsonResponse
	{
		try {
			$this->revokeAccessTokenService->execute();
		} catch (Exception $e) {			
			return ResponseHelper::error($e->getMessage(), $e->getCode());			
		}

		return ResponseHelper::success(null, 'Token revoked successfully', Response::HTTP_NO_CONTENT);
	}
}
