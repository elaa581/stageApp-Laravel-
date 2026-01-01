<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\condidateursController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\OffreStageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::middleware(['auth'])->group(function () {
    Route::get('/etudiants/{id}', [EtudiantController::class, 'show']); // profil
    Route::post('/etudiants', [EtudiantController::class, 'store']); // créer
    Route::put('/etudiants/{id}', [EtudiantController::class, 'update']); // mettre à jour
//});


Route::post('/entreprises', [EntrepriseController::class, 'store']);
Route::get('/entreprises/{id}', [EntrepriseController::class, 'show']);
Route::put('/entreprises/{id}', [EntrepriseController::class, 'update']);
Route::delete('/entreprises/{id}', [EntrepriseController::class, 'destroy']);
Route::get('/entreprises', [EntrepriseController::class, 'dashboard']);
Route::get('/entreprises', [EntrepriseController::class, 'listCVs']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::apiResource('offres', OffreStageController::class);
Route::get('/entreprise/candidatures', [CandidatureController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    // Étudiant
    Route::post('/candidatures', [CandidatureController::class, 'store']);
    Route::get('/mes-candidatures', [CandidatureController::class, 'mesCandidatures']);
    // Entreprise
    Route::get('/entreprise/candidatures', [CandidatureController::class, 'entreprise']);
    Route::put('/candidatures/{id}/statut', [CandidatureController::class, 'updateStatut']);
    // Admin
    Route::get('/admin/candidatures', [CandidatureController::class, 'index']);
});


Route::get('/cvs', [EtudiantController::class, 'listCVs']);
Route::get('/offres-public', [OffreStageController::class, 'listOffres']);


Route::post('/login', [LoginController::class, 'login']);
Route::post('/register/etudiant', [RegisterController::class, 'registerEtudiant']);
Route::post('/register/entreprise', [RegisterController::class, 'registerEntreprise']);
