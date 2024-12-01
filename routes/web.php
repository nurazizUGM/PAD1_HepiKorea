<?php

use App\Http\Controllers\Admin\AdminAnalyticController;
use App\Http\Controllers\Admin\AdminCarouselController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqController;
use App\Http\Middleware\GuestMiddleware;
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
Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');
});

Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('add', 'add')->name('add');
    Route::delete('delete', 'destroy')->name('delete');
    Route::post('update', 'update')->name('update');
});

Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::view('request-order', 'customer.order.request')->name('request-order');
Route::post('request-order', [OrderController::class, 'requestOrder'])->name('request-order');

Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('show/{id}', 'show')->name('show');
    Route::get('history', 'history')->name('history');
    Route::post('/', 'store')->name('store');
    Route::post('pay-shipment', 'payShipment')->name('pay-shipment');
    Route::get('payment-status', 'checkPaymentStatus')->name('payment-status');
    Route::get('arrived/{id}', 'arrived')->name('arrived');
    Route::get('cancel/{id}', 'cancel')->name('cancel');
});

Route::get('faq', [FaqController::class, 'faq'])->name('faq');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware(GuestMiddleware::class)->group(function () {
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
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile');
        Route::get('notification', [ProfileController::class, 'notification'])->name('notification');
        Route::get('address', [ProfileController::class, 'address'])->name('address');
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.user');
        Route::patch('profile', 'updateProfile')->name('profile.user');
        Route::get('setting', 'setting')->name('profile.setting');
    });

    Route::prefix('product')->name('product.')->controller(AdminProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{product}', 'edit')->name('edit');
        Route::patch('update/{product}', 'update')->name('update');
        Route::delete('delete/{product}', 'destroy')->name('delete');
    });

    Route::prefix('category')->name('category.')->controller(AdminCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{category}', 'update')->name('update');
        Route::delete('delete/{category}', 'destroy')->name('delete');
    });

    Route::prefix('carousel')->name('carousel.')->controller(AdminCarouselController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{carousel}', 'update')->name('update');
        Route::delete('delete/{carousel}', 'destroy')->name('delete');
    });

    Route::prefix('customer')->name('customer.')->controller(AdminCustomerController::class)->group(function () {
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

    Route::prefix('analytic')->name('analytic.')->controller(AdminAnalyticController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('order')->name('order.')->controller(AdminOrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('confirmation/{id}', 'showConfirmation')->name('confirmation.show');
    });
});

Route::get('/view/{view}', function ($view) {
    return view($view);
});
