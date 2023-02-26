<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrimaryEmailRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required|unique:users,gmail|exists:emails,email',
		];
	}
}
