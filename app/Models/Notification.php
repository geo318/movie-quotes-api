<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $with = ['user', 'comment'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comment()
	{
		return $this->belongsTo(Comment::class, 'comment_id', 'id');
	}
}
