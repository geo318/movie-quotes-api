<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\StorePasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
	public function postEmail(StoreEmailRequest $request)
	{
		$request->validated();
		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
			? response()->json(['success' => 200])
			: response()->json(['error' => __($status)]);
	}

	public function postNewPassword($token)
	{
		return view('auth.reset-password', ['token' => $token]);
	}

	public function resetPassword(StorePasswordRequest $request)
	{
		$request->validated();

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) {
				$user->update(['password' => Hash::make($password)]);
				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
			? view('auth.reset-login')
			: back()->withErrors(['email' => [__($status)]]);
	}
}
