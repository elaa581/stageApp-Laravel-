@extends('layouts.app')

@section('title', 'Mon Profil')

@section('styles')
    @vite(['resources/css/profile.css'])
@endsection

@section('content')
<div class="profile-container">

    <div class="profile-card">

        {{-- Avatar --}}
        <div class="profile-avatar">
            <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>

        {{-- Nom & rôle --}}
        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-role">Étudiant</p>

        {{-- Infos --}}
        <div class="profile-info">

            <div class="info-row">
                <span>Prénom</span>
                <strong>{{ $user->etudiant->prenom }}</strong>
            </div>

            <div class="info-row">
                <span>Classe</span>
                <strong>{{ $user->etudiant->classe }}</strong>
            </div>

            <div class="info-row">
                <span>CIN</span>
                <strong>{{ $user->etudiant->cin }}</strong>
            </div>

        </div>

        {{-- Boutons --}}
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn-primary">Modifier</a>
            <a href="{{ route('profile.password') }}" class="btn-warning">Mot de passe</a>
        </div>

    </div>

</div>
@endsection
