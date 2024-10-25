<?php

use App\Http\Controllers\Admin\DashboardController;
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
    Route::middleware('guest')->group(function () {
        Route::view('login', 'auth.login')->name('auth.login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('auth.login');
        Route::view('register', 'auth.register')->name('auth.registerView');
        Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    });

    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('google', [AuthController::class, 'google'])->name('auth.google');
    Route::get('callback', [AuthController::class, 'callback'])->name('auth.callback');
    Route::get('verify', [AuthController::class, 'verify'])->name('auth.verify');
    Route::post('verify', [AuthController::class, 'verifyCode'])->name('auth.verify_code');

    Route::view('forgot_password', 'auth.forgot_password')->name('auth.forgot_password');
    Route::post('forgot_password', [AuthController::class, 'forgotPassword'])->name('auth.forgot_password');
    Route::get('reset_password', [AuthController::class, 'resetPassword'])->name('auth.reset_password');
    Route::post('reset_password', [AuthController::class, 'setPassword'])->name('auth.set_password');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
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
