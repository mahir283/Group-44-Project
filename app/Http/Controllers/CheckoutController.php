<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        DB::table('baskets')->where('user_id', '=', Auth::id())->delete();


            // Redirect with success message
            return redirect()->route('home')->with('success', 'Order successfully placed, thanks for shopping with us!');

    }
}


