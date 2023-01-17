<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLangMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		if ($request->has('locale'))
		{
			app()->setLocale($request->query('locale'));
		}
		return $next($request);
	}
}
