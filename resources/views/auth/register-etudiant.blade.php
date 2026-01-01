@extends('layouts.app')

@section('title', 'Inscription Étudiant')

@section('styles')
    @vite(['resources/css/register_etu.css'])
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h3 class="auth-title">Inscription Étudiant</h3>

        <form method="POST" action="/register/etudiant">
            @csrf

            <div class="form-group">
                <input name="name" placeholder="Nom" class="form-control">
                <input name="prenom" placeholder="Prénom" class="form-control">
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe" class="form-control">
                <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" class="form-control">
            </div>

            <div class="form-group">
                <input name="cin" placeholder="CIN" class="form-control">
                <input type="date" name="date_naissance" class="form-control">
            </div>

            <div class="form-group">
                <input name="classe" placeholder="Classe" class="form-control">
            </div>

            <button class="btn btn-auth">S'inscrire</button>

            <p class="text-center mt-3">
                Vous avez déjà un compte ? <a href="{{ route('login') }}" class="auth-link">Se connecter</a>
            </p>
        </form>
    </div>
</div>
@endsection
