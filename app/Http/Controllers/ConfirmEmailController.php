<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
}
