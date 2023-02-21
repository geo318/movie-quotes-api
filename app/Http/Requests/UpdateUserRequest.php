<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	public function rules()
	{
		return [
			'avatar'          => 'image|mimes:png,jpg,jpeg,webp',
			'username'        => 'min:3|max:15|unique:users,username|regex:/^[a-z0-9]+$/',
			'password'        => 'min:8|max:15',
			'repeat_password' => 'same:password',
		];
	}
}
