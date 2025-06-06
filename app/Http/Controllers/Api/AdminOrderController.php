<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderShipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function orders(Request $request)
    {
        // filter order by type
        $orders = Order::whereNotIn('status', ['unconfirmed', 'confirmed']);

        // first order
        $firstOrder = $orders->clone()->orderBy('created_at', 'asc')->first();

        // filter order by year
        $year = $request->query('year');
        if ($year) {
            $orders = $orders->whereYear('created_at', $year);

            // filter order by month
            $month = $request->query('month');
            if ($month) {
                $orders = $orders->whereMonth('created_at', $month);
            }
        }

        $orders = $orders->with(['user', 'orderItems', 'orderItems.product'])
            ->orderByRaw("FIELD(status, 'paid', 'shipment_paid', 'processing', 'shipment_unpaid', 'sent', 'finished', 'unpaid', 'cancelled')")
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                if ($order->orderItems) {
                    $product = $order->orderItems->first()->product;
                    if ($product && $product->images->count() > 0) {
                        $order->image = $product->images->first()->path;
                    } else {
                        $order->image = null;
                    }
                } else {
                    $order->image = null;
                }
                return $order;
            });

        return response()->json([
            'orders' => $orders,
            'firstOrder' => [
                'year' => $firstOrder->created_at->format('Y'),
                'month' => $firstOrder->created_at->format('m'),
            ],
        ]);
    }

    public function unconfirmedOrders(Request $request)
    {
        // filter order by type
        $orders = Order::whereIn('status', ['unconfirmed', 'confirmed']);

        // filter order by year
        $year = $request->query('year');
        if ($year) {
            $orders = $orders->whereYear('created_at', $year);
        }

        // filter order by month
        $month = $request->query('month');
        if ($month) {
            $m = Carbon::parse($month)->format('m');
            $orders = $orders->whereMonth('created_at', $m);
        }

        $orders = $orders->with(['user', 'orderItems', 'orderItems.product', 'customOrderItems'])
            ->orderByRaw("FIELD(status, 'unconfirmed', 'confirmed')")
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function confirmationDetails(string $orderId)
    {
        $order = Order::with(['user', 'customOrderItems', 'orderDetail'])->findOrFail($orderId);
        return response()->json($order);
    }

    public function confirm(Request $request, string $orderId)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:custom_order_items,id',
            'items.*.total_price' => 'required|numeric',
            'items.*.max_quantity' => 'required|numeric',
            'items.*.admin_note' => 'nullable|string',
            'items.*.is_available' => 'required|boolean',
            'items.*.available_until' => 'required|date',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = 'confirmed';
        $order->save();

        foreach ($data['items'] as $item) {
            $customOrderItem = $order->customOrderItems()->findOrFail($item['id']);
            $customOrderItem->total_price = $item['total_price'];
            $customOrderItem->max_quantity = $item['max_quantity'];
            $customOrderItem->admin_note = $item['admin_note'];
            $customOrderItem->is_available = $item['is_available'];
            $customOrderItem->available_until = $item['available_until'];
            $customOrderItem->save();
        }

        return response()->json(['message' => 'Order has been confirmed']);
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

        return response()->json(['message' => 'Order has been processed']);
    }

    public function createShipmentInvoice(Request $request, string $orderId)
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

        return response()->json(['message' => 'Shipment invoice has been sent']);
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

        return response()->json(['message' => 'Order has been sent']);
    }

    public function show(string $orderId)
    {
        $order = Order::with(['user', 'orderDetail', 'orderItems', 'orderItems.product', 'customOrderItems'])->findOrFail($orderId);
        return response()->json($order);
    }
}
