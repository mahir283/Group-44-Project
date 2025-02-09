<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PreviousOrdersController;  // Import the new controller
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', [CarController::class, 'displayRandom'])->name('home');

// About Us route
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

// Contact Page route
Route::get('/contact', function () {
    return view('ContactPage');
});

// Products Page route
Route::get('/products', [ProductsController::class, 'index']);

// Car Details Page
Route::get('/carDetails/{car_id}', [ProductsController::class, 'show']);

// User Registration
Route::get('/userRegister', [RegisterController::class, 'show']);
Route::post('/userRegister', [RegisterController::class, 'register'])->name('userRegister');

// Admin Registration
Route::get('/adminRegister', [RegisterController::class, 'showAdmin']);
Route::post('/adminRegister', [RegisterController::class, 'registerAdmin'])->name('adminRegister');

// User Login
Route::get('/userLogin', [LoginController::class, 'show'])->name('userLogin');
Route::post('/userLogin', [LoginController::class, 'login'])->name('userLogin');
Route::post('/userLogout', [LoginController::class, 'logout'])->name('userLogout');

// Admin Login
Route::get('/adminLogin', [LoginController::class, 'showAdmin'])->name('adminLogin');
Route::post('/adminLogin', [LoginController::class, 'loginAdmin'])->name('adminLogin');
Route::post('/adminLogout', [LoginController::class, 'logout'])->name('adminLogout');

// User Dashboard (Protected)
Route::get('/dashboard', function () {
    return view('UserDashboard');
})->middleware('auth')->name('user.dashboard');

// Previous Orders Page (Updated to use the controller)
Route::get('/previous-orders', [PreviousOrdersController::class, 'show'])->middleware('auth')->name('previous.orders');

// Show Basket Page
Route::get('/basketPage', function () {
    if (!Auth::check()) {
        return redirect()->route('userLogin')->with('message', 'Please log in to access the basket page.');
    }
    return app(BasketController::class)->showBasket();
})->name('basket.show');

// Add Item to Basket
Route::post('/basketPage', [BasketController::class, 'addToBasket'])
    ->name('basket.add')
    ->middleware('auth');

// Update Basket Item Quantity
Route::put('/basket/update/{basketId}', [BasketController::class, 'updateQuantity'])
    ->name('basket.updateQuantity')
    ->middleware('auth');

// Remove Item from Basket
Route::delete('/basket/remove/{basketId}', [BasketController::class, 'removeFromBasket'])
    ->name('basket.remove')
    ->middleware('auth');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');

// Contact Form
Route::get('form', [FormController::class, 'showForm']);
Route::post('form', [FormController::class, 'submitForm']);
Route::post('/contact-submit', [FormController::class, 'formValidation'])->name('contact.submit');

// Login & Register Views
Route::view('/loginUser', 'loginUser')->name('login');
Route::view('/registerUser', 'registerUser');




// Route to view car details
Route::get('/car/{id}', [CarController::class, 'show'])->name('car.details');

// Route to add car to the basket
Route::post('/add-to-basket/{id}', [BasketController::class, 'addToBasket'])->name('addToBasket');

// Route to add car to basket (Reorder functionality)
Route::post('/add-to-basket', [BasketController::class, 'addToBasket'])->name('addToBasket');

// Route for the next page
Route::get('/next-page', [PreviousOrdersController::class, 'nextPage'])->name('nextPage');
