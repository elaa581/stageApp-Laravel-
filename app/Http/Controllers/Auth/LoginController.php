<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 🔐 LOGIN WEB
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect'
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // 🔁 Redirection par rôle
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'entreprise') {
            return redirect('/entreprise/dashboard');
        }

        return redirect('/etudiant/dashboard');
    }

    // 🧾 Formulaire login
    public function showLoginForm()
    {
        return view('auth.login');
    }
}

