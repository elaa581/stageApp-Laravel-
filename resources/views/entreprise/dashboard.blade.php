@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    @vite(['resources/css/dashboard_entreprice.css'])
@endsection

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Candidatures par mois</h5>
                <canvas id="candidaturesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Offres par mois</h5>
                <canvas id="offresChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@vite(['resources/js/chart_dashboard.js'])
@endsection
