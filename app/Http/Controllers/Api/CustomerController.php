<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // customer list
    public function findAll()
    {
        $customers = User::where('role', Role::USER);
        if (request()->has('search')) {
            $customers->where('fullname', 'like', '%' . request('search') . '%');
        }

        return response()->json($customers->get());
    }

    // customer detail
    public function show(string $id)
    {
        $customer = User::find($id);
        $customer->address = $customer->addresses()->orderBy('last_used', 'desc')->first();

        return response()->json($customer);
    }

    // customer review
    public function review(Request $request)
    {

        if ($request->has('search')) {
            // filter by content
            $reviews = Review::where('content', 'like', '%' . $request->search . '%');
        } else {
            $reviews = Review::query();
        }
        $reviews = $reviews->with('product', 'user')->get();

        return response()->json($reviews);
    }
}
