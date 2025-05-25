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
                                <i class="bi bi-file-earmark-plus me-3"></i>Nouveau Contrat
                            </h1>
                            <p class="mb-0 opacity-75">Création d'un nouveau contrat client</p>
                        </div>
                        <div>
                            <a href="{{ route('contrats.index') }}" class="btn btn-light btn-lg shadow-sm hover-lift">
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
                <i class="bi bi-pencil-square me-2"></i>Informations du contrat
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('contrats.store') }}" method="POST">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Société</label>
                        <select name="societe_id" class="form-select form-select-lg" required>
                            <option value="" selected disabled>Sélectionnez une société</option>
                            @foreach($societes as $societe)
                                <option value="{{ $societe->id }}" {{ old('societe_id') == $societe->id ? 'selected' : '' }}>
                                    {{ $societe->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date de début</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="date" name="date_debut" class="form-control form-control-lg"
                                   value="{{ old('date_debut') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date de fin</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="date" name="date_fin" class="form-control form-control-lg"
                                   value="{{ old('date_fin') }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('contrats.index') }}" class="btn btn-secondary btn-lg shadow-sm hover-lift">
                        <i class="bi bi-x-circle me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-success btn-lg shadow-sm hover-lift">
                        <i class="bi bi-check-circle me-2"></i>Créer le contrat
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
