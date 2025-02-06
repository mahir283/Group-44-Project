<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\CarReviews;
use Illuminate\View\View; // Add this import

class CarController extends Controller
{
    // Method to display 3 random cars on the homepage
    public function displayRandom(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $cars = Cars::randomCars(3); // Fetch 3 random cars
        return view('homepage', compact('cars'));
    }

    // Method to display a single car's details
    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application // Correct return type hint
    {
        // Fetch car details
        $car = Cars::findOrFail($id);

        // Fetch reviews for the car with related user data
        $reviews = CarReviews::where('car_id', $id)
            ->with('user:id,username') // Fetch the username with the review
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the view with car and reviews data
        return view('carDetails', compact('car', 'reviews'));
    }
}
