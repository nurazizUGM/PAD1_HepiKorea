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
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RequestOrderController;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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

/**
 * Testing Inertia
 * open /inertia/{Folder}/{View} to see the view page in /resources/js/Pages/{Folder}/{View}
 */
Route::get('/inertia/{path}', function ($path) {
    $path = str_replace('.vue', '', $path);
    return Inertia::render($path);
})->where('path', '.*');

Route::inertia('/tutorial', 'Customer/Tutorial')->name('tutorial');

Route::inertia('/notifications', 'Customer/Notifications')->name('notifications');

Route::inertia('/', 'Customer/Home')->name('home');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware(GuestMiddleware::class)->group(function () {
        Route::inertia('login', 'Auth/Login')->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('login');

        Route::inertia('register', 'Auth/Register')->name('register');
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
        Route::inertia('profile', 'Customer/User/Profile')->name('profile');
        Route::inertia('address', 'Customer/User/Address')->name('address');
    });
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::inertia('/', 'Customer/Product/Index')->name('index');
    Route::get('/{product}', function ($id) {
        return Inertia::render('Customer/Product/Show', ['id' => $id]);
    })->name('show');
});

Route::inertia('cart', 'Customer/Cart')->name('cart.index')->middleware('auth');
Route::inertia('checkout', 'Customer/Order/Checkout')->name('checkout')->middleware('auth');

Route::prefix('request-order')->group(function () {
    Route::inertia('/', 'Customer/Order/Request')->name('request-order');
    Route::inertia('confirmed', 'Customer/Order/Custom')->name('confirmed');
});

Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
    Route::post('/', 'store')->name('store');
    Route::get('show/{id}', 'show')->name('show');

    // Route::post('pay-shipment', 'payShipment')->name('pay-shipment');
    // Route::get('payment-status', 'checkPaymentStatus')->name('payment-status');
    // Route::get('arrived/{id}', 'arrived')->name('arrived');
    // Route::get('cancel/{id}', 'cancel')->name('cancel');
    // Route::post('review', 'review')->name('review');

    Route::redirect('/', '/order/unpaid')->name('index');
    Route::get('{status}', function ($status) {
        if (!in_array($status, ['unpaid', 'processed', 'sent', 'finished', 'canceled'])) {
            return Inertia::location('/order/unpaid');
        }
        return Inertia::render('Customer/Order/History', ['status' => $status]);
    })->name('history');
})->middleware('auth');

Route::inertia('/faq', 'Customer/Faq')->name('faq');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::inertia('/', 'Admin/Dashboard')->name('dashboard');
    Route::inertia('profile', 'Admin/Profile')->name('profile');
    Route::inertia('business', 'Admin/Business')->name('business');
    Route::inertia('product', 'Admin/Product/Index')->name('product.index');

    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('setting', 'setting')->name('profile.setting');
    });

    Route::prefix('customer')->name('customer.')->controller(AdminCustomerController::class)->group(function () {
        Route::inertia('/', 'Admin/Customer/Index')->name('index');
        Route::get('/{id}', function ($id) {
            return Inertia::render('Admin/Customer/Profile', ['id' => $id]);
        })->name('show');
    });

    Route::inertia('faq', 'Admin/Faq')->name('faq');
    Route::inertia('analytics', 'Admin/Analytics')->name('analytics');

    Route::prefix('order')->name('order.')->group(function () {
        Route::inertia('/', 'Admin/Order/Index')->name('index');
        Route::get('{id}', function ($id) {
            return Inertia::render('Admin/Order/Order-detail', ['id' => $id]);
        })->name('show');
        Route::get('confirmation/{id}', function ($id) {
            return Inertia::render('Admin/Order/Confirmation-detail', ['orderId' => $id]);
        })->name('confirmation');
    });
});

Route::get('/view/{view}', function ($view) {
    return view($view);
});

// Route::get('/storage/{path}', function ($path) {
//     if (Storage::exists($path)) {
//         return Response::file(Storage::path($path));
//     } else if (file_exists(public_path($path))) {
//         return Response::file(public_path($path));
//     }
// })->with('path', '.*')->name('storage');
