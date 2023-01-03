<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Faker\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(Generator::class, function ($app) {
			$faker = Factory::create();
			$faker->addProvider(new FakerImageProvider($faker));
			return $faker;
		});
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	}
}
