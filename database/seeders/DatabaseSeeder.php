<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call(GenreSeeder::class);
		$i = 1;
		while ($i < 20)
		{
			Quote::factory()->create();
			Like::factory(5)->create(['quote_id'=>$i]);
			Comment::factory(5)->create(['quote_id'=>$i]);
			$i++;
		}
	}
}
