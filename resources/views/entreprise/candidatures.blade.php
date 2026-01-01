@extends('layouts.app')

@section('title', 'Candidatures')

@section('styles')
    @vite(['resources/css/candidatures_entreprise.css'])
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Candidatures reçues</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($candidatures->isEmpty())
        <div class="alert alert-info">Aucune candidature pour le moment.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Offre</th>
                    <th>CV</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $c)
                <tr>
                    <td>{{ $c->etudiant->user->name }}</td>
                    <td>
                        @if($c->offre)
                            {{ $c->offre->titre }}
                        @else
                            <span class="badge bg-info">CV libre</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/'.$c->cv) }}" target="_blank" class="btn btn-sm btn-primary">
                            📄 Télécharger
                        </a>
                    </td>
                    <td>{{ Str::limit($c->description, 50) ?? 'Aucune description' }}</td>
                    <td>
                        <span class="badge bg-{{ $c->statut == 'accepte' ? 'success' : ($c->statut == 'refuse' ? 'danger' : 'warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $c->statut)) }}
                        </span>
                    </td>
                    <td>
                        @if($c->statut === 'en_attente')
                            <form action="{{ route('entreprise.candidatures.updateStatut', $c->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button name="statut" value="accepte" class="btn btn-success btn-sm">
                                    ✓ Accepter
                                </button>
                                <button name="statut" value="refuse" class="btn btn-danger btn-sm">
                                    ✗ Refuser
                                </button>
                            </form>
                        @else
                            <span class="text-muted">Traité</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
