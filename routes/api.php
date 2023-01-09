<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});


Route::get('lang/{lang}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');

Route::middleware('guest')->group(function () {
	Route::post('/login', [LoginController::class, 'login']);
	Route::post('/register', [RegisterController::class, 'register']);
	// Route::post('/forgot-password', [ResetPasswordController::class, 'postEmail'])->name('password.email');
	// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'postNewPassword'])->name('password.reset');
	// Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

// Route::middleware(['auth', 'verified'])->group(function () {
// 	Route::redirect('/', '/admin/world');
// 	Route::get('/admin/world', [StatsController::class, 'sum'])->name('admin.world');
// 	Route::get('/admin/country', [StatsController::class, 'getStats'])->name('admin.country');
// 	Route::post('/admin/logout', [LoginController::class, 'logout'])->nredirect(route('verification.notice'));ame('logout');
// });

Route::get('/email/verify', [RegisterController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [ConfirmEmailController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [ConfirmEmailController::class, 'resendEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Route::get('quotes', [QuoteController::class, 'index'])->name('quotes');

