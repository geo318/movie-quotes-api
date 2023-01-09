<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class ConfirmEmailController extends Controller
{
	public function verifyEmail(EmailVerificationRequest $request)
	{
		$request->fulfill();

		return response()->json([
			'success' => 200,
			'message' => 'User verified',
		]);
	}

	public function resendEmail(Request $request)
	{
		$request->user()->sendEmailVerificationNotification();

		return view('auth.verify-email');
	}
}
