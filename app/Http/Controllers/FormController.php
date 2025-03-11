<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller


{

    public function formValidation(Request $request){

        $dataValidation = $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required|email',
            'PhoneNumber' => 'required|numeric',
            'Query' => 'required',

        ]);

        Form::create([
            'first_name' => $dataValidation['FirstName'],
            'last_name' => $dataValidation['LastName'],
            'email' => $dataValidation['Email'],
            'phone_number' => $dataValidation['PhoneNumber'],
            'message' => $dataValidation['Query'],
            ]);

        return redirect()->back()->with('success', 'Form submitted successfully, we will get back to you soon.');

    }

}
