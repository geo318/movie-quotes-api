<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function getUser(Request $request)
	{
		info($request->headers);
		if (!auth([])->user())
		{
			return response(['user'=>null]);
		}
		return response(['user' => auth()->user()]);
	}

	public function login(Request $request)
	{
		if (!auth()->attempt($request->only('email', 'password')))
		{
			return response(['message' => 'Invalid Credentials'], 401);
		}
		request()->session()->regenerate();
		return response(['user' => auth()->user()]);
	}

	public function logout()
	{
		auth()->logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();
		return response(['message' => 'Logged out']);
	}

	public function checkAuth()
	{
		return response([
			'status' => '200',
			'message'=> 'authenticated',
		]);
	}
}
