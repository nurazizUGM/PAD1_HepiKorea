<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // profile page
    public function  index()
    {
        $user = Auth::user();
        return view('customer.user.profile', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'gender' => 'required|in:male,female|max:255',
            'date_of_birth' => 'required|date',
            'password' => 'nullable|string|min:8|confirmed',
            'old_password' => 'nullable|string',
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
        if ($request->filled('password')) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect');
            }
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // Notification page
    public function notification()
    {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('is_read', 'asc')->orderBy('created_at', 'desc')->get();
        return view('customer.notification', compact('notifications'));
    }

    // Address page
    public function address()
    {
        $user = User::find(Auth::id())->with('addresses')->first();
        return view('customer.user.address', compact('user'));
    }
}
