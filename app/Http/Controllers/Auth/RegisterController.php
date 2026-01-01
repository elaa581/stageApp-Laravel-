<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // ======================
    // REGISTER ETUDIANT
    // ======================
    public function registerEtudiant(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'cin' => 'required|string|max:20',
        'date_naissance' => 'required|date',
        'classe' => 'required|string|max:100',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'etudiant',
    ]);

    Etudiant::create([
        'user_id' => $user->id,
        'prenom' => $request->prenom,
        'cin' => $request->cin,
        'date_naissance' => $request->date_naissance,
        'classe' => $request->classe,
    ]);

    // 🔐 CONNECTER L’UTILISATEUR
    Auth::login($user);

    // 🔁 REDIRECTION
    return redirect()->route('etudiant.dashboard');
}

    // ======================
    // REGISTER ENTREPRISE
    // ======================
    public function registerEntreprise(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entreprise',
        ]);

        $entreprise = Entreprise::create([
            'user_id' => $user->id,
            'nom_entreprise' => $request->nom_entreprise,
            'adresse' => $request->adresse,
            'domaine' => $request->domaine,
        ]);

       Auth::login($user);

       return redirect()->route('entreprise.dashboard');

    }
}

