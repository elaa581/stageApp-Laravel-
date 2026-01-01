@extends('layouts.app')
@section('styles')
    @vite(['resources/css/home.css'])
@endsection
@section('content')
<div class="container">

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

            @auth
                @if(auth()->user()->role === 'etudiant')
                    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-student">
                        Accéder à mon espace
                    </a>
                @endif
            @endauth
        </div>

        <!-- ENTREPRISE -->
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

            @auth
                @if(auth()->user()->role === 'entreprise')
                    <a href="{{ route('entreprise.dashboard') }}" class="btn btn-company">
                        Dashboard Entreprise
                    </a>
                @endif
            @endauth
        </div>

        <!-- RESPONSABLE / ADMIN -->
        <div class="role-card supervisor">
            <h2 class="card-title">Responsable</h2>

            <p class="card-description">
                Supervisez et validez les stages
            </p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-supervisor">
                    Accès Responsable
                </a>
            @endguest

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-supervisor">
                        Admin Dashboard
                    </a>
                @endif
            @endauth
        </div>

    </div>


</div>

@endsection

