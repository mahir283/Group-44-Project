<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userLogin', function () {
    return view('loginUser');
});

Route::get('/adminLogin', function () {
    return view('loginAdmin');
});
