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
});

Route::get('/admin', function () {
    return 'ok';
})->middleware('admin');

Route::get('/user', function () {
    return 'ok';
})->middleware('auth');


// route hanya untuk test tampilan
Route::get('/test/login', function () {
    return view('auth.login2');
});
Route::get('/test/register', function () {
    return view('auth.register2');
});
Route::get('/test/passreset', function () {
    return view('auth.passReset');
});
Route::get('/test/changepass', function () {
    return view('auth.changePass');
});
Route::get('/test/otp', function () {
    return view('auth.otp');
});
// 