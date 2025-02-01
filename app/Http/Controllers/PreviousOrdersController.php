<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cars;

class PreviousOrdersController extends Controller
{
    public function show()
    {
        // Fetch orders for the authenticated user, along with their associated car data
        $orders = Auth::user()->orders()->with('car')->get();

        return view('previousOrders', compact('orders'));  // Pass orders to the view
    }

}
