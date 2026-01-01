<?php

namespace App\Http\Controllers;

use App\Models\OffreStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreStageController extends Controller
{
    /* =======================
       AFFICHER LES OFFRES (ÉTUDIANT)
    ======================== */
    public function index()
    {
        $offres = OffreStage::with('entreprise')->get();
        return view('etudiant.offres', compact('offres'));
    }
    /* =======================
       AFFICHER LES OFFRES (Éntreprise)
    ======================== */

     public function mesOffres()
    {
        $offres = OffreStage::with('entreprise')->get();
        return view('entreprise.offres', compact('offres'));
    }

    /* =======================
       FORMULAIRE CRÉATION (ENTREPRISE)
    ======================== */
    public function create()
    {
        return view('entreprise.cree_offre');
    }

    /* =======================
       ENREGISTRER OFFRE
    ======================== */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string',
            'lieu' => 'required|string',
        ]);

        OffreStage::create([
            'entreprise_id' => Auth::user()->entreprise->id,
            'titre' => $request->titre,
            'description' => $request->description,
            'duree' => $request->duree,
            'lieu' => $request->lieu,
        ]);

        return redirect()
            ->route('entreprise.offres')
            ->with('success', 'Offre créée avec succès');
    }

    /* =======================
       DÉTAIL D’UNE OFFRE    najem nfasakha
    ======================== */
    public function show($id)
    {
        $offre = OffreStage::with('entreprise')->findOrFail($id);
        return view('etudiant.offres', compact('offre'));
    }

    /* =======================
       SUPPRIMER
    ======================== */
    public function destroy($id)
    {
        OffreStage::findOrFail($id)->delete();

        return back()->with('success', 'Offre supprimée');
    }

    public function listOffres()
{
    $offres = OffreStage::with('entreprise.user')->get();

    return response()->json([
        'status' => 'success',
        'offres' => $offres
    ]);
}

}
