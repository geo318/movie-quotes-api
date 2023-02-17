<?php

namespace Database\Factories;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
	public function definition()
	{
		return [
			'user_id'  => User::factory(),
			'quote_id' => Quote::factory(),
			'like'     => 1,
		];
	}
}
