<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Entreprise;
use App\Models\OffreStage;
use App\Models\Candidature;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
{
    $totalOffres = \App\Models\OffreStage::count();
    $totalCvs = \App\Models\Candidature::count();
    $totalEtudiants = \App\Models\Etudiant::count();
    $totalEntreprises = \App\Models\Entreprise::count();

    return view('admin.dashboard', compact('totalOffres', 'totalCvs', 'totalEtudiants', 'totalEntreprises'));
}

public function allOffres()
{
    $offres = \App\Models\OffreStage::with('entreprise')->get();
    return view('admin.offres', compact('offres'));
}
public function allCvs()
{
    $cvs = \App\Models\Candidature::with('etudiant.user', 'offre')->get();
    return view('admin.cvs', compact('cvs'));
}


public function createEntreprise()
{
    return view('admin.create-entreprise');
}

public function storeEntreprise(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'nom_entreprise' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'domaine' => 'required|string|max:255',
    ]);

    // Créer l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'entreprise',
    ]);

    // Créer l'entreprise
    Entreprise::create([
        'user_id' => $user->id,
        'nom_entreprise' => $request->nom_entreprise,
        'adresse' => $request->adresse,
        'domaine' => $request->domaine,
    ]);

    return redirect()->route('admin.entreprises.store')->with('success', 'Entreprise ajoutée avec succès');
}

public function allEntreprises()
{
    $entreprises = Entreprise::with('user')->get();
    return view('admin.allentreprises', compact('entreprises'));
}

}
