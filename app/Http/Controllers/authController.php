<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function match(Request $request)
    {
        // 1. Validate inputs based on form input names: 'username' and 'pwd'
        $credentials = $request->validate([
            'username' => ['required'],
            'pwd'      => ['required'],
        ]);

        // 2. Debug Check A: Verify if user exists in the database
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'User not found in Aiven DB on Render.'
            ])->onlyInput('username');
        }

        // 3. Debug Check B: Verify password hash
        if (!Hash::check($credentials['pwd'], $user->password)) {
            return back()->withErrors([
                'username' => 'User found, but password hash check failed.'
            ])->onlyInput('username');
        }

        // 4. Attempt authentication
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['pwd']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 5. Fallback for session/cookie failure
        return back()->withErrors([
            'username' => 'Session regeneration failed. Check TrustProxies or APP_URL on Render.',
        ])->onlyInput('username');
    }
}