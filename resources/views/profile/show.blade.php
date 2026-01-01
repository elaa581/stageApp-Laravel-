@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mon profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        <li class="list-group-item"><strong>Nom :</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Rôle :</strong> {{ ucfirst($user->role) }}</li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('profile.password') }}" class="btn btn-warning">Mot de passe</a>
    </div>
</div>
@endsection
