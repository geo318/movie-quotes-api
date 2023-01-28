<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
	public function rules()
	{
		return [
			'comment'  => 'required|min:1|max:512',
			'user_id'  => 'required|exists:users,id',
			'quote_id' => 'required|exists:quotes,id',
		];
	}
}
