<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

use function PHPUnit\Framework\isEmpty;

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
            'email' => 'required|string',
            'password' => 'required|string',
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

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $userData = User::updateOrCreate(['email' => $user->email], ['is_verified' => true]);
            if (empty($userData->fullname)) {
                $userData->fullname = $user->name;
                $userData->save();
            }
            if (empty($userData->photo)) {
                $userData->photo = $user->avatar;
                $userData->save();
            }

            Auth::login($userData);
            session()->regenerate();
            return redirect()->route('auth.index');
        } catch (\Exception $error) {
            return redirect()->route('auth.login')->withErrors([
                'message' => 'Failed to login with Google',
            ]);
        }
    }
}
