<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'active')->get();
        return view('viewusers', compact('users'));
    }

    public function create()
    {
        return view('category.addusers');
    }

public function store(Request $request)
{
    // 1. Validate using columns that actually exist in your database
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'nullable|string|max:255',
        'email'      => 'required|string|email|max:255|unique:users,email',
        'role'       => 'required|in:employee,admin',
        'password'   => 'required|string|min:8|confirmed',
    ]);

    // 2. Create the user using your database column names
    User::create([
        'first_name' => $validated['first_name'],
        'last_name'  => $validated['last_name'] ?? '',
        'email'      => $validated['email'],
        'role'       => $validated['role'],
        'password'   => bcrypt($validated['password']),
        'status'     => 'active',
    ]);

    return redirect()->route('viewusers')->with('success', 'User added successfully!');
}


    public function deactivate ($id){
        
    // Change the status
    $user = User::findOrFail($id);
    $user->status='inactive';
    $user->save();
    return redirect()->back()->with('success','User deactivated successfully.');  
    }
}