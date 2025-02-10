<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SavedCars;
use Illuminate\Support\Facades\Auth;

class SavedCarController extends Controller
{
    public function toggleSave(Request $request)
    {
        $userId = Auth::id();

        $carId = $request->input('car_id');

       //Check if the car is already saved
        $existing = SavedCars::where('user_id', $userId)->where('car_id', $carId)->first();

        if (!$userId){
            return redirect()->route('userLogin')->with('fail', 'Please log in to Save a Car.');
        }
        if ($existing) {
            $existing->delete();
        } else {
            SavedCars::create(['user_id' => $userId, 'car_id' => $carId, 'saved_date' => Carbon::now(),]);
        }

        return back();
    }

    public function getSavedCars()
    {
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('fail', 'Please log in to access the saved cars page.');
        }

        $userId = Auth::id();
        $savedCars = SavedCars::where('user_id', $userId)->with('car')->get(); // Load related car details

        return view('savedCars', ['savedCars' => $savedCars]); // Pass data to view
    }
}
