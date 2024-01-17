<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
	public function createUser(array $attributes): int
	{
		return DB::connection('mysql')
			->table('users')
			->insert($attributes);
	}

	public function findUserById(int $id): ?User
	{
		return User::query()
			->where('id', $id)
			->first();
	}

	public function findUserByEmail(string $email): ?User
	{
		return User::query()
			->where('email', $email)
			->first();
	}

	public function getCurrentUserId(): ?int
	{
		return Auth::id();
	}

	public function revokeTokens(int $userId): int
	{
		return DB::connection('mysql')
			->table('personal_access_tokens')
			->where('tokenable_id', $userId)
			->delete();
	}
}
