<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Basket;
use App\Models\OrderedItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $basketItems = Basket::with('car')->where('user_id', $userId)->get();
        $subtotal = $basketItems->sum(fn($item) => $item->car->price * $item->quantity);

        return view('checkout', compact('basketItems', 'subtotal'));
    }

    public function submit(Request $request)
    {
        // Validate the form fields
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'first_line' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cardname' => 'required|string|max:255',
            'cardnumber' => 'required|digits:16',
            'expire_month' => 'required|integer|min:1|max:12',
            'expire_year' => 'required|integer|min:' . now()->year,
            'cvv' => 'required|digits:3',
            'postcode' => 'nullable|string|max:10',
        ]);

        // Store or update the user's address
        $address = Address::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_line' => $request->input('first_line'),
                'city' => $request->input('city'),
                'postcode' => $request->input('postcode'),
                'country' => $request->input('country'),
            ]
        );

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'cardname' => $request->input('cardname'),
            'cardnumber' => $request->input('cardnumber'),
            'expire_month' => $request->input('expire_month'),
            'expire_year' => $request->input('expire_year'),
            'cvv' => $request->input('cvv'),
        ]);

        // Get all items in the basket
        $basketItems = Basket::where('user_id', Auth::id())->get();

        // Loop through basket items and create ordered items
        foreach ($basketItems as $item) {
            OrderedItems::create([
                'order_id' => $order->id,
                'car_id' => $item->car_id,
                'order_quantity' => $item->quantity,
                'user_id' => Auth::id(),
            ]);
        }

        // Clear the basket after creating the order
        Basket::where('user_id', Auth::id())->delete();

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Order successfully placed, thanks for shopping with us!');
    }
}


