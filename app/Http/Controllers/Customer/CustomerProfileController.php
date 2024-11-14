<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
{
    public function  index()
    {
        $user = Auth::user();
        return view('customer.user.profile', compact('user'));
    }

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

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $photo = $request->file('photo');
            $filename = $photo->hashName();
            $data['photo'] = $photo->storeAs('profile', $filename, 'public');
        }

        if ($request->filled('password')) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect');
            }
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
