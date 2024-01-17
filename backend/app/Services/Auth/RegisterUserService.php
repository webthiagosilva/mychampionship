<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
	private UserRepository $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function execute(array $attributes): array
	{
		$password = Hash::make($attributes['password']);

		$this->userRepository->createUser([
			'name' => $attributes['name'],
			'email' => $attributes['email'],
			'password' => $password,
		]);

		$user = $this->userRepository->findUserByEmail($attributes['email']);

		$data = [
			'user' => [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
			]
		];

		return $data;
	}
}
