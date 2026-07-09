<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function match(Request $request)
    {
        $user = $request->username;
        $pass = $request->pwd;

        Auth::attempt(['username'=>$user, 'password'=>$pass]);

        return view('dashboard');
    }
}
