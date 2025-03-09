<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
// Show the basket page
    public function showBasket()
    {
        if (Auth::check()) {
// Get the authenticated user's ID
            $userId = Auth::id();

// Retrieve all basket items for the user
            $basketItems = Basket::with('car')
                ->where('user_id', $userId)
                ->get();

// Calculate subtotal, tax, and total
            $subtotal = $basketItems->sum(function ($item) {
                return $item->car->price * $item->quantity;
            });

            $tax = $subtotal * 0.05; // 5% tax
            $shipping = 10; // Flat rate shipping
            $total = $subtotal + $tax + $shipping;

// Pass the data to the view
            return view('basketPage', compact('basketItems', 'subtotal', 'tax', 'shipping', 'total'));
        }

        return redirect()->route('userLogin')->with('fail', 'Please log in to access the basket page.');
    }

// Add a car to the basket
    public function addToBasket(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('message', 'Please log in to add items to your basket.');
        }

        $request->validate([
            'car' => 'required|exists:cars,id',  // Ensure the car exists in the cars table
        ]);

        $userId = Auth::id();
        $carId = $request->input('car');

// Check if the car is already in the user's basket
        $existingItem = Basket::where('user_id', $userId)
            ->where('car_id', $carId)
            ->first();

// If the item exists, update quantity, else create a new basket entry
        if ($existingItem) {
            $existingItem->quantity++;
            $existingItem->save();
        } else {
            Basket::create([
                'user_id' => $userId,
                'car_id' => $carId,
                'quantity' => 1,
            ]);
        }

// Redirect to the Basket Page after adding the car to the basket
        return redirect()->route('basket.show')->with('success', 'Car added to basket successfully.');
    }

    public function updateQuantity(Request $request, $basketId)
    {
        // Find the basket item by its ID
        $basketItem = Basket::findOrFail($basketId);

        // Get the available stock for the car
        $availableStock = $basketItem->car->quantity;

        // Validate the requested quantity
        $request->validate([
            'quantity' => "required|integer|min:1|max:$availableStock",
        ]);

        // Update the quantity
        $basketItem->quantity = $request->quantity;

        // Save the updated basket item
        $basketItem->save();

        // Redirect back to the basket page after updating the quantity
        return redirect()->route('basket.show')->with('success', 'Quantity updated successfully.');
    }


// Remove a car from the basket
    public function removeFromBasket($basketId)
    {
        $basketItem = Basket::findOrFail($basketId);

        $basketItem->delete();

        return redirect()->route('basket.show')->with('success', 'Item removed successfully.');
    }
}
