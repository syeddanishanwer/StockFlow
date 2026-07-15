<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        
        $validated=$request->validate([
        'first_name'=>'required|string|max:255',
        'last_name'=>'required|string|max:255',
        'email'=>'required|email|unique:users,email',
        'phone'=>'nullable|string|max:255',
        'role'=>'required|in:employee,admin',
        'team'=>'nullable|string|max:255',
        'notes'=>'nullable|string',
        'password'=>'required|string|min:8|confirmed',
        ]);

    // Create the user
    $user = User::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'role' => $validated['role'],
        'team' => $validated['team'] ?? null,
        'notes' => $validated['notes'] ?? null,
        'password' => bcrypt($validated['password']),
        'status' => 'active',
    ]);
        return redirect()->route('viewusers')->with('success', 'User created successfully!');
    }
}