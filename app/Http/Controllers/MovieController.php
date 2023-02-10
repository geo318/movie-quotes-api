<?php

namespace App\Http\Controllers;

class MovieController extends Controller
{
	public function getMovies()
	{
		return auth()->user()->movies;
	}
}
