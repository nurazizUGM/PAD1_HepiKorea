<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'order');


        $orders = new Order();
        if ($tab == 'order') {
            $orders = $orders->where('type', 'order');
        } else {
            $orders = $orders->where('type', 'custom');
        }

        $firstOrder = $orders->clone()->orderBy('created_at', 'asc')->first();

        $year = Carbon::now()->format('Y');
        $years = [$year];
        $months = [$year => []];

        for ($i = 0; $i < date('n'); $i++) {
            $m = Carbon::now()->subMonths($i);
            if ($firstOrder && $m->greaterThanOrEqualTo($firstOrder->created_at)) {
                $months[$year][] = $m->format('F');
            }
        }
        $months[$year] = array_reverse($months[$year]);

        while (true) {
            $y = Carbon::now()->subYears(count($years));
            $year = $y->format('Y');
            if ($firstOrder && $firstOrder->created_at->format('Y') > $year) {
                break;
            }

            $years[] = $year;
            $months[$year] = [];
            for ($i = 0; $i < 12; $i++) {
                $m = $y->subMonths($i);
                if ($firstOrder && $m->greaterThanOrEqualTo($firstOrder->created_at)) {
                    $months[$year][] = $m->format('F');
                }
            }
            $months[$year] = array_reverse($months[$year]);
        }

        $year = $request->query('year');
        if ($year) {
            $orders = $orders->whereYear('created_at', $year);
        }

        if ($request->query('month')) {
            $m = Carbon::parse($request->query('month'))->format('m');
            $orders = $orders->whereMonth('created_at', $m);
        }

        $orders = $orders->with(['user', 'orderItems', 'orderItems.product', 'customOrderItems'])->orderBy('created_at', 'desc')->get();

        return view('admin.order.index', compact('tab', 'years', 'year', 'months', 'orders'));
    }
}
