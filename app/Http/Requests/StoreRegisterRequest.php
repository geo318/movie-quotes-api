<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
	public function rules()
	{
		return [
			'username'        => 'required|min:3|max:15|unique:users,username',
			'email'           => 'required|email|unique:users,email|unique:emails,email',
			'password'        => 'required|min:8|max:15',
			'repeat_password' => 'required|same:password',
		];
	}
}
