@extends('layouts.app')

@section('title', 'Toutes les entreprises')

@section('styles')
    @vite(['resources/css/entreprises.css'])
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Toutes les entreprises</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.allEntreprises') }}" class="btn btn-primary mb-3">
        Ajouter une nouvelle entreprise
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'entreprise</th>
                <th>Adresse</th>
                <th>Domaine</th>
                <th>Nom utilisateur</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entreprises as $entreprise)
            <tr>
                <td>{{ $entreprise->id }}</td>
                <td>{{ $entreprise->nom_entreprise }}</td>
                <td>{{ $entreprise->adresse }}</td>
                <td>{{ $entreprise->domaine }}</td>
                <td>{{ $entreprise->user->name }}</td>
                <td>{{ $entreprise->user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
