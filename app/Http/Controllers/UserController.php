<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddEmailRequest;
use App\Http\Requests\StorePrimaryEmailRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function update(UpdateUserRequest $request)
	{
		$user = User::where('id', auth()->id())->first();
		$credentials = $request->validated();
		if (isset($credentials['username']))
		{
			$user['username'] = $credentials['username'];
		}
		if (isset($credentials['password']))
		{
			$user['password'] = bcrypt($credentials['password']);
		}
		if (isset($credentials['avatar']))
		{
			$user['avatar'] = '/storage/' . $request->file('avatar')->store('avatars');
		}
		$user->update();
		return response(['message'=>'User updated']);
	}

	public function addEmail(StoreAddEmailRequest $request)
	{
		$user = User::where('id', auth()->id())->first();
		$email = Email::create([
			'user_id' => auth()->id(),
			'email'   => $newPrimaryEmail = $request['email'],
		]);
		$user->update([
			'email'     => $newPrimaryEmail,
		]);

		$user->sendEmailVerificationNotification();
		return response(['message' => "Verification email sent to {$email->email}"]);
	}

	public function setPrimaryEmail(StorePrimaryEmailRequest $request, User $user)
	{
		$user->update([
			'primary_email'     => $email = $request->email,
		]);

		return response(['message' => "{$email} set as primary"]);
	}

	public function deleteEmail(Request $request)
	{
		$user = User::where('id', auth()->id())->first();
		if ($request->email === $user->email)
		{
			$user['email'] = $user->primary_email;
			$user->update();
		}
		Email::where('email', $request->email)->delete();
	}
}
