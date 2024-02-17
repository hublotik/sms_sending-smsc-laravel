<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        $created_users = User::all();
        return view('welcome', compact(['created_users']));
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate(
            [
                'name' => $request->input('name'),
                'lname' => $request->input('lname'),
                'email' =>  $request->input('email'),
                'password' =>  $request->input('password'),
                'phone_number' => $request->input('phone_number'),
                'birth_date' => $request->input('birth_date')
            ]
        );

        return redirect()->route('welcome')->with('success', 'User created successfully');
    }
}
