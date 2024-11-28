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
        return view('products',['cars' => $cars]);

    }

    public function show($car_id){
        $car = DB::table('cars')->where('car_id','=','%'.$car_id.'%')->get();
        return view('carDetails', array('car'=> $car));
    }
}
