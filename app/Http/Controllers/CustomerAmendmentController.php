<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerAmendmentController extends Controller
{
    // Show the customer amendment form with pre-filled data
    public function show($id)
    {
        $customer = User::findOrFail($id);
        return view('customerAmendment', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $customer->update($request->only([
            'username',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'user_type'
        ]));

        return redirect()->route('customerList')->with('success', 'Customer details updated successfully!');
    }
}
