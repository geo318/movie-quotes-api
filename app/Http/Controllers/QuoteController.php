<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Throwable;

class QuoteController extends Controller
{
	public function index()
	{
		try
		{
			if (!count($quotes = Quote::paginate(3)->reverse()))
			{
				return response()->json([
					'success' => 204,
					'message' => 'no movies found',
				]);
			}
			return response()->json([
				'success'    => 200,
				'collection' => array_values($quotes->toArray()),
			]);
		}
		catch(Throwable $e)
		{
			report($e);
			return response()->json([
				'error'   => 400,
				'message' => 'something went wrong',
			]);
		}
	}
}
