<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory;

	use HasTranslations;

	public $translatable = ['movie_title'];

	protected $fillable = [
		'user_id',
		'movie_title',
		'year',
		'movie_image',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function quotes()
	{
		return $this->hasMany(Quote::class)->latest();
	}

	public function movies()
	{
		return $this->hasMany(Movie::class)->latest();
	}
}
