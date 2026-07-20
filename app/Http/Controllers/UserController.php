<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('viewusers', compact('users'));
    }

    public function create()
    {
        return view('category.addusers');
    }

    public function store(Request $request)
    {
        // FIXED: Validation rules aligned strictly with the database layout
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role'     => 'required|in:employee,admin',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // FIXED: Data mapping matches the migration properties
        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'role'     => $validated['role'],
            'password' => bcrypt($validated['password']),
            'status'   => 'active',
        ]);

        return redirect()->route('viewusers')->with('success', 'User created successfully!');
    }
}