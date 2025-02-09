<?php

namespace App\Http\Controllers;

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
}
