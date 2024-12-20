<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Jobs\MailJob;
use App\Mail\Verification;
use App\Models\Otp;
use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all(['fullname', 'email', 'role']);
        return view('auth.index', compact('users'));
    }

    // login authentication
    public function authenticate(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'message' => 'Email is not registered.',
            ])->withInput();
        } else if (!$user->password || !Hash::check($body['password'], $user->password)) {
            return back()->withErrors([
                'message' => 'Invalid password.',
            ])->withInput();
        }

        Auth::login($user);
        Session::regenerate();

        if ($user->role == Role::ADMIN) {
            return redirect()->intended('/admin');
        }
        return redirect()->intended();
    }

    // register new user
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

        return redirect()->intended();
    }

    // logout user
    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        return redirect()->route('home');
    }

    // redirect to google login
    public function google()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
        $driver = Socialite::driver('google');
        return $driver->with([
            'redirect_uri' => route('auth.callback'),
        ])->redirect();
    }

    // google login callback
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

            // check if google account already registered
            $user = User::where('google_id', $accountId)->first();

            // check if email already registered
            if (!$user) {
                $user = User::where('email', $googleUser['email'])->first();
            }

            if (!$user) {
                // create new user if not exist
                $headers = get_headers($googleUser['picture'], 1);
                $ext = explode('/', $headers['Content-Type'])[1];

                try {
                    $photo =  'profile/' . Uuid::uuid4() . '.' . $ext;
                    Storage::put($photo, file_get_contents($googleUser['picture']));
                } catch (\Throwable $th) {
                    error_log("[Exception] " . $th->getMessage() .
                        " in " . $th->getFile() .
                        " on line " . $th->getLine());
                    $photo = null;
                }

                $user = User::create([
                    'fullname' => $googleUser['name'],
                    'email' => $googleUser['email'],
                    'photo' => $photo,
                    'google_id' => $accountId,
                    'is_verified' => true
                ]);
            } else if (empty($user->google_id)) {
                // update existing user with google account
                $user->update([
                    'google_id' => $accountId,
                    'is_verified' => true
                ]);
            } else if ($user->google_id != $accountId) {
                // account already registered with different google account
                return redirect()->route('auth.login')->withErrors([
                    'message' => 'Failed to login with Google',
                ]);
            }

            if ($user->role == Role::GUEST) {
                $user->update([
                    'role' => Role::USER,
                ]);
            }

            $user->update([
                'is_verified' => true
            ]);

            // authenticate user
            Auth::login($user);
            Session::regenerate();

            // redirect to intended page if using gsi iframe
            if ($request->has('credential')) {
                return redirect()->intended();
            }

            // close popup window and refresh parent window
            return "<script>window.opener.location.reload();window.close();</script>";
        } catch (\Exception $e) {
            error_log("[Exception] " . $e->getMessage() .
                " in " . $e->getFile() .
                " on line " . $e->getLine());

            return redirect()->route('auth.login')->withErrors([
                'message' => 'Failed to login with Google',
            ]);
        }
    }

    // forgot password
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

    // verify email with OTP
    public function verify(Request $request)
    {
        $user = Auth::user();
        if (Session::has('userId')) {
            $user = User::find(Session::get('userId'));
        }

        if (!$user) {
            Session::forget('userId');
            return redirect()->route('auth.login')->withErrors([
                'Invalid credentials.',
            ]);
        }

        // check existing OTP
        $otp = Otp::where('user_id', $user->id)->first();
        if (!$otp || $otp->expired_at < now()) {
            // generate new OTP if not exist or expired
            $otp_code = rand(100000, 999999);
            $otp = Otp::updateOrCreate([
                'user_id' => $user->id
            ], [
                'code' => $otp_code,
                'expired_at' => now()->addMinutes(5)
            ]);
            MailJob::dispatch($user->email, new Verification($otp->code));
        } else if ($request->has('resend')) {
            // resend OTP
            $otp->update([
                'expired_at' => now()->addMinutes(5)
            ]);
            MailJob::dispatch($user->email, new Verification($otp->code));
        }

        if (env('APP_DEBUG') == true) {
            dump($otp->code);
        }

        $timeout = $otp->expired_at->getTimestamp() - now()->getTimestamp();
        if ($timeout > 120) {
            // subtract timeout by 2 minutes
            $timeout -= 120;
        }

        return view('auth.otp', [
            'email' => $user->email,
            'timeout' => $timeout,
        ]);
    }

    // verify OTP code
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
            // regenerate OTP if expired
            return redirect()->route('auth.verify', ['resend' => true])->withErrors([
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

        return redirect()->route('home');
    }

    // set new password after OTP verification
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

    // update password after OTP verification
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
