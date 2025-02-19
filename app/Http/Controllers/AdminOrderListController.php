<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderedItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderListController
{


    public function index(){
        if (Auth::user()){

        }
        $orders = Order::with(['user', 'orderedItems' => function ($query) {
            $query->with('car')->whereNotNull('car_id');
        }])->get();


        $orders = $orders->filter(function($order){
            return $order->orderedItems->isNotEmpty();
        });

            $orders = $orders->map(function ($order) {
                $orderCreatedAt = $order->orderedItems->first()?->created_at;

                $orderStatus = $order->orderedItems->first()?->status;

                $customerName = $order->user ? $order->user->first_name . ' ' . $order->user->last_name : ' ';

                return[
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
            'status' => 'required|string|in:confirmed,shipped,delivered',
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

