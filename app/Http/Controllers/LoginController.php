<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return view('loginUser')->with('success', 'You are already logged in!');
        }

        // Store the intended URL in the session
        session(['url.intended' => url()->previous()]);

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

            // Redirect based on user_type (only added for your requirements)
            if (Auth::user()->user_type === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'You are logged in as an admin!');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'You are logged in as a customer!');
            }
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
