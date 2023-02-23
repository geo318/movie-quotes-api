<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory;

	use HasTranslations;

	public $translatable = ['movie_title', 'description', 'director'];

	protected $fillable = [
		'user_id',
		'movie_title',
		'year',
		'movie_image',
		'description',
		'director',
		'budget',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function save(array $options = [])
	{
		$this->attributes['movie_title'] = json_encode($this->translations['movie_title'], JSON_UNESCAPED_UNICODE);
		return parent::save($options);
	}

	public function genres()
	{
		return $this->belongsToMany(Genre::class, 'genre_movie');
	}

	public function changeGenres($genres)
	{
		$existingGenres = $this->genres()->pluck('id')->toArray();  
		$newGenres = array_diff($genres, $existingGenres);
		$this->genres()->attach($newGenres);
		$removedGenres = array_diff($existingGenres, $genres);
		$this->genres()->detach($removedGenres);
	}
}
