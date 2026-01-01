@extends('layouts.app')
<style>
/* ===== Fond général ===== */
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #fff1f2, #fee2e2);
    min-height: 100vh;
}

/* ===== Container ===== */
.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 15px;
}

/* ===== Carte ===== */
.profile-card {
    background: #ffffff;
    width: 100%;
    max-width: 480px;
    border-radius: 20px;
    padding: 35px 30px;
    box-shadow: 0 20px 45px rgba(220, 38, 38, 0.2);
    text-align: center;
}

/* ===== Avatar ===== */
.profile-avatar {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #dc2626, #991b1b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.profile-avatar span {
    color: #ffffff;
    font-size: 36px;
    font-weight: 700;
}

/* ===== Nom ===== */
.profile-name {
    font-size: 24px;
    font-weight: 700;
    color: #7f1d1d;
}

.profile-role {
    font-size: 14px;
    color: #991b1b;
    margin-bottom: 25px;
}

/* ===== Infos ===== */
.profile-info {
    text-align: left;
    margin-bottom: 30px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #fecaca;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row span {
    color: #7f1d1d;
    font-size: 14px;
}

.info-row strong {
    color: #450a0a;
    font-weight: 600;
}

/* ===== Actions ===== */
.profile-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

/* Boutons */
.btn-primary,
.btn-warning {
    padding: 12px 18px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    width: 180px;
    text-align: center;
}

.btn-primary {
    background: #dc2626;
    color: #ffffff;
}

.btn-primary:hover {
    background: #991b1b;
}

.btn-warning {
    background: #fee2e2;
    color: #7f1d1d;
    border: 1px solid #fecaca;
}

.btn-warning:hover {
    background: #fecaca;
}

/* ===== Responsive ===== */
@media (max-width: 500px) {
    .profile-actions {
        flex-direction: column;
    }

    .btn-primary,
    .btn-warning {
        width: 100%;
    }
}

</style>
@section('title', 'Profil Entreprise')

@section('styles')
    @vite(['resources/css/admin-profile.css'])
@endsection

@section('content')
<div class="profile-container">

    <div class="profile-card">

        {{-- Avatar --}}
        <div class="profile-avatar">
            <span>{{ strtoupper(substr($entreprise->user->name, 0, 1)) }}</span>
        </div>

        {{-- Nom & rôle --}}
        <h2 class="profile-name">{{ $entreprise->user->name }}</h2>
        <p class="profile-role">Entreprise</p>

        {{-- Informations --}}
        <div class="profile-info">

            <div class="info-row">
                <span>Email</span>
                <strong>{{ $entreprise->user->email }}</strong>
            </div>

            <div class="info-row">
                <span>Société</span>
                <strong>{{ $entreprise->nom_societe }}</strong>
            </div>

            <div class="info-row">
                <span>Adresse</span>
                <strong>{{ $entreprise->adresse }}</strong>
            </div>

            <div class="info-row">
                <span>Téléphone</span>
                <strong>{{ $entreprise->telephone }}</strong>
            </div>

        </div>

        {{-- Actions --}}
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn-primary">Modifier</a>
            <a href="{{ route('profile.password') }}" class="btn-warning">Mot de passe</a>
        </div>

    </div>

</div>
@endsection
