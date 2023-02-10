<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasFactory;

	protected $with = ['user'];

	protected $fillable = [
		'comment',
		'user_id',
		'quote_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class)->select(['id', 'avatar', 'username']);
	}

	public function quote()
	{
		return $this->belongsTo(Quote::class)->select(['id', 'quote_image', 'quote_title']);
	}
}
