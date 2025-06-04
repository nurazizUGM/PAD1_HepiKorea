<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Http\Middleware\ApiAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\RequestOrderController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\AnalyticsController;

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

    // File route
    Route::get('file', function (Request $request) {
        $path = $request->query('path');
        if (!$path || !Storage::exists($path)) {
            return response()->json(['message' => 'File not found'], 404);
        } else if (config('filesystems.default') === 's3') {
            return redirect(Storage::temporaryUrl($path, now()->addMinutes(5)));
        } else {
            return response()->file(Storage::path($path));
        }
    });

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

    Route::prefix('cart')->middleware(ApiAuth::class)->controller(CartController::class)->group(function () {
        Route::get('/', 'findAll');
        Route::post('/', 'add');
        Route::delete('/', 'delete');
        Route::post('/{id}', 'update');
        Route::post('synchronize', 'synchronize');
    });

    Route::prefix('faq')->controller(FaqController::class)->group(function () {
        Route::get('/', 'findAll');

        Route::middleware([ApiAuth::class, Admin::class])->group(function () {
            Route::post('/', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('customer')->middleware([ApiAuth::class, Admin::class])->controller(CustomerController::class)->group(function () {
        Route::get('/', 'findAll');
        Route::get('/review', 'review');
        Route::get('/{id}', 'show');
    });

    Route::middleware(ApiAuth::class)->prefix('order')->controller(OrderController::class)->group(function () {
        Route::get('/', 'history');
        Route::post('/calculate', 'calculateItems');
        Route::post('/', 'checkout');

        Route::get('/payment/{id}', 'paymentStatus');
        Route::post('/{id}/cancel', 'cancel');
        Route::post('/{id}/pay-shipment', 'payShipment');
        Route::post('/{id}/arrived', 'arrived');
        Route::post('/{id}/review', 'review');
        Route::get('/{id}', 'show');
    });

    Route::middleware([ApiAuth::class, Admin::class])->prefix('/admin')->group(function () {
        Route::get('statistics', [AdminDashboardController::class, 'index']);
        Route::prefix('order')->controller(AdminOrderController::class)->group(function () {
            Route::get('/', 'orders');
            Route::post('/{id}/process', 'process');
            Route::post('/{id}/shipment-invoice', 'createShipmentInvoice');
            Route::post('/{id}/shipment', 'send');
        });

        Route::prefix('analytics')->controller(AnalyticsController::class)->group(function () {
            Route::get('/', 'overview');
            Route::get('/export', 'export');
        });
    });

    Route::prefix('request-order')->controller(RequestOrderController::class)->group(function () {
        Route::get('/', 'show');
        Route::post('/calculate', 'calculateItems');
        Route::post('/', 'requestOrder');
        Route::post('/checkout', 'checkout');
    });

    Route::middleware(ApiAuth::class)->prefix('address')->controller(AddressController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::post('/{id}', 'update');
        Route::post('/{id}/set-default', 'setDefault');
        Route::delete('/{id}', 'destroy');
    });
});
