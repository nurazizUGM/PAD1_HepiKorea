<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Models\Otp;
use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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
    public function verify(Request $request)
    {
        if ($request->get('email')) {
            $user = User::where('email', $request->get('email'))->first();
        } else {
            $user = Auth::user();
        }

        $otp = Otp::where('user_id', $user->id)->first();
        if (!$otp || $otp->expired_at < now()) {
            $otp_code = rand(100000, 999999);
            $otp = Otp::updateOrCreate([
                'user_id' => $user->id
            ], [
                'code' => $otp_code,
                'expired_at' => now()->addMinutes(5)
            ]);
            Mail::to($user->email)->send(new Verification($otp_code));
        }

        dump($otp->code);
        return view('auth.otp', [
            'timeout' => $otp->expired_at->getTimestamp() - now()->getTimestamp(),
            'type' => $request->get('email') ? 'reset' : 'verify',
            'email' => $user->email
        ]);
    }
    public function verify_code(Request $request)
    {
        $body = $request->validate([
            'code' => 'required|string',
            'type' => 'required|in:verify,reset',
            'email' => 'email'
        ]);

        if ($request->get('email')) {
            $user = User::where('email', $request->get('email'))->first();
        } else {
            $user = Auth::user();
        }

        if (!$user) {
            return back()->withErrors([
                'Invalid credentials.',
            ]);
        }

        $otp = Otp::where('user_id', $user->id)
            ->where('code', $body['code'])
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'The provided OTP is invalid.',
            ]);
        }

        if ($body['type'] == 'reset') {
            return view('auth.set_password', [
                'email' => $user->email,
                'token' => base64_encode($body['code'])
            ]);
        }

        $otp->delete();
        $otp->user->update([
            'is_verified' => true
        ]);

        return redirect()->route('auth.index');
    }

    public function reset_password(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'The provided email is invalid.',
            ]);
        }
        $otp = Otp::where('user_id', $user->id)
            ->where('code', base64_decode($body['token']))
            ->first();
        if (!$otp) {
            return back()->withErrors([
                'The provided token is invalid.',
            ]);
        }

        $user->update([
            'password' => Hash::make($body['password'])
        ]);

        return redirect()->route('auth.login');
    }
}
