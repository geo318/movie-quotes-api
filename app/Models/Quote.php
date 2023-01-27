<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	use HasFactory;

	protected $fillable = [
		'quote_title',
		'quote_image',
	];

	protected $with = ['comments', 'likes', 'user', 'movie'];

	public function user()
	{
		return $this->belongsTo(User::class)->select(['id', 'username', 'avatar']);
	}

	public function movie()
	{
		return $this->belongsTo(Movie::class)->select(['id', 'movie_title', 'movie_image', 'year']);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class)->select(['id', 'quote_id', 'user_id', 'comment']);
	}

	public function likes()
	{
		return $this->hasMany(Like::class)->select(['id', 'quote_id', 'like']);
	}
}
