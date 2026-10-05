<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

        return redirect()->route('viewusers')->with('success', 'User created successfully!');
    }

    //Edit data
    public function edit($id)
    {
        // $user = DB::table('users')->where('id', $id)->first();

        // if (!$user){
        // abort(404, 'User not found');
        // }

        //I found a simpler alternative

        $user = User::findOrFail($id);

        return view('edituser', compact('user'));
    }


    // Validate input data


    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone'    => 'nullable|string|max:50',
            'role'     => 'required|string|max:50',
            'team'     => 'nullable|string|max:255',
        ])->validated();

        DB::table('users')->where('id', $id)->update([
            'name' => $validated['name'],
            'username'   => $validated['username'],
            'phone'      => $validated['phone'] ?? null,
            'role'       => $validated['role'],
            'team'       => $validated['team'] ?? null,
            'updated_at' => now(),
        ]);
        return redirect()->route('viewusers')->with('success', 'User updated successfully!');
    }

    //Delete user record

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('viewusers')->with('success', 'User deleted successfully!');
    }
}
