<?php

use App\Models\Championship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChampionshipFactory extends Factory
{
	protected $model = Championship::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'nome' => $this->faker->words(3, true),
			'data_inicio' => $this->faker->dateTimeThisYear(),
			'data_fim' => $this->faker->dateTimeThisYear('+1 week'),
		];
	}
}
