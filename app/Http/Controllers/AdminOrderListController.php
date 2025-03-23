<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderedItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderListController
{


    public function index(Request $request)
    {
        // Get search and filter inputs
        $search = $request->input('search');
        $priceFrom = $request->input('price_from');
        $priceTo = $request->input('price_to');
        $status = $request->input('status');

        // Get all orders with necessary relationships
        $orders = Order::with(['user', 'orderedItems' => function ($query) {
            $query->with('car')->whereNotNull('car_id');
        }])->get();

        // Filter out orders that have no items
        $orders = $orders->filter(function ($order) {
            return $order->orderedItems->isNotEmpty();
        });

        // Apply search filter
        if ($search) {
            $orders = $orders->filter(function ($order) use ($search) {
                $order_id = strval($order->id);
                $customerName = $order->user ? strtolower(trim($order->user->first_name . ' ' . $order->user->last_name)) : '';

                return str_contains(strtolower($order_id), strtolower($search)) ||
                    str_contains($customerName, strtolower($search));
            });
        }

        // Apply price filter
        if ($priceFrom || $priceTo) {
            $orders = $orders->filter(function ($order) use ($priceFrom, $priceTo) {
                $orderPrice = $order->orderedItems->sum(function ($item) {
                    return $item->order_quantity * ($item->car->price ?? 0);
                });

                return (!$priceFrom || $orderPrice >= $priceFrom) &&
                    (!$priceTo || $orderPrice <= $priceTo);
            });
        }

        // Apply status filter
        if ($status) {
            $orders = $orders->filter(function ($order) use ($status) {
                return optional($order->orderedItems->first())->status === $status;
            });
        }

        // Map orders for frontend
        $orders = $orders->map(function ($order) {
            $orderCreatedAt = $order->orderedItems->first()?->created_at;
            $orderStatus = $order->orderedItems->first()?->status;
            $customerName = $order->user ? $order->user->first_name . ' ' . $order->user->last_name : ' ';

            return [
                'order_number' => $order->id,
                'customer_name' => $customerName,
                'order_date' => $orderCreatedAt ? $orderCreatedAt->format('d M Y') : 'N/A',
                'order_status' => $orderStatus,
                'number_of_items' => $order->orderedItems->sum('order_quantity'),
                'order_price' => $order->orderedItems->sum(function ($item) {
                    return $item->order_quantity * ($item->car->price ?? 0);
                })
            ];
        });

        return view('adminList', compact('orders'));
    }

    public function updateStatus(Request $request){
        $validated = $request->validate([
            'order_id' => 'required',
            'status' => 'required|string|in:confirmed,shipped,delivered,processing'
        ]);

        $order = OrderedItems::where('order_id', $validated['order_id'])->first();

        if ($order){
            $order->status = $validated['status'];
            $order->save();

            return redirect()->route('admin.orders')->with('status', 'Order status updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update order status');
    }

    public function deleteOrder(Request $request){
        $validated = $request->validate([
            'order_id' => 'required',
        ]);

        $order = Order::find($validated['order_id']);

        if($order){
            $order->orderedItems()->delete();

            $order->delete();

            return redirect()->route('admin.orders')->with('status', 'Order deleted!');
        }

        return redirect()->route('admin.orders')->with('error', 'Failed to delete order!');
    }

}

