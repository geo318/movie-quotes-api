<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$i = 1;
		while ($i < 35)
		{
			Quote::factory()->create();
			Like::factory(20)->create(['quote_id'=>$i]);
			Comment::factory(5)->create(['quote_id'=>$i]);
            $i++;
		}
	}
}
