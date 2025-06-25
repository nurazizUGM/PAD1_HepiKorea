<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json(Setting::pluck('value', 'key'));
    }

    public function settings()
    {
        $setting = Setting::all();
        return response()->json($setting);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->update([
            'value' => $request->input('value', $setting->value)
        ]);
        return response()->json($setting);
    }
}
