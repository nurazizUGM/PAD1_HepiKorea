<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    // admin profile page
    public function index()
    {
        $user = User::where('id', Auth::id())->with('addresses')->first();
        $address = $user->addresses->first();

        return view('admin.profile.user', compact('user', 'address'));
    }

    // update admin profile
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string',
            'phone' => 'nullable|numeric',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'postal_code' => 'nullable|numeric',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::id());

        // check if password changed
        if ($data['old_password'] && $data['new_password']) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect']);
            }
            $data['password'] = Hash::make($data['new_password']);
        }
        unset($data['old_password'], $data['new_password']);

        // check if address changed
        if ($data['address'] || $data['city'] || $data['province'] || $data['postal_code']) {
            $user->addresses()->updateOrCreate([
                'user_id' => $user->id
            ], [
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'province' => $data['province'],
                'postal_code' => $data['postal_code'],
                'name' => $data['fullname']
            ]);
        }

        // check if photo changed
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photo = $request->file('photo');
            $filename = $photo->hashName();
            $data['photo'] = $photo->storeAs('profile', $filename);
        }

        $user->update($data);
        return back()->with('success', 'Profile updated successfully');
    }

    // business setting page
    public function setting()
    {
        $settings = Setting::all();
        return view('admin.profile.business', compact('settings'));
    }
}
