<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // You can pass data here later
        // $users = User::all();
        // return view('viewusers', compact('users'));
        
        return view('viewusers');
    }

    public function create()
    {
        return view('category.addusers');
    }

    public function store(Request $request)
    {
        // Your store logic here
        // User::create($request->all());
        return redirect()->route('viewusers')->with('success', 'User created successfully!');
    }
}