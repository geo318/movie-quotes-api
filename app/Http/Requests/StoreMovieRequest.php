<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
	public function rules()
	{
		$required = request()->isMethod('post') ? 'required|' : '';
		return
		 [
		 	'movie_title_ka' => "{$required}min:3|max:250",
		 	'movie_title_en' => "{$required}min:3|max:250",
		 	'director_ka'    => "{$required}min:3|max:250",
		 	'director_en'    => "{$required}min:3|max:250",
		 	'description_ka' => "{$required}min:10|max:5000",
		 	'description_en' => "{$required}min:10|max:5000",
		 	'year'           => "{$required}max_digits:1895|max_digits:2023",
		 	'budget'         => "{$required}max_digits:1000|max_digits:1000000000",
		 	'movie_image'    => "{$required}image",
		 ];
	}
}
