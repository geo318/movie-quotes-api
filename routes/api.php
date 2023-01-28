<?php

use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);
Route::middleware('guest')->group(function () {
	Route::post('/login', [LoginController::class, 'login']);
	Route::post('/register', [RegisterController::class, 'register']);
	Route::get('/auth/redirect', [GoogleController::class, 'redirectToProvider']);
	Route::get('/auth/callback', [GoogleController::class, 'handleProviderCallback']);
	Route::post('/forgot-password', [ResetPasswordController::class, 'postEmail'])->name('password.email');
	Route::get('/reset-password/{token}', [ResetPasswordController::class, 'sendEmail'])->name('password.reset');
	Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/email/verify', [RegisterController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [ConfirmEmailController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['verified', 'auth:sanctum'])->group(function () {
	Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes');
	Route::get('/user', [LoginController::class, 'getUser'])->name('user');
	Route::post('/comment', [QuoteController::class, 'addComment'])->name('comment');
	Route::get('/like', [QuoteController::class, 'addLike'])->name('like');
});
