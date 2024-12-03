<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderShipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Order list
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'order');


        // filter order by type
        $orders = new Order();
        if ($tab == 'order') {
            $orders = $orders->whereNotIn('status', ['unconfirmed', 'confirmed']);
        } else {
            $orders = $orders->whereIn('status', ['unconfirmed', 'confirmed']);
        }

        // get all years and months for monthly filter
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

        // filter order by year
        $year = $request->query('year');
        if ($year) {
            $orders = $orders->whereYear('created_at', $year);
        }

        // filter order by month
        if ($request->query('month')) {
            $m = Carbon::parse($request->query('month'))->format('m');
            $orders = $orders->whereMonth('created_at', $m);
        }

        $orders = $orders->with(['user', 'orderItems', 'orderItems.product', 'customOrderItems'])
            ->orderByRaw("FIELD(status, 'unconfirmed', 'confirmed', 'paid', 'processing', 'shipment_paid', 'unpaid', 'shipment_unpaid', 'sent', 'finished', 'cancelled')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.index', compact('tab', 'years', 'year', 'months', 'orders'));
    }

    // custom order detail
    public function showConfirmation(string $orderId)
    {
        $order = Order::with(['user', 'customOrderItems'])->findOrFail($orderId);
        return view('admin.order.confirmation-detail', compact('order'));
    }

    public function process(Request $request, string $orderId)
    {
        $data = $request->validate([
            'estimated_arrival' => 'required|date',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = 'processing';
        $order->estimated_arrival = $data['estimated_arrival'];
        $order->save();

        return redirect()->back()->with('success', 'Order has been processed');
    }

    public function sent(Request $request, string $orderId)
    {
        $data = $request->validate([
            'shipment_service' => 'required|string',
            'price' => 'required|numeric',
            'arrival_estimation' => 'required|date',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = 'shipment_unpaid';
        $order->save();

        OrderShipment::create([
            'order_id' => $order->id,
            'shipment_service' => $data['shipment_service'],
            'price' => $data['price'],
            'arrival_estimation' => $data['arrival_estimation'],
        ]);

        return redirect()->back()->with('success', 'Shipment invoice has been sent');
    }

    public function send(Request $request, string $orderId)
    {
        $data = $request->validate([
            'tracking_code' => 'required|string',
            'arrival_estimation' => 'required|date',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = 'sent';
        $order->save();

        $shipment = OrderShipment::where('order_id', $order->id)->first();
        $shipment->tracking_code = $data['tracking_code'];
        $shipment->arrival_estimation = $data['arrival_estimation'];
        $shipment->save();

        return redirect()->back()->with('success', 'Shipment detail has been sent');
    }

    public function show(string $orderId)
    {
        $order = Order::with(['user', 'orderDetail', 'orderItems', 'orderItems.product', 'customOrderItems'])->findOrFail($orderId);
        return view('admin.order.order-detail', compact('order'));
    }
}
