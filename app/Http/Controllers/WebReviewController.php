<?php

namespace App\Http\Controllers;

use App\Models\WebReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebReviewController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'required|string',
        ]);

        if(!Auth::check()){
            return redirect()->back()->with('error', 'You must login before submitting a review!');
        }

        WebReview::create([
            'user_id'=>Auth::id(),
            'rating'=>$request->rating,
            'comment'=>$request->comment,
        ]);

        return redirect()->back()->with('success','Review Submitted!');
    }
}
