<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
	public function run()
	{
		$genres = [
			['en' => 'Action', 'ka' => 'ექშენი'],
			['en' => 'Adventure', 'ka' => 'სათავგადასავლო'],
			['en' => 'Animation', 'ka' => 'ანიმაციური'],
			['en' => 'Anime', 'ka' => 'ანიმე'],
			['en' => 'Biography', 'ka' => 'ბიოგრაფია'],
			['en' => 'Comedy', 'ka' => 'კომედია'],
			['en' => 'Crime', 'ka' => 'კრიმინალური'],
			['en' => 'Documentary', 'ka' => 'დოკუმენტური'],
			['en' => 'Drama', 'ka' => 'დრამა'],
			['en' => 'Family', 'ka' => 'საოჯახო'],
			['en' => 'Fantasy', 'ka' => 'ფანტასტიკა'],
			['en' => 'History', 'ka' => 'ისტორიული'],
			['en' => 'Horror', 'ka' => 'საშინელებათა'],
			['en' => 'Musical', 'ka' => 'მუსიკალური'],
			['en' => 'Mystery', 'ka' => 'მისტიკა'],
			['en' => 'Romance', 'ka' => 'რომანტიკული'],
			['en' => 'Sci-Fi', 'ka' => 'სამეცნიერო ფანტასტიკა'],
			['en' => 'Thriller', 'ka' => 'ტრილერი'],
			['en' => 'Sport', 'ka' => 'სპორტული'],
			['en' => 'War', 'ka' => 'საბრძოლო'],
			['en' => 'Western', 'ka' => 'ვესტერნი'],
		];

		foreach ($genres as $genre)
		{
			Genre::firstOrCreate([
				'name' => $genre,
			]);
		}
	}
}
