<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
{
	public function rules()
	{
		return [
			'token'           => 'required',
			'email'           => 'required|email',
			'password'        => 'required|min:8|max:15',
			'repeat_password' => 'required|same:password',
		];
	}
}
