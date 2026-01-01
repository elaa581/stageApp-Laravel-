@extends('layouts.app')

@section('title', 'CVs étudiants')

@section('content')
<h2 class="feed-title">📄 CVs des étudiants</h2>

<div class="cv-feed">
    @foreach($cvs as $c)
        <div class="cv-card">

            <!-- En-tête -->
            <div class="cv-header">
                <div class="avatar">
                    {{ strtoupper(substr($c->etudiant->user->name, 0, 1)) }}
                </div>
                <div>
                    <strong>{{ $c->etudiant->user->name }}</strong><br>
                    <small>Offre : {{ $c->offre->titre }}</small>
                </div>
            </div>

            <!-- Prévisualisation CV -->
            <div class="cv-preview">
                @if(Str::endsWith($c->cv, '.pdf'))
                    <iframe src="{{ asset('storage/'.$c->cv) }}"></iframe>
                @else
                    <img src="{{ asset('storage/'.$c->cv) }}" alt="CV">
                @endif
            </div>

            <!-- Description -->
            <div class="cv-body">
                <p>{{ $c->description }}</p>
            </div>

            <!-- Footer -->
            <div class="cv-footer">
                <span class="badge {{ $c->statut === 'accepté' ? 'success' : ($c->statut === 'refusé' ? 'danger' : 'warning') }}">
                    {{ ucfirst($c->statut) }}
                </span>

                <a href="{{ asset('storage/'.$c->cv) }}" target="_blank" class="btn-view">
                    📥 Télécharger
                </a>
            </div>

        </div>
    @endforeach
</div>
@endsection
