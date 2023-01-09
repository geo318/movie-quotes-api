<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class ConfirmEmailController extends Controller
{
	public function verifyEmail(EmailVerificationRequest $request)
	{
		$request->fulfill();

		return	redirect(config('app.front_url') . '/403', )
		->with('message', json_encode([
			'success' => 'successfully verified!',
			'data'    => $request,
		]));
	}

	public function resendEmail(Request $request)
	{
		$request->user()->sendEmailVerificationNotification();

		return view('auth.verify-email');
	}
}
