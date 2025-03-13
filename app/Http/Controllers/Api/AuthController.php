<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\MailJob;
use App\Mail\Verification;
use App\Models\Otp;
use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    static $OTP_EXPIRATION = 5; // expiration in minutes

    public function login(Request $request)
    {
        $body = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $body['email'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'Email is not registered.',
            ], 401);
        } else if (!$user->password || !Hash::check($body['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid password.',
            ], 401);
        }

        $token = $user->createToken('auth_token');
        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    // register new user
    public function register(Request $request)
    {
        $body = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create($body);

        $token = $user->createToken('auth_token');
        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    // logout user
    public function logout()
    {
        User::find(Auth::id())->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'gender' => 'required|in:male,female|max:255',
            'date_of_birth' => 'required|date',
            'new_password' => 'nullable|string|min:8',
            'old_password' => 'nullable|string|min:8',
            'photo' => 'nullable|image',
        ]);

        // Check if photo is uploaded
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }

            $photo = $request->file('photo');
            $data['photo'] = $photo->store('profile');
        }

        // Check if password is updated
        if (!empty($data['new_password'])) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid old password.',
                ], 401);
            }
            $data['password'] = Hash::make($data['new_password']);
        }

        $user->update($data);
        return response()->json([
            'message' => 'Profile updated successfully.',
        ]);
    }

    // forgot password
    public function verify(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $body = $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where(['email' => $body['email']])->first();
            if (!$user) {
                return response()->json([
                    'message' => 'Email is not registered.',
                ], 401);
            }
        }

        // check existing OTP
        $otp = Otp::where('user_id', $user->id)->first();
        $expiration = now()->addMinutes(self::$OTP_EXPIRATION);
        if ($otp) {
            $otp->update(['expired_at' => $expiration]);
        } else {
            $otp = Otp::create([
                'user_id' => $user->id,
                'code' => random_int(100000, 999999),
                'expired_at' => $expiration,
            ]);
        }
        MailJob::dispatch($user->email, new Verification($otp->code));

        return response()->json([
            'message' => 'OTP sent to your email.',
            'expired_at' => $expiration,
        ]);
    }

    // verify OTP code
    public function verifyOtp(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_verified) {
                return response()->json([
                    'message' => 'Account is already verified.',
                ], 401);
            }

            $action = 'verify';
        } else {
            $request->validate([
                'email' => 'required|email'
            ]);

            $user = User::where(['email' => $request->get('email')])->first();
            if (!$user) {
                return response()->json([
                    'message' => 'Email is not registered.',
                ], 401);
            }
            $action = 'forgot_password';
        }

        $request->validate([
            'code' => 'required|numeric'
        ]);
        $otp = Otp::where('user_id', $user->id)
            ->where('code', $request->get('code'))
            ->first();

        if (!$otp) {
            return response()->json([
                'message' => 'Invalid OTP code.',
            ], 401);
        } else if ($otp->expired_at < now()) {
            // regenerate OTP if expired
            return response()->json([
                'message' => 'OTP code has expired.',
            ], 401);
        }

        if ($action === 'verify') {
            $user->update(['is_verified' => true]);
            $otp->delete();
            return response()->json([
                'message' => 'Account verified successfully.',
            ]);
        } else {
            $otp->update(['expired_at' => now()->addMinutes(15)]);
            return response()->json([
                'message' => 'OTP code verified successfully.'
            ]);
        }
    }

    // set new password after OTP verification
    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'Email is not registered.',
            ], 401);
        }

        $otp = Otp::where('user_id', $user->id)
            ->where('code', $data['code'])
            ->first();

        if (!$otp) {
            return response()->json([
                'message' => 'Invalid OTP code.',
            ], 401);
        } else if ($otp->expired_at < now()) {
            return response()->json([
                'message' => 'OTP code has expired.',
            ], 401);
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        $otp->delete();

        return response()->json([
            'message' => 'Password reset successfully.',
        ]);
    }
}
