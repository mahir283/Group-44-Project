<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userLogin', function () {
    return view('loginUser');
});

Route::get('/adminLogin', function () {
    return view('loginAdmin');
});


Route::get('/userRegister', function () {
    return view('registerUser');
});

Route::get('/products',[ProductsController::class,'index']);
