<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if (Auth::attempt($request->only("login", "password"))) {
            return redirect()->intended('/');
        }

        return back()->withErrors('The provided credentials are wrong');
    }



}
