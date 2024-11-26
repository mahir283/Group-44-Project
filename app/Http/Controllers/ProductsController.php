<?php

namespace App\Http\Controllers;

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
}
