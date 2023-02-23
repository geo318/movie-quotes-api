<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddEmailRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required|unique:users,email|unique:users,gmail|unique:emails,email',
		];
	}
}
