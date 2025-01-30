<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{
    public function show(){
        if (Auth::check()) {
            return redirect('/')->with('success', 'You are already logged in!');
        }
        return view('registerUser');
    }

    public function showAdmin(){
        if (Auth::check()) {
            return redirect('/')->with('success', 'You are already logged in!');
        }
        return view('registerAdmin');
    }

    public function register(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'telnum' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone_number' => $request->telnum,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return redirect('/userLogin')->with('success', 'Registration Successful!, Please Login');


    }

    public function registerAdmin(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'telnum' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone_number' => $request->telnum,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return redirect('/adminLogin')->with('success', 'Registration Successful!, Please Login');


    }

}
