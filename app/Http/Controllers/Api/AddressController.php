<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $addresses = Address::where('user_id', $userId)
            ->orderBy('last_used', 'desc')
            ->get();
        return response()->json($addresses);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        $data['user_id'] = $userId;
        $data['last_used'] = now();
        $address = Address::create($data);

        return response()->json($address, 201);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $address = Address::where('id', $id)->where('user_id', $userId)->firstOrFail();

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:500',
            'province' => 'sometimes|required|string|max:100',
            'city' => 'sometimes|required|string|max:100',
            'postal_code' => 'sometimes|required|string|max:20',
        ]);

        if (isset($data['is_default']) && $data['is_default']) {
            Address::where('user_id', $userId)->update(['is_default' => false]);
        }

        $data['last_used'] = now();
        $address->update($data);

        return response()->json($address);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $address = Address::where('id', $id)->where('user_id', $userId)->first();
        if ($address) {
            $address->delete();
        }

        return response()->json([
            'message' => 'Address deleted successfully',
        ], 200);
    }

    public function setDefault($id)
    {
        $userId = Auth::id();
        $address = Address::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $address->update(['last_used' => now()]);

        return response()->json([
            'message' => 'Default address updated successfully',
            'address' => $address,
        ]);
    }
}
