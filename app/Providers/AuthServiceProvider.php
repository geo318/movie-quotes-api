<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	public function boot()
	{
		$this->registerPolicies();

		VerifyEmail::toMailUsing(function ($notifiable, $url) {
			return (new MailMessage)
				->subject(__('main.subject'))
				->greeting(__('main.hi') . ', ' . User::find($notifiable->id)->username . '!')
				->line(__('main.button_top'))
				->action(__('main.button'), $newUrl = str_replace(config('app.url'), config('app.front_url') . '?confirm-email=', $url))
				->line($newUrl);
		});
	}
}
