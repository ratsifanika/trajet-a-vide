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

        if (Auth::attempt($request->only("email", "password"))) {
            return redirect()->intended('/');
        }

        return back()->withErrors('The provided credentials are wrong');
    }

    public function logout(Request $request)
    {
         // Déconnecte l'utilisateur
         Auth::logout();

         // Invalide la session de l'utilisateur (optionnel)
         request()->session()->invalidate();

         // Regénère le token CSRF (optionnel)
         request()->session()->regenerateToken();

         // Redirige vers la page d'accueil ou une autre route
         return redirect('/');
    }



}
