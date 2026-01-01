@extends('layouts.app')

@section('title', 'Inscription Entreprise')

@section('styles')
    @vite(['resources/css/register_entr.css'])
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h3 class="auth-title">Inscription Entreprise</h3>

        <form method="POST" action="/register/entreprise">
            @csrf

            <div class="form-group">
                <input name="name" placeholder="Responsable" class="form-control">
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe" class="form-control">
                <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" class="form-control">
            </div>

            <div class="form-group">
                <input name="nom_entreprise" placeholder="Nom entreprise" class="form-control">
                <input name="adresse" placeholder="Adresse" class="form-control">
            </div>

            <div class="form-group">
                <input name="domaine" placeholder="Domaine" class="form-control">
            </div>

            <button class="btn btn-company">S'inscrire</button>

            <p class="text-center mt-3">
                Vous avez déjà un compte ? <a href="{{ route('login') }}" class="auth-link">Se connecter</a>
            </p>
        </form>
    </div>
</div>
@endsection
