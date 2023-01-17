<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
	use Queueable;

	public $token;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		$url = config('app.front_url') . '?reset-password=' . $this->token . '?email=' . $notifiable->email;
		return (new MailMessage())
			->subject(__('main.subject_reset'))
			->greeting(__('main.hi') . ', ' . User::find($notifiable->id)->username . '!')
			->line(__('main.button_top'))
			->action(__('main.button'), $url)
			->line($url);
	}
}
