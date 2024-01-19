<?php

namespace Database\Factories;

use App\Models\ChampionshipTeam;
use App\Models\Championship;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ChampionshipTeamFactory extends Factory
{
	protected $model = ChampionshipTeam::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'campeonato_id' => Championship::factory(),
			'time_id' => Team::factory(),
			'data_inscricao' => $this->faker->dateTimeBetween('-1 month', 'now'),
			'pontos_acumulados' => $this->faker->numberBetween(0, 10),
		];
	}
}
