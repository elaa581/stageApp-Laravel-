@extends('layouts.app')

@section('title', 'Inscription')

@section('content')

<h3>Créer un compte</h3>
 <!-- Header -->
    <header class="header">
        <div class="logo-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Stagia" class="logo-icon">
    <h1 class="logo-text">Stag<span>Ia</span></h1>
</div>

        <p class="tagline">Plateforme de Stages Universitaires</p>
        <p class="subtitle">
            Connectez étudiants, entreprises et responsables de stage
        </p>
    </header>

    <!-- Cards -->
    <div class="cards-grid">

        <!-- ÉTUDIANT -->
        <div class="role-card student">
            <h2 class="card-title">Étudiant</h2>

            <p class="card-description">
                Trouvez le stage idéal pour votre parcours
            </p>
              @guest
                <a href="{{ route('register-etudiant') }}" class="btn btn-student">
                    Connexion Étudiant
                </a>
            @endguest
        </div>
   <div class="role-card company">
            <h2 class="card-title">Entreprise</h2>

            <p class="card-description">
                Recrutez les meilleurs talents universitaires
            </p>
@guest
                <a href="{{ route('register-entreprise') }}" class="btn btn-company">
                    Connexion Entreprise
                </a>
            @endguest
@endsection
