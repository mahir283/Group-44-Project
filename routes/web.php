<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CheckoutController;


Route::get('/adminLogin', function () {
    return view('loginAdmin');
});

Route::get('/', [CarController::class, 'displayRandom'])->name('home');


Route::get('/userRegister', [RegisterController::class, 'show']);
Route::post('/userRegister', [RegisterController::class, 'register'])->name('userRegister');

Route::get('/userLogin',[LoginController::class, 'show']);
Route::post('/userLogin', [LoginController::class, 'login'])->name('userLogin');
Route::post('/', [LoginController::class, 'logout'])->name('userLogout');

Route::get('/aboutUs', function () {
    return view('aboutUs');
});


Route::get('/contact', function () {
    return view('ContactPage');
});

Route::get('/basketPage', [BasketController::class, 'showBasket']);
Route::post('/basketPage', [BasketController::class, 'addToBasket'])->name('basketPage');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
});
Route::get('/userLogin', [LoginController::class, 'show'])->name('login');


Route::get('/products',[ProductsController::class, 'index']);

Route::get('/carDetails/{car_id}', action: [ProductsController::class, 'show']);

Route::get('form', [FormController::class, 'showForm']);
Route::post('form', [FormController::class, 'submitForm']);
Route::post('/contact-submit', [FormController::class, 'formValidation'])->name('contact.submit');

Route::view('/loginUser', 'loginUser');
Route::view('/registerUser', 'registerUser');




