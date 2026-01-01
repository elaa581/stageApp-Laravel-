@extends('layouts.app')

@section('title', 'Dashboard Étudiant')

@section('styles')
    @vite(['resources/css/dashboardetu.css'])
@endsection

@section('content')


<main class="dashboard-container">
    <div class="welcome-card">
        <h2>Bienvenue, {{ auth()->user()->name }}</h2>
        <p>Voici un aperçu de vos actions disponibles</p>
    </div>

    <div class="dashboard-links">
        <a href="/etudiant/offres" class="dash-link">📢 Offres de stages</a>
        <a href="/etudiant/candidatures" class="dash-link">📩 Mes candidatures</a>
        <a href="/etudiant/profil" class="dash-link">👤 Mon profil</a>
    </div>
</main>
@endsection

