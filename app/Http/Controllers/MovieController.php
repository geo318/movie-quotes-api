<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;

class MovieController extends Controller
{
	public function getMovies()
	{
		return User::find(auth()->id())->movies()->with(['quotes' => function ($query) {
			$query->select('id', 'movie_id');
		}])->get();
	}

	public function getMovie()
	{
		$id = urldecode(request()->input('id', ''));
		return response(Movie::where('id', $id)->with('quotes','genres')->first());
	}
}
