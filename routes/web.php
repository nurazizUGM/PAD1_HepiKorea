<?php

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
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


Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function (HttpRequest $request) {
    try {
        $user = Socialite::driver('google')->user();
        // $token = $user->token;
        // $user = Socialite::driver('github')->userFromToken($token);

        $userData = User::updateOrCreate(['email' => $user->email], ['fullname' => $user->name, 'photo' => $user->avatar, 'is_verified' => true]);
        dump($userData);
    } catch (\Exception $error) {
        // $request->get('error') == 'access_denied'
        if ($error instanceof InvalidStateException) {
            dump('Authentication failed');
        } else {
            dump($error);
        }
    }
});
