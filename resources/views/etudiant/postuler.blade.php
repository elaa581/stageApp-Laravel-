@extends('layouts.app')

@section('title', 'Postuler')

@section('content')
<h3>Postuler à l'offre</h3>

{{-- Afficher les erreurs de validation --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Afficher le succès --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('etudiant.postuler.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="offre_stage_id" value="{{ $offre->id }}">

    <div class="mb-3">
        <label>CV (PDF)</label>
        <input type="file" name="cv" class="form-control" required>
        @error('cv')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Compétences / Motivation</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Envoyer candidature</button>
</form>
@endsection
