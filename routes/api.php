<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ApiAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->group(function () {
    Route::get('ping', function () {
        return response()->json(['message' => 'pong']);
    })->name('ping');

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');

        Route::prefix('forgot-password')->group(function () {
            Route::post('/', 'verify');
            Route::post('verify-otp', 'verifyOtp');
            Route::post('reset-password', 'resetPassword');
        });

        Route::middleware(ApiAuth::class)->group(function () {
            Route::post('logout', 'logout');
            Route::get('profile', 'profile');
            Route::post('profile', 'updateProfile');
            Route::post('verify', 'verify');
            Route::post('verify-otp', 'verifyOtp');
        });
    });
});
