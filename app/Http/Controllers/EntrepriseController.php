<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    // ✅ Enregistrer une nouvelle entreprise
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
        ]);

        // 🔹 1. Création de l’utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entreprise',
        ]);

        // 🔹 2. Création de l’entreprise liée à cet utilisateur
        $entreprise = Entreprise::create([
            'user_id' => $user->id, // ✅ très important
            'nom_entreprise' => $request->nom_entreprise,
            'adresse' => $request->adresse,
            'domaine' => $request->domaine,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Entreprise créée avec succès !',
            'data' => $entreprise
        ], 201);
    }

    // ✅ Afficher une entreprise
    public function show($id)
    {
        $entreprise = Entreprise::with('user')->findOrFail($id);
        return response()->json($entreprise, 200);
    }

    // ✅ Modifier les informations d’une entreprise
    public function update(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $user = $entreprise->user; // Relation avec le modèle User

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'domaine' => 'nullable|string|max:255',
        ]);

        // 🔹 Mise à jour du User
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // 🔹 Mise à jour de l’entreprise
        $entreprise->update([
            'nom_entreprise' => $request->nom_entreprise,
            'adresse' => $request->adresse,
            'domaine' => $request->domaine,
        ]);

        return response()->json(['message' => 'Profil entreprise mis à jour avec succès !'], 200);
    }

    // ✅ Supprimer une entreprise
    public function destroy($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $user = $entreprise->user;

        // Supprimer l’entreprise et son user
        $entreprise->delete();
        if ($user) {
            $user->delete();
        }

        return response()->json([
            'message' => 'Entreprise supprimée avec succès !'
        ], 200);
    }
   public function dashboard() {
    $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    $candidatures = [5, 12, 9, 7, 10, 6];
    $offres = [3, 8, 5, 12, 6, 4];

    return view('entreprise.dashboard', compact('labels', 'candidatures', 'offres'));
}

public function listCVs() {
    $cvs = Candidature::with('etudiant.user', 'offre')->whereIn(
        'offre_stage_id',
        Auth::user()->entreprise->offres()->pluck('id')
    )->get();

    return view('entreprise.cvs', compact('cvs'));
}


}

