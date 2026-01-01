@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
    @vite(['resources/css/dashboard_admin.css'])
@endsection

@section('content')
<h1>Dashboard Admin</h1>

<div class="dashboard-grid">
    <div class="card">
        <h5>Total Offres</h5>
        <p>{{ $totalOffres }}</p>
    </div>
    <div class="card">
        <h5>Total CVs</h5>
        <p>{{ $totalCvs }}</p>
    </div>
    <div class="card">
        <h5>Total Étudiants</h5>
        <p>{{ $totalEtudiants }}</p>
    </div>
    <div class="card">
        <h5>Total Entreprises</h5>
        <p>{{ $totalEntreprises }}</p>
    </div>
</div>

<div class="chart-container">
    <canvas id="adminChart"></canvas>
</div>
@endsection

@section('scripts')
@vite(['resources/js/dashboard_admin_chart.js'])
@endsection

