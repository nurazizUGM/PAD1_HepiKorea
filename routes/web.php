<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function () {
    Route::view('login', 'auth.login')->name('auth.loginView');
    Route::post('login', [AuthController::class, 'authenticate'])->name('auth.login');
    Route::view('register', 'auth.register')->name('auth.registerView');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    Route::view('/', 'auth.index')->name('auth.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('google', [AuthController::class, 'google'])->name('auth.google');
    Route::get('callback', [AuthController::class, 'callback'])->name('auth.callback');
    Route::get('verify', [AuthController::class, 'verify'])->name('auth.verify');
    Route::post('verify', [AuthController::class, 'verify_code'])->name('auth.verify_code');

    Route::view('reset_password', 'auth.reset_password')->name('auth.reset_password');
    Route::post('reset_password', [AuthController::class, 'reset_password'])->name('auth.set_password');
});

Route::get('/admin', function () {
    return 'ok';
})->middleware('admin');

Route::get('/user', function () {
    return 'ok';
})->middleware('auth');

Route::get('/view/{view}', function ($view) {
    return view($view);
});
