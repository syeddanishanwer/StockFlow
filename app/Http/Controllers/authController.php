<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function match(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'username' => ['required'],
            'pwd'      => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['pwd']])) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->intended('/dashboard');
        }

        // If login fails, send back with error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
}
