<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TeamRepository
{
	public function listAllTeams(): array
	{
		return DB::connection('mysql')
			->table('times')
			->select(
				'id',
				'nome',
				'created_at',
				'updated_at',
			)
			->get()
			->toArray();
	}

	public function getTeamById(int $teamId): array
	{
		$result = DB::connection('mysql')
			->table('times')
			->select(
				'id',
				'nome',
				'created_at',
				'updated_at',
			)
			->where('id', $teamId)
			->first();

		return (array) $result;
	}
}
