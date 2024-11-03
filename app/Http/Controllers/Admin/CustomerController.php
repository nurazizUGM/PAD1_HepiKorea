<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', Role::USER)->get();
        $tab = 'customer';
        return view('admin.customer.index', compact('customers', 'tab'));
    }

    public function edit(string $id)
    {
        $edit = User::findOrFail($id);
        $tab = 'customer';
        dd($edit);
        return view('admin.customer.index', compact('edit', 'tab'));
    }
}
