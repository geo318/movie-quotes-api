<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
	public function definition()
	{
		return [
			'user_id'     => User::factory(),
			'movie_title' => ['en'=>fake()->sentence(5, true), 'ka'=>fake()->sentence(5, true)],
			'movie_image' => $this->faker->fakeImage('quotes'),
			'year'        => fake()->numberBetween(1930, 2023),
			'director'    => ['en'=>fake()->name(), 'ka'=>fake()->name()],
			'description' => ['en'=>fake()->sentence(25, true), 'ka'=>fake()->sentence(25, true)],
			'budget'      => fake()->numberBetween(100000, 1000000),
		];
		$this->afterCreating(function ($movie, $faker) {
			$genres = Genre::inRandomOrder()
				->take(rand(1, 15))
				->get();

			$movie->genres()->attach($genres);
		});
	}
}
