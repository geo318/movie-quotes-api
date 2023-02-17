<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	public function definition()
	{
		return [
			'username'          => fake()->name(),
			'email'             => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'avatar'            => $this->faker->fakeImage('avatars', 200, 200),
			'password'          => Hash::make(123456789),
			'remember_token'    => Str::random(10),
		];
	}

	public function unverified()
	{
		return $this->state(fn (array $attributes) => [
			'email_verified_at' => null,
		]);
	}
}
