<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class FakerImageProvider extends base
{
	public function fakeImage(string $dir = '', int $width = 2000, int $height = 1000): string
	{
		$name = $dir . '/' . Str::random(length:6) . '.jpg';
		Storage::put($name, file_get_contents(filename:"https://loremflickr.com/$width/$height"));
		return '/storage/' . $name;
	}
}
