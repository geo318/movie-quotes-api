<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	public function register(StoreRegisterRequest $request)
	{
		$validated = $request->validated();
		$validated['password'] = bcrypt($validated['password']);
		array_pop($validated);

		event(new Registered($user = User::create($validated)));

		Auth::login($user);
		return response()->json([
			'success' => 200,
		]);
	}

	public function verifyEmail()
	{
		return response()->json([
			'success' => 200,
			'message' => 'email verification sent',
		]);
	}
}
