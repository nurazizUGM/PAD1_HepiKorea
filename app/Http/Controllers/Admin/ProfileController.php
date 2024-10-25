<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.user', compact('user'));
    }

    public function setting()
    {
        $settings = Setting::all();
        return view('admin.profile.business', compact('settings'));
    }
}
