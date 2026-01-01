@extends('layouts.app')

@section('title', 'Offres de stages')

@section('content')

<style>
/* ===== PAGE ===== */
body {
    font-family: "Inter", sans-serif;
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 50%, #fafafa 100%);
}

/* ===== TITRE ===== */
.page-title {
    text-align: center;
    color: #dc2626;
    font-size: 28px;
    font-weight: 700;
    margin: 30px 0;
}

/* ===== GRILLE ===== */
.offres-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto 50px;
    padding: 0 20px;
}

/* ===== CARD ===== */
.offre-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    border-top: 5px solid #dc2626;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Hover */
.offre-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Titre */
.offre-card h5 {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}

/* Description */
.offre-card p {
    color: #475569;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
}

/* Entreprise */
.offre-entreprise {
    font-size: 13px;
    font-weight: 600;
    color: #dc2626;
    margin-bottom: 15px;
}

/* Bouton */
.offre-card .btn {
    margin-top: auto;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;
    font-weight: 600;
    background-color: #dc2626;
    border: none;
    transition: background 0.2s ease;
}

.offre-card .btn:hover {
    background-color: #b91c1c;
}


</style>

<h3 class="page-title">Offres de stages disponibles</h3>

<div class="offres-grid">
@foreach($offres as $offre)
    <div class="offre-card">
        <h5>{{ $offre->titre }}</h5>
        <p>{{ $offre->description }}</p>

        <div class="offre-entreprise">
            {{ $offre->entreprise->nom_entreprise }}
        </div>

        <a href="/etudiant/postuler/{{ $offre->id }}" class="btn btn-primary">
            Postuler
        </a>
    </div>
@endforeach
</div>

@endsection
