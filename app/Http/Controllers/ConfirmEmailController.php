<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class ConfirmEmailController extends Controller
{
	public function verifyEmail(EmailVerificationRequest $request)
	{
		$request->fulfill();
		auth()->user()->email_verified_at = Carbon::now();
		return response()->json([
			'success' => 200,
			'message' => 'User verified',
		]);
	}
}
