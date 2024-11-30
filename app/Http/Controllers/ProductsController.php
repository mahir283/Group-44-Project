<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Cars;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        //get query parameters for search and category
        $search = $request->query('search');
        $category = $request->query('category');

        //begin the query for fetching cars
        $query = Cars::query();

        //filter by search (make or model)
        if ($search) {
            $query->where('car_make', 'like', "%$search%")
                ->orWhere('car_model', 'like', "%$search%");
        }

        //filtering by a category (if provided)
        if ($category) {
            $query->where('car_category', $category); // Filter by the correct column name (car_category)
        }

        //execute the query
        $cars = $query->get();

        //return the filtered cars to the view
        return view('carsPage', ['cars' => $cars]);
    }
    public function show($car_id){
        $car = Cars::find($car_id);
        if(is_null($car)){
            return redirect()->route('home');
        }
        return view('carDetails', array('car'=> $car));
    }
}
