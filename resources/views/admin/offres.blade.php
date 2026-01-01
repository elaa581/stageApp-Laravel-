@extends('layouts.app')
@section('styles')
    @vite(['resources/css/offresAdmin.css'])
@endsection
@section('title', 'Toutes les Offres')

@section('content')
<h1>Toutes les Offres de Stage</h1>
<table>
    <thead>
        <tr>
            <th>Entreprise</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offres as $offre)
        <tr>
            <td>{{ $offre->entreprise->nom_entreprise }}</td>
            <td>{{ $offre->titre }}</td>
            <td>{{ $offre->description }}</td>
            <td>{{ $offre->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
