<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'movie_title' => ['en'=>fake()->sentence(5, true), 'ka'=>fake()->sentence(5, true)],
			'user_id'     => User::factory(),
			'year'        => fake()->numberBetween(1930, 2023),
		];
	}
}
