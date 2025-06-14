<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
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
use Ramsey\Uuid\Uuid;

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

    public function google(Request $request)
    {
        try {
            $token = $request->get('token');
            if (!$token) {
                return response()->json([
                    'message' => 'Google token is required.',
                ], 401);
            }

            $client = new Client();
            $googleUser = $client->verifyIdToken($token);
            if (!$googleUser) {
                return response()->json([
                    'message' => 'Failed to login with Google',
                ], 401);
            }
            $accountId = $googleUser['sub'];


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
                return response()->json([
                    'message' => 'Failed to login with Google',
                ], 401);
            }

            if ($user->role == Role::GUEST) {
                $user->update([
                    'role' => Role::USER,
                ]);
            }

            $user->update([
                'is_verified' => true
            ]);

            $token = $user->createToken('auth_token');
            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            error_log("[Exception] " . $e->getMessage() .
                " in " . $e->getFile() .
                " on line " . $e->getLine());

            return response()->json([
                'message' => 'Failed to login with Google',
            ], 401);
        }
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
            'phone' => 'sometimes|nullable|string|max:15',
            'gender' => 'sometimes|nullable|in:male,female',
            'date_of_birth' => 'sometimes|nullable|date',
            'new_password' => 'sometimes|nullable|string',
            'old_password' => 'sometimes|nullable|string',
            'photo' => 'sometimes|nullable|image',
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
