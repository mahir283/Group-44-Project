<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\CarReviews;
use App\Models\SavedCars;
use Illuminate\Support\Facades\File;

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
            $searchParts = explode(' ', $search); // Split the search term into parts

            // Check if there are at least two parts in the search term
            if (count($searchParts) >= 2) {
                $query->where('car_make', 'like', "%{$searchParts[0]}%")
                    ->where('car_model', 'like', "%{$searchParts[1]}%");
            }
            else {
                $query->where('car_make', 'like', "%$search%")
                    ->orWhere('car_model', 'like', "%$search%");
            }
        }

        // Filter by category (if provided)
        if ($category) {
            $query->where('category', $category);
        }

        // Execute the query
        $cars = $query->get();

        //get saved cars for the logged-in user
        $savedCars = Auth::check()
            ? SavedCars::where('user_id', Auth::id())->pluck('car_id')->toArray()
            :[];
        //return the filtered cars to the view
        return view('carsPage', ['cars' => $cars, 'savedCars' => $savedCars]);
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

    public function loadProducts()
    {
        if (Auth::user()) {
            if (Auth::User()->user_type == 'admin') {
                $cars = Cars::all();

                return view('productsListAdmin', ['cars' => $cars]);
            }

        }
        return redirect('/')->with('success', 'You do not have the right privileges to access this page!');
    }

    public function deleteCar(Request $request)
    {
        $car_id = $request->input('car_id');
        $car = Cars::where('id', $car_id)->first();

        if ($car) {
            $car->delete();
        }

        return back();
    }

    public function adminEditCar(Request $request){
        $car_id = $request->input('car_id');
        $car = Cars::find($car_id);
        return view ('prAmendment' , compact('car'));
    }

    public function submitEditCar(Request $request){
        $request->validate([
            'carMake' => 'required|regex:/^(?!\s*$).+/',
            'carModel' => 'required|regex:/^(?!\s*$).+/',
            'description' => 'required|regex:/^(?!\s*$).+/',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'colour' => 'required|regex:/^(?!\s*$).+/',
            'year' => 'required|numeric',
            'mileage' => 'required|numeric',
            'fuel' => 'required|in:petrol,diesel',
            'transmission' => 'required|in:manual,automatic',
            'category' => 'required|in:SUV,Coupe,Saloon,Van,Hatchback',
            'carImage' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',

        ]);




        $car = Cars::find($request->carId);
        if(is_null($car)) {
            return redirect('/');
        }

        if($request->hasFile('carImage')) {
            $carImage = $request->file('carImage')->store('carImages');
            $check = true;
        }else{
            $check = false;
        }


        if($check) {
            $car->update([
                'car_make' => $request->input('carMake'),
                'car_model' => $request->input('carModel'),
                'car_image' => $carImage,
                'car_description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'colour' => $request->input('colour'),
                'year' => $request->input('year'),
                'mileage' => $request->input('mileage'),
                'fuel' => $request->input('fuel'),
                'transmission' => $request->input('transmission'),
                'category' => $request->input('category'),

            ]);
        } else{
            $car->update([
                'car_make' => $request->input('carMake'),
                'car_model' => $request->input('carModel'),
                'car_description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'colour' => $request->input('colour'),
                'year' => $request->input('year'),
                'mileage' => $request->input('mileage'),
                'fuel' => $request->input('fuel'),
                'transmission' => $request->input('transmission'),
                'category' => $request->input('category'),

            ]);
        }



        return redirect('/productsListAdmin')->with('success', 'Car has been successfully edited!');





    }
    public function addCar(){
        if (Auth::user()) {
            if (Auth::User()->user_type == 'admin') {

                return view('productAdd');
            }

        }
        return redirect('/')->with('success', 'You do not have the right privileges to access this page!');
    }

    public function submitAddCar(Request $request){
        $request->validate([
            'carMake' => 'required|regex:/^(?!\s*$).+/',
            'carModel' => 'required|regex:/^(?!\s*$).+/',
            'description' => 'required|regex:/^(?!\s*$).+/',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'colour' => 'required|regex:/^(?!\s*$).+/',
            'year' => 'required|numeric',
            'mileage' => 'required|numeric',
            'fuel' => 'required|in:petrol,diesel',
            'transmission' => 'required|in:manual,automatic',
            'category' => 'required|in:SUV,Coupe,Saloon,Van,Hatchback',
            'carImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        $carImage = $request->file('carImage')->store('carImages');
        Cars::create([
            'car_make' => $request->input('carMake'),
            'car_model' => $request->input('carModel'),
            'car_image' => $carImage,
            'car_description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'colour' => $request->input('colour'),
            'year' => $request->input('year'),
            'mileage' => $request->input('mileage'),
            'fuel' => $request->input('fuel'),
            'transmission' => $request->input('transmission'),
            'category' => $request->input('category'),
        ]);
        return redirect('/productsListAdmin')->with('success', 'Car has been successfully added!');

    }

}
