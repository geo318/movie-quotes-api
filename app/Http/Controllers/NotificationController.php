<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
	public function getNotifications()
	{
		return response(
			array_values(
				auth()->user()->notifications->reverse()->take(10)->toArray()
			)
		);
	}

	public function markAllAsRead()
	{
		$notifications = auth()->user()->notifications->reverse()
			->take((int) implode(request()->only('num')));

		foreach ($notifications as $notification)
		{
			$notification->update(['read' => true]);
		}

		return response(['message'=> 'all read']);
	}

	public function markAsRead()
	{
		auth()->user()->notifications->find(request()->only('id'))->first()->update(['read' => true]);

		return response(['message'=>'marked as read']);
	}
}
