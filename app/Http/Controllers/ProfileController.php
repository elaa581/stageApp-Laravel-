<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
   public function show()
{
    $user = Auth::user();  //Undefined method 'user'.

    if ($user->role === 'etudiant') {
        $etudiant = $user->etudiant;
        return view('etudiant.profilEtudiant', compact('user'));
    }

     if ($user->role === 'entreprise') {
            $entreprise = $user->entreprise; // ← Ajoutez cette ligne

            // Vérifier que l'entreprise existe
            if (!$entreprise) {
                abort(404, 'Profil entreprise non trouvé');
            }
            return view('entreprise.profil', compact('user', 'entreprise')); // ← Passez $entreprise
        }

    if ($user->role === 'admin') {
        return view('admin.profil', compact('user'));
    }
}


    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.edit')
            ->with('success', 'Profil mis à jour avec succès');
    }

    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe incorrect']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.edit')
            ->with('success', 'Mot de passe modifié');
    }
}
