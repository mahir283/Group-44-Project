<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\CarReviews;
use App\Models\SavedCars;
class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters for search and category
        $search = $request->query('search');
        $category = $request->query('category');

        // Begin the query for fetching cars
        $query = Cars::query();

        if ($request->has('year_from') && $request->year_from) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->has('year_to') && $request->year_to) {
            $query->where('year', '<=', $request->year_to);
        }
        if ($request->has('mileage_from') && $request->mileage_from) {
            $query->where('mileage', '>=', $request->mileage_from);
        }
        if ($request->has('mileage_to') && $request->mileage_to) {
            $query->where('mileage', '<=', $request->mileage_to);
        }
        if ($request->has('transmission') && $request->transmission) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->has('fuel') && $request->fuel) {
            $query->where('fuel', $request->fuel);
        }
        if ($request->has('colour') && is_array($request->colour)) {
            $query->whereIn('colour', $request->colour);
        }
        if ($request->has('price_from') && $request->price_from) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->has('price_to') && $request->price_to) {
            $query->where('price', '<=', $request->price_to);
        }

        //filter by search (make or model)
        if ($search) {
            $query->where('car_make', 'like', "%$search%")
                ->orWhere('car_model', 'like', "%$search%");
        }

        // Filter by category (if provided)
        if ($category) {
            $query->where('category', $category);
        }

        // Execute the query
        $cars = Cars::all();

        //get saved cars for the logged-in user
        $savedCars = Auth::check()
            ? SavedCars::where('user_id', Auth::id())->pluck('car_id')->toArray()
            :[];
        //return the filtered cars to the view
        return view('carsPage', compact('cars', 'savedCars'));
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
