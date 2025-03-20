<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerListController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
    }
            $users = $query->get();

            return view('customerList', compact('users'));

        }

    public function deleteUser($id): \Illuminate\Http\RedirectResponse
    {

        $user = User::find($id);

        if($user){
            $user->orders()->delete();
            $user -> addresses()-> delete();
            $user -> delete();
            return redirect()->route('customerList')->with('success', 'User deleted successfully');
        }

        return redirect()->route('customerList')->with('error', 'Cannot delete user!');
    }

}
