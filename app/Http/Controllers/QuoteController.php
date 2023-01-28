<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Quote;

class QuoteController extends Controller
{
	public function index()
	{
		if (!$quotes = Quote::select(['id', 'user_id', 'movie_id', 'quote_image', 'quote_title'])
			->orderBy('id', 'desc')
			->paginate(3))
		{
			return response()->json([
				'error'   => 400,
				'message' => 'something went wrong',
			]);
		}

		if (count($quotes) >= 0)
		{
			return response()->json($quotes);
		}
	}

	public function addComment(StoreCommentRequest $request)
	{
		if (!Comment::create($request->only('user_id', 'quote_id', 'comment')))
		{
			return response([
				'status' => 400,
				'error'  => "Couldn't create a comment",
			]);
		}

		return response([
			'status' => 200,
			'message'=> 'Comment created',
		]);
	}

	public function addLike()
	{
		$like = Like::firstOrNew(request()->only('user_id', 'quote_id', 'like'));

		if ($like->exists)
		{
			$like->delete();
			return response(['message' => 'like removed']);
		}

		$like->save();
		return response(['message' => 'like added']);
	}
}
