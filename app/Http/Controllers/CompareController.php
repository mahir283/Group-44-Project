<?php

namespace App\Http\Controllers;


use App\Models\Cars;
use App\Models\SavedCars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller

{

    public function index(Request $request){

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the compare page!');
        }
        $userId = Auth::id();

        $savedCars = SavedCars::where('user_id', $userId)->with('car')->get();

        $car1 = null;
        $car2 = null;


        if ($request->has('car1_id') && $request->has('car2_id')) {
            $car1 = Cars::find($request->car1_id);
            $car2 = Cars::find($request->car2_id);
        }

        return view('comparePage', compact('savedCars', 'car1', 'car2'));
    }
}
