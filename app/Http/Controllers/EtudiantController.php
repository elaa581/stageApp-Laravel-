<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\condidatures;
use App\Models\Etudiant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function store(Request $request)
{
    // ✅ 1. Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'cin' => 'required|string|max:20',
        'date_naissance' => 'required|date',
        'classe' => 'required|string|max:100',
    ]);

     // 2️⃣ Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'etudiant',
        ]);

        // 3️⃣ Création de l'étudiant lié à l'utilisateur
        $etudiant = Etudiant::create([
            'user_id' => $user->id,
            'prenom' => $request->prenom,
            'cin' => $request->cin,
            'date_naissance' => Carbon::createFromFormat('Y-m-d', $request->date_naissance),
            'classe' => $request->classe,
        ]);

    // ✅ 3. Retour JSON
    return response()->json([
        'status' => 'success',
        'message' => 'Étudiant créé avec succès !',
        'data' => $etudiant
    ], 201);
}
// Afficher le profil d’un étudiant
    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return response()->json($etudiant,200);
    }
    public function update(Request $request, $id)
{
    $etudiant = Etudiant::findOrFail($id);
    $user = $etudiant->user; // Relation user() dans le modèle Etudiant

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'cin' => 'nullable|string|max:8',
        'date_naissance' => 'nullable|date',
        'classe' => 'nullable|string|max:255',
    ]);

    // 🔹 Mettre à jour les infos de l'utilisateur
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // 🔹 Mettre à jour les infos spécifiques à l’étudiant
    $etudiant->update([
        'cin' => $request->cin,
        'date_naissance' => $request->date_naissance,
        'classe' => $request->classe,
    ]);

    return response()->json(['message' => 'Profil mis à jour avec succès !'], 200);
}

//La liste publique des CVs
public function listCVs()
{
    $candidatures = Candidature::with('etudiant.user')->get();

    return response()->json([
        'status' => 'success',
        'candidatures' => $candidatures
    ]);
}



}
