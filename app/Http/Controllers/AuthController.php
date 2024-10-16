<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user || !$user->password || !Hash::check($body['password'], $user->password)) {
            return back()->withErrors([
                'The provided credentials do not match our records.',
            ])->withInput();
        }

        Auth::login($user);
        session()->regenerate();

        return redirect()->route('auth.index');
    }

    public function register(Request $request)
    {
        $body = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $existingUser = User::where('email', $body['email'])->first();
        if ($existingUser) {
            return back()->withErrors([
                'The email has already been taken.',
            ])->withInput();
        }

        $user = User::create($body);

        Auth::login($user);
        session()->regenerate();

        return redirect()->route('auth.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index');
    }
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            if ($request->has('credential')) {
                $token = $request->get('credential');
                $client = new Client();
                $user = $client->verifyIdToken($token);
                if (!$user) {
                    return redirect()->route('auth.login')->withErrors([
                        'message' => 'Failed to login with Google',
                    ]);
                }
            } else {
                $user = Socialite::driver('google')->user();
                if (!$user) {
                    return redirect()->route('auth.login')->withErrors([
                        'message' => 'Failed to login with Google',
                    ]);
                }
                $user = $user->user;
            }

            $userData = User::where('email', $user['email'])->first();
            if (!$userData) {
                $userData = User::create([
                    'fullname' => $user['name'],
                    'email' => $user['email'],
                    'photo' => $user['picture'],
                    'is_verified' => true
                ]);
            } else if (!$userData->is_verified || !$userData->photo) {
                $userData->update([
                    'photo' => $user->avatar,
                    'is_verified' => true
                ]);
            }

            Auth::login($userData);
            session()->regenerate();
            return redirect()->route('auth.index');
        } catch (\Exception $e) {
            error_log("[Exception] " . $e->getMessage() .
                " in " . $e->getFile() .
                " on line " . $e->getLine());

            return redirect()->route('auth.login')->withErrors([
                'message' => 'Failed to login with Google',
            ]);
        }
    }
}
