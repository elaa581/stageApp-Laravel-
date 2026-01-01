@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Changer le mot de passe</h2>

    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf

        <div class="mb-3">
            <label>Mot de passe actuel</label>
            <input type="password" name="current_password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button class="btn btn-danger">Changer</button>
    </form>
</div>
@endsection
