<?php

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
	// $user = User::where('id', 229)->first();
	// if ($request->email === $user->email)
	// {
	// 	$user['email'] = $user->primary_email;
	// 	$user->update();
	// }
	// Email::where('email', $request->email)->delete();
});
