<?php

use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

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
	Route::get('/like', [QuoteController::class, 'toggleLike'])->name('like');
	Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications');
	Route::get('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-read');
	Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
	Route::get('/movies', [MovieController::class, 'getMovies'])->name('movies');
	Route::post('/add-quote', [QuoteController::class, 'create'])->name('new-quote');
});
