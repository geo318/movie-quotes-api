<?php

namespace Database\Factories;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
	public function definition()
	{
		return [
			'user_id'  => User::factory(),
			'quote_id' => Quote::factory(),
			'comment'  => fake()->sentence(15),
		];
	}
}
