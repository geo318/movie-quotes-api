<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $fillable = [
		'username',
		'avatar',
		'email',
		'password',
		'gmail',
		'email_verified_at',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $with = ['emails'];

	public function emails()
	{
		return $this->hasMany(Email::class);
	}

	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification(route('password.reset', $token)));
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function movies()
	{
		return $this->hasMany(Movie::class);
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'destination_user_id');
	}

	public function verifyEmailNotification($user, $newEmail)
	{
		$email = $this->emails()->where('email', $newEmail)->first();
		$user->update(['email'=>$newEmail]);
		$user->sendEmailVerificationNotification();
		$email->update(['email_verified_at' => 'toVerify']);
	}
}
