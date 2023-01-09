<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
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
		return (new MailMessage())
			->subject(__('main.recover_your_password'))
			->greeting(__('main.recover_password') . ', ' . $notifiable . '!')
			->line(__('main.recover_password_sub'))
			->action(__('main.recover_password'), $this->token . '?email=' . $notifiable->email)
			->salutation('');
	}
}
