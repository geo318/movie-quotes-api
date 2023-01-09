<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function logout()
	{
		auth()->logout();
		return redirect(route('login'));
	}

	public function login(StoreLoginRequest $request)
	{
		$validated = $request->validated();
		$remember = isset($validated['remember']) ? true : false;
		$remember && array_pop($validated);

		if (!Auth::attempt($validated, ['remember_token' => $remember]))
		{
			throw ValidationException::withMessages(['username' => __('login_error')]);
		}

		session()->regenerate();
		return redirect(route('admin.world'));
	}
}
