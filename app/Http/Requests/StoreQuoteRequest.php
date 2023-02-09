<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'movie_id'       => 'required|exists:movies,id',
			'quote_title_ka' => 'required|unique:quotes,quote_title|min:3|max:250',
			'quote_title_en' => 'required|unique:quotes,quote_title|min:3|max:250',
			'quote_image'    => 'required',
		];
	}
}
