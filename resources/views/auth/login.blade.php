@extends('layouts.app')

@section('title', 'Login')
@section('styles')
    @vite(['../../css/login.css'])
@endsection
@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h3 class="auth-title">Connexion</h3>

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-auth">Se connecter</button>

        </form>
        
    </div>
</div>
@endsection


