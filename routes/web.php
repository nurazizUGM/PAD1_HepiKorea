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
Route::get('/inertia/{folder}/{view}', function ($folder, $view) {
    return Inertia::render("{$folder}/{$view}");
});

Route::get('/inertia/{folder}/{subfolder}/{view}', function ($folder, $subfolder, $view) {
    return Inertia::render("{$folder}/{$subfolder}/{$view}");
});
// Route::get('/inertia/{folder}/{subfolder}/{view}/{id}', function ($folder, $subfolder, $view, $id) {
//     return Inertia::render("{$folder}/{$subfolder}/{$view}/{$id}");
// });

Route::get('/inertia/{folder}/{subfolder}/{subsubfolder}/{view}', function ($folder, $subfolder, $subsubfolder, $view) {
    return Inertia::render("{$folder}/{$subfolder}/{$subsubfolder}/{$view}");
});

// Route::get('/inertia/{folder}/{subfolder}/{subsubfolder}/{view}/{id}', function ($folder, $subfolder, $subsubfolder, $view, $id) {
//     return Inertia::render("{$folder}/{$subfolder}/{$subsubfolder}/{$view}/{$id}");
// });


Route::get('/Customer/Product/Show/{id}', function ($id) {
    return Inertia::render('Customer/Product/Show', ['id' => $id]);
});

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
        // Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile');
        Route::get('notification', [ProfileController::class, 'notification'])->name('notification');
        Route::get('address', [ProfileController::class, 'address'])->name('address');
    });
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::inertia('/', 'Customer/Product/Index')->name('index');
    Route::get('/{product}', function ($id) {
        return Inertia::render('Customer/Product/Show', ['id' => $id]);
    })->name('show');
});

Route::inertia('cart', 'Customer/Cart')->name('cart.index')->middleware('auth');
// Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::post('add', 'add')->name('add');
//     Route::delete('delete', 'destroy')->name('delete');
//     Route::post('update', 'update')->name('update');
// });

Route::inertia('checkout', 'Customer/Order/Checkout')->name('checkout')->middleware('auth');
// Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('auth');

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
// Route::get('faq', [FaqController::class, 'faq'])->name('faq');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/', 'Admin/Dashboard')->name('dashboard');
    Route::inertia('profile', 'Admin/Profile')->name('profile');
    
    Route::controller(AdminProfileController::class)->group(function () {

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

    Route::inertia('faq', 'Admin/Faq')->name('faq');
    // Route::prefix('faq')->name('faq.')->controller(FaqController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::post('store', 'store')->name('store');
    //     Route::patch('update/{faq}', 'update')->name('update');
    //     Route::delete('delete/{faq}', 'delete')->name('delete');
    // });

    Route::prefix('analytic')->name('analytic.')->controller(AdminAnalyticController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('order')->name('order.')->controller(AdminOrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('confirmation/{id}', 'showConfirmation')->name('confirmation.show');
        Route::get('show/{id}', 'show')->name('show');
        Route::post('process/{id}', 'process')->name('process');
        Route::post('sent/{id}', 'sent')->name('sent');
        Route::post('send/{id}', 'send')->name('send');
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
