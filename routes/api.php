<?php

use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::post('/register', [RegisterController::class, 'register']);
	Route::post('/forgot-password', [ResetPasswordController::class, 'postEmail'])->name('password.email'); //ვიღებთ პოსტ რექვესტს ვუბრუნებთ იმეილს
	Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update'); //ვიღებთ ფასვირდს
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/email/verify', [RegisterController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [ConfirmEmailController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
// Route::get('/user', [LoginController::class, 'getUser']);

Route::middleware('auth:sanctum')->group(function () {
	Route::get('/user', [LoginController::class, 'getUser']);
});
