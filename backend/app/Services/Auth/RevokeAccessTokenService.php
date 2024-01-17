<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Exception;

class RevokeAccessTokenService
{
	private UserRepository $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function execute(): void
	{
		$userId = $this->userRepository->getCurrentUserId();

		if (!$userId) throw new Exception('unauthorized', Response::HTTP_UNAUTHORIZED);

		$this->userRepository->revokeTokens($userId);
	}
}
