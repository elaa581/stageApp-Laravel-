@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Créer une offre de stage</h2>


    <form method="POST" action="{{ route('entreprise.offres.store') }}">
    @csrf
        <div class="mb-3">
            <label class="form-label">Titre de l’offre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Domaine</label>
            <input type="text" name="domaine" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Durée (en mois)</label>
            <input type="number" name="duree" class="form-control" min="1" required>
        </div>

        <button class="btn btn-success">
            Publier l’offre
        </button>
    </form>
</div>
@endsection
