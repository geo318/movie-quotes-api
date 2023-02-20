<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class ConfirmEmailController extends Controller
{
	public function verifyEmail(EmailVerificationRequest $request)
	{
		$user = User::where('id', auth()->id())->first();
		$email = Email::where('email', $user->email)->first();

		if (!$user->email_verified_at)
		{
			$request->fulfill();
			return response()->json(['message' => 'User verified']);
		}

		$email['email_verified_at'] = Carbon::now();
		$email->save();
		$user['primary_email'] = $user->email;
		$user->save();
		return response(['message' => "Set primary email - {$email}"]);
	}
}
