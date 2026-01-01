<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\OffreStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    // 🔵 ADMIN → voir toutes les candidatures
    public function index()
    {
        $this->authorizeRole('admin');

        return Candidature::with(['etudiant.user', 'offre'])->get();
    }

    // 🟢 ETUDIANT → postuler
public function store(Request $request)
{
    
    abort_if(Auth::user()->role !== 'etudiant', 403);

    $request->validate([
        'offre_stage_id' => 'required|exists:offre_stages,id',
        'cv' => 'required|mimes:pdf,png,jpeg,jpg,doc,docx|max:2048',
        'description' => 'nullable|string',

    ]);

    $etudiant = Auth::user()->etudiant;

    $cvPath = $request->file('cv')->store('cvs', 'public');

    Candidature::create([
        'etudiant_id' => $etudiant->id,
        'offre_stage_id' => $request->offre_stage_id,
        'cv' => $cvPath,
        'description' => $request->description,
        'statut' => 'en_attente',
    ]);

    return redirect()
        ->route('etudiant.candidatures')
        ->with('success', 'Candidature envoyée avec succès');
}


    // 🟢 ETUDIANT → ses candidatures
   public function mesCandidatures()
{
    $this->authorizeRole('etudiant');

    $candidatures = Candidature::where('etudiant_id', Auth::user()->etudiant->id)
        ->with('offre')
        ->get();

    return view('etudiant.candidatures', compact('candidatures'));
}

    // 🟠 ENTREPRISE → candidatures reçues
  public function entreprise()
{
    $this->authorizeRole('entreprise');

    $entreprise = Auth::user()->entreprise;

    $candidatures = Candidature::whereIn(
        'offre_stage_id',
        $entreprise->offres()->pluck('id')
    )->with(['etudiant.user', 'offre'])->get();

    // Retourner la vue Blade et passer les données
    return view('entreprise.candidatures', [
        'candidatures' => $candidatures
    ]);
}


    // 🟠 ENTREPRISE → accepter / refuser
  public function updateStatut(Request $request, $id)
{
    $this->authorizeRole('entreprise');

    $request->validate([
        'statut' => 'required|in:accepte,refuse'
    ]);

    $candidature = Candidature::findOrFail($id);
    $candidature->statut = $request->statut;
    $candidature->save();

    return back()->with('success', 'Statut mis à jour');
}

    // 🔵 TOUS → détail
    public function show($id)
    {
        return Candidature::with(['etudiant.user', 'offre'])
            ->findOrFail($id);
    }

    // 🔐 Sécurité par rôle
    private function authorizeRole($role)
    {
        if (Auth::user()->role !== $role) {
            abort(403, 'Accès refusé');
        }
    }

public function storeCvLibre(Request $request)
{
    abort_if(Auth::user()->role !== 'etudiant', 403);

    $request->validate([
        'cv' => 'required|mimes:pdf,png,jpeg,jpg,doc,docx|max:2048',
        'description' => 'nullable|string',
    ]);

    $etudiant = Auth::user()->etudiant;

    $cvPath = $request->file('cv')->store('cvs', 'public');

    Candidature::create([
        'etudiant_id' => $etudiant->id,
        'offre_stage_id' => null, // 👈 CV LIBRE
        'cv' => $cvPath,
        'description' => $request->description,
        'statut' => 'en_attente',
    ]);

    return redirect()
        ->route('etudiant.cvlibre')
        ->with('success', 'CV publié avec succès');
}

public function cvsLibres()
{

    $candidatures = Candidature::whereNull('offre_stage_id')
        ->with('etudiant.user')
        ->latest()
        ->get();

    return view('entreprise.cvs_libres', compact('candidatures'));
}

}


/*   index()            → Admin (toutes)
store()            → Étudiant (postuler)
mesCandidatures()  → Étudiant
entreprise()       → Entreprise
updateStatut()     → Entreprise
show()             → Tous
*/
