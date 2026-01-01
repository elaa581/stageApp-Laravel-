@extends('layouts.app')

@section('title', 'Ajouter une entreprise')
@section('styles')
    @vite(['resources/css/entreprise_form.css'])
@endsection
@section('content')
<h1>Ajouter une Entreprise</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('admin.entreprises.store') }}" method="POST">
    @csrf
    <h3>Informations utilisateur</h3>
    <label>Nom complet:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Mot de passe:</label>
    <input type="password" name="password" required>

    <label>Confirmer le mot de passe:</label>
    <input type="password" name="password_confirmation" required>

    <h3>Informations de l'entreprise</h3>
    <label>Nom de l'entreprise:</label>
    <input type="text" name="nom_entreprise" required>

    <label>Adresse:</label>
    <input type="text" name="adresse" required>

    <label>Domaine:</label>
    <input type="text" name="domaine" required>

    <button type="submit">Ajouter l'entreprise</button>
</form>
@endsection
