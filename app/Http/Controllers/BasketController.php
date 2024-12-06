<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket; //import basket model
use App\Models\Car; //import car model
use Illuminate\Support\Facades\Auth; //import auth facade for user authentication

class BasketController extends Controller
{
    public function showBasket(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        //get the authenticated user's id
        $userId = Auth::id();

        //retrieve all basket items for the authenticated user, including car details
        $basketItems = Basket::with('car') //load the car details for each basket item
        ->where('user_id', $userId) //filter basket items by the user's id
        ->get();

        //calculate subtotal by summing the price of each car multiplied by its quantity
        $subtotal = $basketItems->sum(function ($item) {
            $sum = $item->car->price * $item->quantity;
        });

        return view('BasketPage', compact('subtotal'), array('basket'=>$basketItems));
    }
    public function updateQuantity(Request $request, $basketId)
    {
        //validate incoming quantity to ensure it is an integer and at least 1
        $request->validate([
            'quantity' => 'required|integer|min:1', //check that quantity is an integer and greater than 0
        ]);

        //find the basket item by its id
        $basketItem = Basket::findOrFail($basketId);

        //update the quantity with the new value from the request
        $basketItem->quantity = $request->quantity;

        //save the updated basket item
        $basketItem->save();

        //redirect back to the basket page with a success message
        return redirect()->route('basket.show')->with('success', 'Quantity updated successfully.');
    }
    public function removeFromBasket($basketId)
    {
        //find the basket item by its id
        $basketItem = Basket::findOrFail($basketId);

        //delete the basket item from the database
        $basketItem->delete();

        //redirect back to the basket page with a success message
        return redirect()->route('basket.show')->with('success', 'Item removed successfully.');
    }
    public function addToBasket(Request $request)
    {
        //validate the incoming data to make sure car_id exists and quantity is valid
        $request->validate([
            'car_id' => 'required|exists:cars,id', //ensure the car exists in the cars table
            'quantity' => 'required|integer|min:1', //ensure the quantity is an integer and greater than 0
        ]);

        //get the authenticated user's id
        $userId = Auth::id();

        //check if the car is already in the user's basket
        $basketItem = Basket::where('user_id', $userId) //filter by user_id
        ->where('car_id', $request->car_id) //filter by car_id
        ->first();

        if ($basketItem) {
            //if the car is already in the basket, update the quantity
            $basketItem->quantity += $request->quantity; //add the new quantity to the existing quantity
            $basketItem->save(); //save the updated basket item
        } else {
            //if the car is not in the basket, create a new basket item
            Basket::create([
                'user_id' => $userId, //set the user_id
                'car_id' => $request->car_id, //set the car_id
                'quantity' => $request->quantity, //set the quantity
            ]);
        }

        //redirect to the basket page with a success message
        return redirect()->route('basket.show')->with('success', 'Item added to basket.');
    }
}
