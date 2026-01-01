<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\OffreStageController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ProfileController;
use App\Models\OffreStage;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', fn () => view('auth.login'))->name('login');

Route::get('/register', fn () => view('auth.register-choice'))->name('register_choice');
Route::get('/register/etudiant', fn () => view('auth.register-etudiant'))
    ->name('register-etudiant');
Route::get('/register/entreprise', fn () => view('auth.register-entreprise'))
    ->name('register-entreprise');

/*
|--------------------------------------------------------------------------
| Auth actions
|--------------------------------------------------------------------------
*/

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register/etudiant', [RegisterController::class, 'registerEtudiant']);
Route::post('/register/entreprise', [RegisterController::class, 'registerEntreprise']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Étudiant
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('etudiant')->name('etudiant.')->group(function () {

    Route::get('/dashboard', fn () => view('etudiant.dashboard'))
        ->name('dashboard');

    Route::get('/offres', [OffreStageController::class, 'index'])
        ->name('offres');

    Route::get('/postuler/{id}', function ($id) {
        abort_if(Auth::user()->role !== 'etudiant', 403);
        $offre = OffreStage::findOrFail($id);
        return view('etudiant.postuler', compact('offre'));
    })->name('postuler');

    Route::post('/postuler', [CandidatureController::class, 'store'])
        ->name('postuler.store');


    Route::get('/cv-libre', function () {
    abort_if(Auth::user()->role !== 'etudiant', 403);
    return view('etudiant.CV_libre');
})->name('cvlibre');

// ENREGISTRER le CV
Route::post('/cv-libre', [CandidatureController::class, 'storeCvLibre'])
    ->name('cvlibre.store');

    Route::get('/candidatures', [CandidatureController::class, 'mesCandidatures'])
        ->name('candidatures');

    Route::get('/profil', [ProfileController::class, 'show'])
        ->name('profil');
});

/*
|--------------------------------------------------------------------------
| Entreprise
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('entreprise')->name('entreprise.')->group(function () {

    Route::get('/dashboard', [EntrepriseController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/cvs', [EntrepriseController::class, 'listCVs'])->name('cvs');

    Route::get('/cvs-libres',[CandidatureController::class, 'cvsLibres'])->name('cvs.libres');

        // ✅ création offre
    // ✅ METTEZ create AVANT la route /offres
    Route::get('/offres/create', [OffreStageController::class, 'create'])
        ->name('offres.create');

    Route::post('/offres', [OffreStageController::class, 'store'])
        ->name('offres.store');

    Route::get('/offres', [OffreStageController::class, 'mesOffres'])
        ->name('offres');

    Route::get('/candidatures', [CandidatureController::class, 'entreprise'])
        ->name('candidatures');

    Route::put('/candidatures/{id}/statut', [CandidatureController::class, 'updateStatut'])
        ->name('candidatures.updateStatut');

    Route::get('/profil', [ProfileController::class, 'show'])
        ->name('profil');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/offres', [AdminController::class, 'allOffres'])
        ->name('offres');

    Route::get('/cvs', [AdminController::class, 'allCvs'])
        ->name('cvs');

    Route::get('/profil', [ProfileController::class, 'show'])
        ->name('profil');

    // Entreprises
    Route::get('/entreprises', [AdminController::class, 'allEntreprises'])
        ->name('allEntreprises');

    Route::get('/entreprises/create', [AdminController::class, 'createEntreprise'])
        ->name('create');


Route::get('/cvs-libres',[CandidatureController::class, 'cvsLibres'])->name('cvs.libres');


    Route::post('/entreprises', [AdminController::class, 'storeEntreprise'])
        ->name('entreprises.store');
});

/*
|--------------------------------------------------------------------------
| Profil (commun)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/password', [ProfileController::class, 'password'])
        ->name('profile.password');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});
