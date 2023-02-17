<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{

	public function definition()
	{
		return [
			'quote_title' => ['en'=>fake()->sentence(5), 'ka'=>fake()->sentence(5)],
			'quote_image' => $this->faker->fakeImage('quotes'),
			'user_id'     => User::factory(),
			'movie_id'    => Movie::factory(),
		];
	}
}
