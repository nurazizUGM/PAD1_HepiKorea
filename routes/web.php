<?php

use App\Http\Controllers\Admin\AnalyticController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('product')->name('product.')->controller(CustomerProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');
});

Route::post('checkout', [CustomerOrderController::class, 'checkout'])->name('checkout');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::view('login', 'auth.login')->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('login');
        Route::view('register', 'auth.register')->name('registerView');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('google', [AuthController::class, 'google'])->name('google');
    Route::get('callback', [AuthController::class, 'callback'])->name('callback');
    Route::get('verify', [AuthController::class, 'verify'])->name('verify');
    Route::post('verify', [AuthController::class, 'verifyCode'])->name('verify_code');

    Route::view('forgot_password', 'auth.forgot_password')->name('forgot_password');
    Route::post('forgot_password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
    Route::get('reset_password', [AuthController::class, 'resetPassword'])->name('reset_password');
    Route::post('reset_password', [AuthController::class, 'setPassword'])->name('set_password');

    Route::middleware('auth')->group(function () {
        Route::get('profile', [CustomerProfileController::class, 'index'])->name('profile');
        Route::patch('profile', [CustomerProfileController::class, 'update'])->name('profile');
        Route::get('notification', [CustomerProfileController::class, 'notification'])->name('notification');
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.user');
        Route::patch('profile', 'updateProfile')->name('profile.user');
        Route::get('setting', 'setting')->name('profile.setting');
    });

    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{product}', 'edit')->name('edit');
        Route::patch('update/{product}', 'update')->name('update');
        Route::delete('delete/{product}', 'destroy')->name('delete');
    });

    Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{category}', 'update')->name('update');
        Route::delete('delete/{category}', 'destroy')->name('delete');
    });

    Route::prefix('carousel')->name('carousel.')->controller(CarouselController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{carousel}', 'update')->name('update');
        Route::delete('delete/{carousel}', 'destroy')->name('delete');
    });

    Route::prefix('customer')->name('customer.')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('show/{id}', 'show')->name('show');
        Route::get('review', 'review')->name('review');
    });

    Route::prefix('faq')->name('faq.')->controller(FaqController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{faq}', 'update')->name('update');
        Route::delete('delete/{faq}', 'delete')->name('delete');
    });

    Route::prefix('analytic')->name('analytic.')->controller(AnalyticController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('confirmation/{id}', 'showConfirmation')->name('confirmation.show');
    });
});

Route::get('/view/{view}', function ($view) {
    return view($view);
});
