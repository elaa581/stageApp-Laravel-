@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le profil</h2>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
