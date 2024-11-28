<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\View\View;

class CarController extends Controller
{

    public function displayRandom(): View {
        $cars = Cars::randomCars(3);
        return view ('homepage', compact('cars' ));

    }

}
