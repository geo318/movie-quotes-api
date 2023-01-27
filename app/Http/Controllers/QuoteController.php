<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class QuoteController extends Controller
{
	public function index()
	{
		if (!$quotes = Quote::select(['id', 'user_id', 'movie_id', 'quote_image', 'quote_title'])->paginate(3)->reverse())
		{
			return response()->json([
				'error'   => 400,
				'message' => 'something went wrong',
			]);
		}
		if (count($quotes) >= 0)
		{
			return response()->json(
				array_values($quotes->toArray()),
			);
		}
	}
}
