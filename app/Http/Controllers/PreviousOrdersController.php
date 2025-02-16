<?php

namespace App\Http\Controllers;

use App\Models\OrderedItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PreviousOrdersController extends Controller
{
    public function show()
    {
        // Fetch orders for the authenticated user, along with their associated ordered items and cars
        $orders = Auth::user()->orders()->with('orderedItems.car')->get();

        return view('previousOrders', compact('orders'));  // Pass orders and ordered items to the view
    }

    public function details($order_id){
        $order = Order::find($order_id);
        if (is_null($order)) {
            return redirect('/')->with('success', 'Invalid Order');
        }
        if ($order->user_id == Auth::id()) {
            $items = OrderedItems::with('car')->where('order_id', $order_id)->get();
            $subtotal = $items->sum(function ($item) {
                return $item->car->price * $item->order_quantity;
            });
            return view('orderDetails', compact('subtotal', 'items', 'order'));
        }
        return redirect('/')->with('success', 'Order does not belong to you!');

    }

    public function returnOne($item_id){
        $removable = OrderedItems::find($item_id);
        $removable->order_quantity = $removable->order_quantity - 1;
        $removable->save();
        if ($removable->order_quantity <= 0) {
            $removable->delete();
        }
        return redirect('/order-details/'.$removable->order_id);
    }
    public function returnAll($item_id){
        $removable = OrderedItems::find($item_id);
        $removable->delete();
        return redirect('/order-details/'.$removable->order_id);
    }



}
