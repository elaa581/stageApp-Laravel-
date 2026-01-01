@extends('layouts.app')
@section('styles')
    @vite(['resources/css/cvs.css'])
@endsection

@section('title', 'Tous les CVs')

@section('content')
<h1>CVs des Étudiants</h1>
<table>
    <thead>
        <tr>
            <th>Étudiant</th>
            <th>Offre</th>
            <th>CV</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cvs as $c)
        <tr>
            <td>{{ $c->etudiant->user->name }}</td>
            <td>{{ $c->offre->titre }}</td>
            <td><a href="{{ asset('storage/'.$c->cv) }}" target="_blank">Voir CV</a></td>
            <td>{{ $c->statut }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
