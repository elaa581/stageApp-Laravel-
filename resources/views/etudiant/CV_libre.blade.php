@extends('layouts.app')

@section('title', 'Déposer mon CV')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📄 Déposer mon CV (sans offre)</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST"action="{{ route('etudiant.cvlibre.store') }}"enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label class="form-label">CV (PDF / Word)</label>
            <input type="file" name="cv" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Présentation / compétences</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"
                      placeholder="Parlez de vous..."></textarea>
        </div>

        <button class="btn btn-primary w-100">
            🚀 Envoyer mon CV
        </button>
    </form>
</div>
@endsection
