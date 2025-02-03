<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarReviews;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;

class CarReviewsController extends Controller
{
    // Store the review in the database
    public function store(Request $request, $car_id)
    {
        // Ensure user is logged in before submitting the review
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('error', 'You must be logged in to leave a review.');
        }

        // Validate incoming data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Create a new review record
        $review = CarReviews::create([
            'user_id' => Auth::id(),
            'car_id' => $car_id,
            'rating' => $validatedData['rating'],
            'review' => $validatedData['comment'],
        ]);

        return redirect()->route('car.details', ['id' => $car_id])
            ->with('success', 'Review submitted successfully!');
    }
}
