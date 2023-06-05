<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where([
            'username' => $request->username
        ])->first();

        if ($user->status != 'active') {
            return redirect()->back()->withErrors(['failed' => 'Your account is not active']);
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/');
        } else {
            return redirect()->back()->withErrors(['failed' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
