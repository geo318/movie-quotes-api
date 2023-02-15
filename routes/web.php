<?php

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// foreach(Movie::all() as $movie){
    //     $genres = Genre::inRandomOrder()->take(rand(1,3))->pluck('id');
    //     $movie->genres()->attach($genres);
    // }
});
