<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
//
            return view('loginUser')->with('success', 'You are already logged in!');
        }
        return view('loginUser');

    }
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/') ->with('success', 'You are logged in successfully!');
        }

        return redirect('/userLogin')->with('fail', 'Invalid credentials. Try again or Register!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You are logged out successfully!');
    }
}
