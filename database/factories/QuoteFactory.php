<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'quote_title' => fake()->sentence(10),
			'quote_image' => $this->faker->fakeImage('quotes'),
			'user_id'     => User::factory(),
			'movie_id'    => Movie::factory(),
		];
	}
}
