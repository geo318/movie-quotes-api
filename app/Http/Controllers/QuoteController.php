<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Support\Facades\DB;

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
		if (!$comment = Comment::create($request->only('user_id', 'quote_id', 'comment')))
		{
			return response(['error' => "Couldn't create a comment"]);
		}

		$this->dispatchNotification($request, $comment->id, null);

		return response(['message' => 'Comment created']);
	}

	public function toggleLike()
	{
		$like = Like::firstOrNew($request = request()->only('user_id', 'quote_id', 'like'));

		if ($like->exists)
		{
			$like->delete();
			return response(['message' => 'like removed']);
		}

		$like->save();

		$this->dispatchNotification($request, null, $like->id);

		return response(['message' => 'like added']);
	}

	public function dispatchNotification($request, $commentId, $likeId)
	{
		$user = Quote::find($request['quote_id'])->user;

		$notification = Notification::firstOrNew([
			'destination_user_id' => $user->id,
			'quote_id'            => $request['quote_id'],
			'like_id'             => $likeId,
			'comment_id'          => $commentId,
		]);

		$notification->save();

		NewNotification::dispatch($notification);
	}

	public function getNotifications()
	{
		// Notification::where('destination_user_id', auth()->user->id);
		$data = DB::table('comments')
			->select('quote_id', 'user_id', 'comment', 'created_at')
			->union(
				DB::table('likes')
				->select('quote_id', 'user_id', 'like', 'created_at')
			)
			->get();

		return response()->json($data);
	}
}
