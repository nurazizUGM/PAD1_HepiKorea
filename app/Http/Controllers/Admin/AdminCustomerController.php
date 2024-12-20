<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    // customer list
    public function index()
    {
        $customers = User::where('role', Role::USER);
        if (request()->has('search')) {
            $customers->where('fullname', 'like', '%' . request('search') . '%');
        }
        $customers = $customers->get();
        $tab = 'customer';
        return view('admin.customer.index', compact('customers', 'tab'));
    }

    // customer detail
    public function show(string $id)
    {
        $customer = User::where('id', $id)->with('addresses')->first();
        $address = $customer->addresses->first();
        $tab = 'customer.profile';

        return view('admin.customer.index', compact('customer', 'address', 'tab'));
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
        $reviews = $reviews->with('product', 'product.images', 'user')->get();
        $tab = 'review';

        return view('admin.customer.index', compact('reviews', 'tab'));
    }
}
