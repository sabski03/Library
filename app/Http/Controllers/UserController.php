<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('users.index', compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:9',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role_id = $request->input('role');
        $user->update();

        return redirect('users')->with('status', 'User data updated successfully');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return redirect('users')->with('delete', 'User Deleted Successfully');
    }
}
