<?php

namespace App\Http\Controllers;

use App\Enums\Role;
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
    public function index()
    {
        $users = User::all(['fullname', 'email', 'role']);
        return view('auth.index', compact('users'));
    }
    public function authenticate(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user || !$user->password || !Hash::check($body['password'], $user->password)) {
            return back()->withErrors([
                'message' => 'Invalid credentials.',
            ])->withInput();
        }

        Auth::login($user);
        Session::regenerate();

        if ($user->role == Role::ADMIN) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->intended();
    }

    public function register(Request $request)
    {
        $body = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create($body);
        Auth::login($user);
        Session::regenerate();

        return redirect()->route('auth.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended();
    }
    public function google()
    {
        return Socialite::driver('google')->with([
            'redirect_uri' => route('auth.callback'),
        ])->redirect();
    }

    public function callback(Request $request)
    {
        try {
            if ($request->has('credential')) {
                $token = $request->get('credential');
                $client = new Client();
                $googleUser = $client->verifyIdToken($token);
                if (!$googleUser) {
                    return redirect()->route('auth.login')->withErrors([
                        'message' => 'Failed to login with Google',
                    ]);
                }
                $accountId = $googleUser['sub'];
            } else {
                $googleUser = Socialite::driver('google')->user();
                if (!$googleUser) {
                    return redirect()->route('auth.login')->withErrors([
                        'message' => 'Failed to login with Google',
                    ]);
                }
                $accountId = $googleUser->getId();
                $googleUser = $googleUser->user;
            }

            $user = User::where('google_id', $accountId)->orWhere('email', $googleUser['email'])->first();
            if (!$user) {
                $user = User::create([
                    'fullname' => $googleUser['name'],
                    'email' => $googleUser['email'],
                    'photo' => $googleUser['picture'],
                    'google_id' => $accountId,
                    'is_verified' => true
                ]);
            } else if (empty($user->google_id)) {
                $user->update([
                    'google_id' => $accountId,
                    'is_verified' => true
                ]);
            } else if ($user->google_id != $accountId) {
                return redirect()->route('auth.login')->withErrors([
                    'message' => 'Failed to login with Google',
                ]);
            }

            Auth::login($user);
            Session::regenerate();

            if ($user->role == Role::ADMIN) {
                return redirect()->route('admin.dashboard');
            }
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

    public function forgotPassword(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'The provided email is invalid.',
            ]);
        }

        Session::forget(['userId', 'verified']);
        Session::put('userId', $user->id);
        return redirect()->route('auth.verify');
    }

    public function verify()
    {
        $user = Auth::user();
        if (Session::has('userId')) {
            $user = User::find(Session::get('userId'));
        }

        if (!$user) {
            Session::forget('userId');
            return redirect()->to('/')->withErrors([
                'Invalid credentials.',
            ]);
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

        if (env('APP_DEBUG') == true) {
            dump($otp->code);
        }
        return view('auth.otp', [
            'email' => $user->email,
            'timeout' => $otp->expired_at->getTimestamp() - now()->getTimestamp(),
        ]);
    }
    public function verifyCode(Request $request)
    {
        $body = $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();
        $type = 'verify';
        if (Session::has('userId')) {
            $user = User::find(Session::get('userId'));
            $type = 'reset';
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
        } else if ($otp->expired_at < now()) {
            return back()->withErrors([
                'The provided OTP is expired.',
            ]);
        }

        $otp->delete();
        if ($type == 'reset') {
            Session::put('verified', true);
            return redirect()->route('auth.reset_password');
        }

        $otp->delete();
        $otp->user->update([
            'is_verified' => true
        ]);

        return redirect()->route('auth.index');
    }

    public function resetPassword()
    {
        if (!Session::has('userId')) {
            return redirect()->route('auth.forgot_password')->withErrors([
                'You need to request a password reset first.',
            ]);
        } else if (!Session::has('verified') || Session::get('verified') !== true) {
            return redirect()->route('auth.verify')->withErrors([
                'You need to verify your account first.',
            ]);
        }

        return view('auth.reset_password');
    }

    public function setPassword(Request $request)
    {

        if (!Session::has('userId')) {
            return redirect()->route('auth.forgot_password')->withErrors([
                'You need to request a password reset first.',
            ]);
        } else if (!Session::has('verified')) {
            return redirect()->route('auth.verify')->withErrors([
                'You need to verify your account first.',
            ]);
        }

        $body = $request->validate([
            'password' => 'required|string|confirmed'
        ]);

        $user = User::find(Session::get('userId'));
        if (!$user) {
            return back()->withErrors([
                'The provided email is invalid.',
            ]);
        }

        $user->update([
            'password' => Hash::make($body['password'])
        ]);

        Session::forget(['userId', 'verified']);
        return redirect()->route('auth.login');
    }
}
