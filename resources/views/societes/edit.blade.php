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
                                <i class="bi bi-building me-3"></i>Modifier Société
                            </h1>
                            <p class="mb-0 opacity-75">Mise à jour des informations de la société</p>
                        </div>
                        <div>
                            <a href="{{ route('societes.index') }}" class="btn btn-light btn-lg shadow-sm hover-lift">
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
                <i class="bi bi-pencil-square me-2"></i>Informations de la société
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('societes.update', $societe->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" name="nom" class="form-control form-control-lg @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $societe->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   value="{{ old('email', $societe->email) }}" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Adresse</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <input type="text" name="adresse" class="form-control form-control-lg @error('adresse') is-invalid @enderror"
                                   value="{{ old('adresse', $societe->adresse) }}" required>
                        </div>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('societes.index') }}" class="btn btn-secondary btn-lg shadow-sm hover-lift">
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

.form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1.05rem;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.form-control:focus {
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
