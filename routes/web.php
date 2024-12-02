<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;



Route::get('/userLogin', function () {
    return view('loginUser');
});

Route::get('/adminLogin', function () {
    return view('loginAdmin');
});

Route::get('/', [CarController::class, 'displayRandom'])->name('home');


Route::get('/userRegister', function () {
    return view('registerUser');
});

Route::get('/contact', function () {
    return view('ContactPage');
});

Route::get('/basket', function () {
    return view('BasketPage');
});


Route::get('/products',[ProductsController::class, 'index']);

Route::get('/carDetails/{car_id}', action: [ProductsController::class, 'show']);


