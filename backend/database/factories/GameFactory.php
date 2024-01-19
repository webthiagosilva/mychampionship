<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Championship;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class GameFactory extends Factory
{
	protected $model = Game::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'campeonato_id' => Championship::factory(),
			'fase' => $this->faker->randomElement(['quartas', 'semifinais', 'final', 'terceiro_lugar']),
			'time_casa_id' => Team::factory(),
			'time_visitante_id' => Team::factory(),
			'placar_casa' => $this->faker->numberBetween(0, 5),
			'placar_visitante' => $this->faker->numberBetween(0, 5),
			'data_jogo' => $this->faker->dateTimeThisYear(),
		];
	}
}
