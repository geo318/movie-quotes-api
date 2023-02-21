<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;

class MovieController extends Controller
{
	public function getMovies()
	{
        $search = urldecode(request()->input('search'));
		return User::find(auth()->id())->movies()->where('movie_title', 'like', '%' . ltrim($search, '@') . '%')
            ->with(['quotes' => function ($query) {
			    $query->select('id', 'movie_id');
		    }])->get();
	}

	public function getMovie()
	{
		$id = urldecode(request()->input('id', ''));
		return response(Movie::where('id', $id)->with('quotes', 'genres')->first());
	}

	public function getGenres()
	{
		return response(Genre::select('id', 'name')->get());
	}

	public function create(StoreMovieRequest $request)
	{
		$movie = new Movie();
		$this->updateOrCreate($movie, $request);
		$movie['movie_image'] = '/storage/' . $request->file('movie_image')->store('movies');
		$movie['user_id'] = auth()->user()->id;
		$movie->save();
		$genres = json_decode($request['genres']);
		$movie->genres()->attach($genres);

		return response(['message'=>'Movie added']);
	}

	public function update(StoreMovieRequest $request, Movie $movie)
	{
		$this->updateOrCreate($movie, $request);
		if (isset($request['movie_image']))
		{
			$movie['movie_image'] = '/storage/' . $request->file('movie_image')->store('movies');
		}
		if ($request['genres'])
		{
			$genres = json_decode($request['genres']);
			$movie->changeGenres($genres);
		}
		$movie->update();
		return response(['message'=>'Movie updated']);
	}

	public function delete(Movie $movie)
	{
        $movie->genres()->detach();
		$movie->delete();
		return response(['message'=>'Movie deleted']);
	}

	public function updateOrCreate($movie, $request)
	{
		$translatable = [
			'movie_title'=> ['en'=>$request['movie_title_en'], 'ka'=>$request['movie_title_ka']],
			'description'=> ['en'=>$request['description_en'], 'ka'=>$request['description_ka']],
			'director'   => ['en'=>$request['director_en'], 'ka'=>$request['director_ka']],
		];
		foreach ($translatable as $key => $value)
		{
			$movie->setTranslations($key, $value);
		}
		$movie['year'] = $request['year'];
		$movie['budget'] = $request['budget'];

	}
}
