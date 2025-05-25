@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- En-tête simple -->
    <div class="text-center mb-4">
        <h1 class="display-5">IT Dashboard</h1>
        <p class="text-muted">Statistiques des infrastructures informatiques</p>
    </div>

    <!-- Message flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Cartes de compteurs -->
    <div class="row g-4">
        <!-- Matériels IT -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-hdd-rack fs-1 text-primary mb-3"></i>
                    <h3 class="text-primary">{{ $total_materiels ?? '0' }}</h3>
                    <h5 class="card-title">Matériels IT</h5>
                </div>
            </div>
        </div>

        <!-- Sociétés -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-building fs-1 text-success mb-3"></i>
                    <h3 class="text-success">{{ $total_societes ?? '0' }}</h3>
                    <h5 class="card-title">Sociétés</h5>
                </div>
            </div>
        </div>

        <!-- Affectations -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-lines-fill fs-1 text-warning mb-3"></i>
                    <h3 class="text-warning">{{ $total_affectations ?? '0' }}</h3>
                    <h5 class="card-title">Affectations</h5>
                </div>
            </div>
        </div>

        <!-- Contrats -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-shield-check fs-1 text-danger mb-3"></i>
                    <h3 class="text-danger">{{ $total_contrats ?? '0' }}</h3>
                    <h5 class="card-title">Contrats</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
@endsection
