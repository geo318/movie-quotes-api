<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
	public function rules()
	{
		$required = request()->isMethod('post') ? true : false;
		return $required ?
		 [
		 	'movie_id'       => 'required|exists:movies,id',
		 	'quote_title_ka' => 'required|unique:quotes,quote_title|min:3|max:250',
		 	'quote_title_en' => 'required|unique:quotes,quote_title|min:3|max:250',
		 	'quote_image'    => 'required|image',
		 ] :
		 [
		 	'quote_title_ka' => 'min:3|max:250',
		 	'quote_title_en' => 'min:3|max:250',
		 	'quote_image'    => 'image',
		 ];
	}
}
