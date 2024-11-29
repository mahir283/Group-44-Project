<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Cars;

class ProductsController extends Controller
{
    public function index(): view
    {
        $cars = Cars::all();
        return view('carsPage',['cars' => $cars]);

    }

    public function show($car_id){
        $car = Cars::find($car_id);
        if(is_null($car)){
            return redirect()->route('home');
        }
        return view('carDetails', array('car'=> $car));
    }
}
