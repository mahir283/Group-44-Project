<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userLogin', function () {
    return view('loginUser');
});

Route::get('/adminLogin', function () {
    return view('loginAdmin');
});

Route::get('/home', [CarController::class, 'displayRandom']);

Route::get('/userRegister', function () {
    return view('registerUser');
});

Route::get('/products',[ProductsController::class,'index']);

Route::get('/carDetails', function () {
    return view('carDetails');
});
