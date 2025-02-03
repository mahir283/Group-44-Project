<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\CarReviews;
use Illuminate\View\View; // Add this import

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters for search and category
        $search = $request->query('search');
        $category = $request->query('category');

        // Begin the query for fetching cars
        $query = Cars::query();

        // Filter by search (make or model)
        if ($search) {
            $query->where('car_make', 'like', "%$search%")
                ->orWhere('car_model', 'like', "%$search%");
        }

        // Filter by category (if provided)
        if ($category) {
            $query->where('category', $category);
        }

        // Execute the query
        $cars = $query->get();

        // Return the filtered cars to the view
        return view('carsPage', ['cars' => $cars]);
    }

    // Method to display a single car's details
    public function show($car_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application // Correct return type hint
    {
        // Fetch car details
        $car = Cars::findOrFail($car_id);

        // Fetch reviews for the car with related user data
        $reviews = CarReviews::where('car_id', $car_id)
            ->with('user:id,username') // Fetch the username with the review
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the view with car and reviews data
        return view('carDetails', compact('car', 'reviews'));
    }
}
