<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add logging

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

        // Log the validation data to ensure we're getting what we expect
        Log::info('Checkout form data validated', $validatedData);

        $userId = Auth::id();

        // Add logging to check if userId is correctly retrieved
        Log::info("User ID: {$userId} - Starting Checkout");

        try {
            // Save Address
            Address::create([
                'user_id' => $userId,
                'first_line' => $request->first_line,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'country' => $request->country,
            ]);
            Log::info("Address saved successfully for user ID: {$userId}");

            // Save Order
            Order::create([
                'user_id' => $userId,
                'cardname' => $request->cardname,
                'cardnumber' => $request->cardnumber,
                'expire_month' => $request->expire_month,
                'expire_year' => $request->expire_year,
                'cvv' => $request->cvv,
            ]);
            Log::info("Order saved successfully for user ID: {$userId}");

            // Redirect with success message
            return redirect()->route('home')->with('success', 'Order successfully placed!');
        } catch (\Exception $e) {

            // Log any errors
            Log::error("Error during checkout for user ID: {$userId} - " . $e->getMessage());

            // Redirect with error message
            return redirect()->route('checkout.show')->with('error', 'Something went wrong. Please try again.');
        }
    }
}


