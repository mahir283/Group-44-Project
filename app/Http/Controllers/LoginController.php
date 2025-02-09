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
            return view('loginUser')->with('success', 'You are already logged in!');
        }

        // Store the intended URL in the session
        session(['url.intended' => url()->previous()]);

        return view('loginUser');
    }

    public function showAdmin()
    {
        if (Auth::check()) {
            return view('loginAdmin')->with('success', 'You are already logged in!');
        }

        return view('loginAdmin');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to the intended URL or home page
            return redirect()->intended(route('home'))->with('success', 'You are logged in successfully!');
        }

        return redirect('/userLogin')->with('fail', 'Invalid credentials. Try again or Register!');
    }

    public function loginAdmin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'You are logged in successfully!');
        }

        return redirect('/adminLogin')->with('fail', 'Invalid credentials. Try again or Register!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You are logged out successfully!');
    }
}
