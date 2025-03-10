<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerAmendmentController extends Controller
{
    // Show the customer amendment form with pre-filled data
    public function show($id)
    {
        $customer = User::findOrFail($id); // Fetch the customer by ID
        return view('customerAmendment', compact('customer'));
    }

    // Update the customer details
    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id); // Fetch the customer by ID

        // Update the fields present in the request, including user_type
        $customer->update($request->only([
            'username',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'user_type' // Add this line
        ]));

        return redirect()->route('customerList')->with('success', 'Customer details updated successfully!');
    }
}
