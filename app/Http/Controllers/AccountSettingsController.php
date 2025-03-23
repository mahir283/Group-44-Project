<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountSettingsController extends Controller
{
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('fail', 'You must be logged in to access account settings');
        }

        $user = Auth::user();
        return view('accountSettings', compact('user'));
    }

    public function updateDetails(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('fail', 'Unauthorized access');
        }

        $user = Auth::user();

        // Validate the form input
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|unique:users,phone_number,' . $user->id,
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        // Update user details
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return redirect()->route('account.settings')->with('success', 'Account details updated successfully');
    }

    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('userLogin')->with('fail', 'Unauthorized access');
        }

        // Validate the password form
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('fail', 'Current password is incorrect');
        }

        // Update the password in the database
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('account.settings')->with('success', 'Password updated successfully');
    }
}
