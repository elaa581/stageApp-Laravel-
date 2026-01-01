@extends('layouts.app')

@section('title', 'Mes candidatures')
{{--
@section('styles')
    @vite(['resources/css/candidatures.css'])
@endsection
--}}
@section('content')
<div class="container">
    <h3>Mes candidatures</h3>

    @if($candidatures->isEmpty())
        <div class="alert alert-info mt-4">
            <p class="mb-0">Vous n'avez pas encore postulé à des offres de stage.</p>
            <a href="{{ route('etudiant.offres') }}" class="btn btn-primary mt-2">
                Voir les offres disponibles
            </a>
        </div>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Offre</th>
                    <th>Entreprise</th>
                    <th>Statut</th>
                    <th>Réponse</th>
                    <th>Date</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $c)
                <tr>
                    {{-- Titre de l'offre --}}
                    <td>
                        @if($c->offre)
                            {{ $c->offre->titre }}
                        @else
                            <span class="text-muted fst-italic">Offre supprimée</span>
                        @endif
                    </td>
                    {{-- Nom de l'entreprise --}}
                    <td>
                        @if($c->offre && $c->offre->entreprise)
                            {{ $c->offre->entreprise->nom_societe ?? $c->offre->entreprise->user->name ?? 'N/A' }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- Statut --}}
                    <td>
                        @php
                            $badgeClass = match($c->statut) {
                                'acceptee' => 'success',
                                'refusee' => 'danger',
                                default => 'warning'
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">
                            {{ ucfirst($c->statut) }}
                        </span>
                    </td>

                    {{-- Réponse --}}
                    <td>{{ $c->reponse ?? 'En attente' }}</td>

                    {{-- Date de candidature --}}
                    <td>{{ $c->created_at->format('d/m/Y') }}</td>

                    {{-- CV --}}
                    <td>
                        @if($c->cv)
                            <a href="{{ asset('storage/' . $c->cv) }}" target="_blank" class="btn btn-sm btn-primary">
                                📄 Voir CV
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
