<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class QuoteController extends Controller
{
	public function index()
	{
		if (count($quotes = Quote::paginate(3)->reverse()) === 0)
		{
			return response()->json([
				'success' => 204,
				'message' => 'no movies found',
			]);
		}
		if (count($quotes) > 0)
		{
			return response()->json([
				'success'    => 200,
				'collection' => array_values($quotes->toArray()),
			]);
		}

		return response()->json([
			'error'   => 400,
			'message' => 'something went wrong',
		]);
	}
}
