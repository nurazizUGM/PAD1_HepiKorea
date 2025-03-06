<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\Admin;
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

    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('latest', 'latest');
        Route::get('popular', 'popular');
        Route::get('/', 'findAll');
        Route::get('/{id}', 'findOne');

        Route::middleware([ApiAuth::class, Admin::class])->group(function () {
            Route::post('/', 'create');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'findAll');

        Route::middleware([ApiAuth::class, Admin::class])->group(function () {
            Route::post('/', 'create');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('carousel')->controller(CarouselController::class)->group(function () {
        Route::get('/', 'findAll');

        Route::middleware([ApiAuth::class, Admin::class])->group(function () {
            Route::post('/', 'create');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });
});
