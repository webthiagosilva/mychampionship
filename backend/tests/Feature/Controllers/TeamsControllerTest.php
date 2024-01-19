<?php

namespace Tests\Feature;

use Database\Factories\TeamFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TeamsControllerTest extends TestCase
{
	use WithoutMiddleware;

	public function testMustBeAbleToListTeamsSuccessfully()
	{
		TeamFactory::new()->count(2)->create();

		$response = $this->getJson('/api/v1/teams');

		$response->assertStatus(200)
			->assertJsonStructure([
				'status',
				'message',
				'data' => [
					[
						'id',
						'nome',
						'created_at',
						'updated_at'
					],
					[
						'id',
						'nome',
						'created_at',
						'updated_at'
					]
				]
			]);
	}

	public function testMustBeAbleToShowTeamSuccessfully()
	{
		$team = TeamFactory::new()->create();

		$response = $this->getJson("/api/v1/teams/{$team->id}");

		$response->assertStatus(200)
			->assertJsonStructure([
				'status',
				'message',
				'data' => [
					'id',
					'nome',
					'created_at',
					'updated_at'
				]
			]);
	}
}
