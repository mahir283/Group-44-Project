<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedItems;
use Illuminate\Http\Request;

class OrderDetailsAdminController extends Controller
{
    // Method to display all orders for the admin
    public function index($orderId)
    {
        // Fetch the specific order with its related ordered items and car details
        $order = Order::with(['orderedItems.car', 'user'])->findOrFail($orderId);

        // Pass the order to the view
        return view('orderDetailsAdmin', compact('order'));
    }

    // Method to update the order status
    public function updateOrderStatus(Request $request, $orderId)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:orderPlaced,processing,shipped,delivered',
        ]);

        // Find all ordered items for the given order ID
        $orderedItems = OrderedItems::where('order_id', $orderId)->get();

        if ($orderedItems->isNotEmpty()) {
            // Update the order status for all items
            foreach ($orderedItems as $item) {
                $item->status = $request->input('status');
                $item->save();
            }

            // Return a success response
            return response()->json(['message' => 'Order status updated successfully!']);
        }

        // Return an error response if no ordered items are found
        return response()->json(['error' => 'Order not found!'], 404);
    }

    // Method to remove an order
    public function removeOrder($orderId)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        if ($order) {
            // Delete the order and its related ordered items
            $order->orderedItems()->delete();
            $order->delete();

            // Return a success response
            return response()->json(['message' => 'Order removed successfully!']);
        }

        // Return an error response if the order is not found
        return response()->json(['error' => 'Order not found!'], 404);
    }
}
