<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;

// Admin Login (if needed)
Route::get('/adminLogin', function () {
    return view('loginAdmin');
});

// Home route
Route::get('/', [CarController::class, 'displayRandom'])->name('home');

// User Registration routes
Route::get('/userRegister', [RegisterController::class, 'show']);
Route::post('/userRegister', [RegisterController::class, 'register'])->name('userRegister');

// User Login routes
Route::get('/userLogin', [LoginController::class, 'show'])->name('userLogin');
Route::post('/userLogin', [LoginController::class, 'login'])->name('userLogin');
Route::post('/userLogout', [LoginController::class, 'logout'])->name('userLogout');

// About Us route
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

// Contact Page route
Route::get('/contact', function () {
    return view('ContactPage');
});

// Basket Page route
Route::get('/basketPage', function () {
    if (!Auth::check()) {
        // Redirect to login route with a message if not logged in
        return redirect()->route('userLogin')->with('message', 'Please Log in to access the basket page');
    }

    // If the user is logged in, show the basket page
    return app(BasketController::class)->showBasket();
})->name('basket.show');

// Add item to basket route
Route::post('/basketPage', [BasketController::class, 'addToBasket'])->name('basket.add')->middleware('auth');

// Products Page route
Route::get('/products', [ProductsController::class, 'index']);

// Car Details page
Route::get('/carDetails/{car_id}', [ProductsController::class, 'show']);

// Form routes (if any forms are required)
Route::get('form', [FormController::class, 'showForm']);
Route::post('form', [FormController::class, 'submitForm']);
Route::post('/contact-submit', [FormController::class, 'formValidation'])->name('contact.submit');

// Login and Registration view routes (optional for front-end)
Route::view('/loginUser', 'loginUser')->name('login');
Route::view('/registerUser', 'registerUser');

// Update Basket Item Quantity (PUT request)
Route::put('/basket/update/{basketId}', [BasketController::class, 'updateQuantity'])->name('basket.updateQuantity')->middleware('auth');

// Remove Item from Basket (DELETE request)
Route::delete('/basket/remove/{basketId}', [BasketController::class, 'removeFromBasket'])->name('basket.remove')->middleware('auth');


Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
