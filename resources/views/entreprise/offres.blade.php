@extends('layouts.app')

@section('title', 'Offres de stage')

@section('content')
<h1 class="mb-4">Toutes les offres de stage</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Durée</th>
            <th>Entreprise</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offres as $offre)
        <tr>
            <td>{{ $offre->titre }}</td>
            <td>{{ $offre->description }}</td>
            <td>{{ $offre->duree }}</td>
            <td>{{ $offre->entreprise->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
