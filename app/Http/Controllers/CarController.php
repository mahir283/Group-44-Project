<?php
namespace App\Http\Controllers;

use App\Models\Cars; // Ensure you are using the correct model
use Illuminate\View\View;

class CarController extends Controller
{
// Method to display 3 random cars on the homepage
public function displayRandom(): View {
$cars = Cars::randomCars(3);  // Assuming you have a scope or method in the Cars model to get random cars

return view('homepage', compact('cars'));
}

// Method to display a single car's details
public function show($id)
{
$car = Cars::findOrFail($id);  // Corrected to use 'Cars' model

return view('carDetails', compact('car'));  // Pass the car to the carDetails.blade.php view
}
}
