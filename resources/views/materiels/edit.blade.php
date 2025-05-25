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
                                <i class="bi bi-tools me-3"></i>Modifier Matériel
                            </h1>
                            <p class="mb-0 opacity-75">Mise à jour des informations du matériel</p>
                        </div>
                        <div>
                            <a href="{{ route('materiels.index') }}" class="btn btn-light btn-lg shadow-sm hover-lift">
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
                <i class="bi bi-pencil-square me-2"></i>Informations du matériel
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('materiels.update', $materiel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" name="nom" class="form-control form-control-lg @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $materiel->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Référence</label>
                        <input type="text" name="reference" class="form-control form-control-lg @error('reference') is-invalid @enderror"
                               value="{{ old('reference', $materiel->reference) }}" required>
                        @error('reference')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Type</label>
                        <input type="text" name="type" class="form-control form-control-lg @error('type') is-invalid @enderror"
                               value="{{ old('type', $materiel->type) }}" required>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Quantité</label>
                        <input type="number" name="quantite" class="form-control form-control-lg @error('quantite') is-invalid @enderror"
                               value="{{ old('quantite', $materiel->quantite) }}" min="0" step="1">
                        @error('quantite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">État</label>
                        <select name="etat" class="form-select form-select-lg @error('etat') is-invalid @enderror">
                            <option value="">Sélectionnez un état</option>
                            <option value="Neuf" {{ old('etat', $materiel->etat) == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                            <option value="Usagé" {{ old('etat', $materiel->etat) == 'Usagé' ? 'selected' : '' }}>Usagé</option>
                            <option value="Défaillant" {{ old('etat', $materiel->etat) == 'Défaillant' ? 'selected' : '' }}>Défaillant</option>
                        </select>
                        @error('etat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Société</label>
                        <input type="text" name="societe" class="form-control form-control-lg @error('societe') is-invalid @enderror"
                               value="{{ old('societe', $materiel->societe) }}">
                        @error('societe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Type d'acquisition</label>
                        <input type="text" name="type_acquisition" class="form-control form-control-lg @error('type_acquisition') is-invalid @enderror"
                               value="{{ old('type_acquisition', $materiel->type_acquisition) }}">
                        @error('type_acquisition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Fournisseur</label>
                        <input type="text" name="fournisseur" class="form-control form-control-lg @error('fournisseur') is-invalid @enderror"
                               value="{{ old('fournisseur', $materiel->fournisseur) }}">
                        @error('fournisseur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nature</label>
                        <input type="text" name="nat" class="form-control form-control-lg @error('nat') is-invalid @enderror"
                               value="{{ old('nat', $materiel->nat) }}">
                        @error('nat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date d'acquisition</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="date" name="date_acquisition" class="form-control form-control-lg @error('date_acquisition') is-invalid @enderror"
                                   value="{{ old('date_acquisition', $materiel->date_acquisition) }}">
                        </div>
                        @error('date_acquisition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date fin de garantie</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="date" name="date_fin_garantie" class="form-control form-control-lg @error('date_fin_garantie') is-invalid @enderror"
                                   value="{{ old('date_fin_garantie', $materiel->date_fin_garantie) }}">
                        </div>
                        @error('date_fin_garantie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Libellé</label>
                        <textarea name="libelle" class="form-control form-control-lg @error('libelle') is-invalid @enderror"
                                  rows="2">{{ old('libelle', $materiel->libelle) }}</textarea>
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Numéro de série (SN)</label>
                        <input type="text" name="sn" class="form-control form-control-lg @error('sn') is-invalid @enderror"
                               value="{{ old('sn', $materiel->sn) }}">
                        @error('sn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nom machine</label>
                        <input type="text" name="nom_machine" class="form-control form-control-lg @error('nom_machine') is-invalid @enderror"
                               value="{{ old('nom_machine', $materiel->nom_machine) }}">
                        @error('nom_machine')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Écran</label>
                        <input type="text" name="ecran" class="form-control form-control-lg @error('ecran') is-invalid @enderror"
                               value="{{ old('ecran', $materiel->ecran) }}">
                        @error('ecran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Utilisateur</label>
                        <input type="text" name="utilisateur" class="form-control form-control-lg @error('utilisateur') is-invalid @enderror"
                               value="{{ old('utilisateur', $materiel->utilisateur) }}">
                        @error('utilisateur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Service</label>
                        <input type="text" name="service" class="form-control form-control-lg @error('service') is-invalid @enderror"
                               value="{{ old('service', $materiel->service) }}">
                        @error('service')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Département</label>
                        <input type="text" name="departement" class="form-control form-control-lg @error('departement') is-invalid @enderror"
                               value="{{ old('departement', $materiel->departement) }}">
                        @error('departement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Direction</label>
                        <input type="text" name="direction" class="form-control form-control-lg @error('direction') is-invalid @enderror"
                               value="{{ old('direction', $materiel->direction) }}">
                        @error('direction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">État d'affectation</label>
                        <input type="text" name="etat_affectation" class="form-control form-control-lg @error('etat_affectation') is-invalid @enderror"
                               value="{{ old('etat_affectation', $materiel->etat_affectation) }}">
                        @error('etat_affectation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('materiels.index') }}" class="btn btn-secondary btn-lg shadow-sm hover-lift">
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
