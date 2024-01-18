<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Exception;

class GenerateAccessTokenService
{
	private UserRepository $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function execute(array $credentials): array
	{
		$user = $this->userRepository->findUserByEmail($credentials['email']);

		if (!$user || !Hash::check($credentials['password'], $user->password)) {
			throw new Exception('Invalid credentials', Response::HTTP_UNAUTHORIZED);
		}

		$token = $user->createToken('auth_token')->plainTextToken;

		$data = [
			'access_token' => $token,
			'token_type' => 'Bearer',
			'user' => [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
			]
		];

		return $data;
	}
}
