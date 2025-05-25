@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- En-tête avec dégradé -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-2 fw-bold">
                                <i class="bi bi-people-fill me-3"></i>Modifier Affectation
                            </h1>
                            <p class="mb-0 opacity-75">Mise à jour de l'affectation matériel/société</p>
                        </div>
                        <div>
                            <a href="{{ route('affectations.index') }}" class="btn btn-light btn-lg shadow-sm hover-lift">
                                <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages d'erreur -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-2 me-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Erreur !</strong> Veuillez corriger les problèmes suivants :
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        </div>
    @endif

    <!-- Formulaire -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-pencil-square me-2"></i>Détails de l'affectation
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('affectations.update', $affectation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Matériel</label>
                        <select name="materiel_id" class="form-select form-select-lg @error('materiel_id') is-invalid @enderror" required>
                            @foreach($materiels as $materiel)
                                <option value="{{ $materiel->id }}" {{ old('materiel_id', $affectation->materiel_id) == $materiel->id ? 'selected' : '' }}>
                                    {{ $materiel->nom }} ({{ $materiel->reference }})
                                </option>
                            @endforeach
                        </select>
                        @error('materiel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Société</label>
                        <select name="societe_id" class="form-select form-select-lg @error('societe_id') is-invalid @enderror" required>
                            @foreach($societes as $societe)
                                <option value="{{ $societe->id }}" {{ old('societe_id', $affectation->societe_id) == $societe->id ? 'selected' : '' }}>
                                    {{ $societe->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('societe_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date d'affectation</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="date" name="date_affectation" class="form-control form-control-lg @error('date_affectation') is-invalid @enderror"
                                   value="{{ old('date_affectation', $affectation->date_affectation->format('Y-m-d')) }}" required>
                        </div>
                        @error('date_affectation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('affectations.index') }}" class="btn btn-secondary btn-lg shadow-sm hover-lift">
                        <i class="bi bi-x-circle me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm hover-lift">
                        <i class="bi bi-check-circle me-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.form-select-lg, .form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1.05rem;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.input-group-text {
    background-color: #f8f9fa;
}

.alert {
    border-radius: 0.75rem;
}

.invalid-feedback {
    display: block;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}
</style>

<script>
// Animation au chargement
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection
