@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle me-3 fs-4"></i>
                        <div>
                            <h4 class="mb-0">Ajouter un nouveau matériel</h4>
                            <small class="opacity-75">Remplissez les informations du matériel</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('materiels.store') }}" method="POST" id="materielForm">
                        @csrf

                        <!-- Section 1: Informations de base -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-primary fw-bold mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informations de base
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"
                                               value="{{ old('nom') }}" placeholder="Nom du matériel" required>
                                        <label for="nom"><i class="fas fa-tag me-2"></i>Nom *</label>
                                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="reference" id="reference" class="form-control @error('reference') is-invalid @enderror"
                                               value="{{ old('reference') }}" placeholder="Référence" required>
                                        <label for="reference"><i class="fas fa-barcode me-2"></i>Référence *</label>
                                        @error('reference')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                            <option value="">Sélectionnez un type</option>
                                            <option value="Ordinateur portable" {{ old('type') == 'Ordinateur portable' ? 'selected' : '' }}>Ordinateur portable</option>
                                            <option value="Ordinateur fixe" {{ old('type') == 'Ordinateur fixe' ? 'selected' : '' }}>Ordinateur fixe</option>
                                            <option value="Écran" {{ old('type') == 'Écran' ? 'selected' : '' }}>Écran</option>
                                            <option value="Imprimante" {{ old('type') == 'Imprimante' ? 'selected' : '' }}>Imprimante</option>
                                            <option value="Téléphone" {{ old('type') == 'Téléphone' ? 'selected' : '' }}>Téléphone</option>
                                            <option value="Serveur" {{ old('type') == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                            <option value="Autre" {{ old('type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <label for="type"><i class="fas fa-desktop me-2"></i>Type *</label>
                                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number" name="quantite" id="quantite" class="form-control @error('quantite') is-invalid @enderror"
                                               value="{{ old('quantite', 1) }}" min="1" placeholder="Quantité" required>
                                        <label for="quantite"><i class="fas fa-sort-numeric-up me-2"></i>Quantité *</label>
                                        @error('quantite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select name="etat" id="etat" class="form-select @error('etat') is-invalid @enderror">
                                            <option value="">Sélectionnez un état</option>
                                            <option value="Neuf" {{ old('etat') == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                                            <option value="Bon état" {{ old('etat') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                                            <option value="Moyen" {{ old('etat') == 'Moyen' ? 'selected' : '' }}>Moyen</option>
                                            <option value="Défaillant" {{ old('etat') == 'Défaillant' ? 'selected' : '' }}>Défaillant</option>
                                            <option value="Hors service" {{ old('etat') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                                        </select>
                                        <label for="etat"><i class="fas fa-check-circle me-2"></i>État</label>
                                        @error('etat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="libelle" id="libelle" class="form-control @error('libelle') is-invalid @enderror"
                                                  style="height: 80px" placeholder="Description détaillée">{{ old('libelle') }}</textarea>
                                        <label for="libelle"><i class="fas fa-align-left me-2"></i>Description</label>
                                        @error('libelle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Informations d'acquisition -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-success fw-bold mb-2">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Informations d'acquisition
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="societe" id="societe" class="form-control @error('societe') is-invalid @enderror"
                                               value="{{ old('societe') }}" placeholder="Société">
                                        <label for="societe"><i class="fas fa-building me-2"></i>Société</label>
                                        @error('societe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="type_acquisition" id="type_acquisition" class="form-select @error('type_acquisition') is-invalid @enderror">
                                            <option value="">Type d'acquisition</option>
                                            <option value="Achat" {{ old('type_acquisition') == 'Achat' ? 'selected' : '' }}>Achat</option>
                                            <option value="Location" {{ old('type_acquisition') == 'Location' ? 'selected' : '' }}>Location</option>
                                            <option value="Leasing" {{ old('type_acquisition') == 'Leasing' ? 'selected' : '' }}>Leasing</option>
                                            <option value="Don" {{ old('type_acquisition') == 'Don' ? 'selected' : '' }}>Don</option>
                                        </select>
                                        <label for="type_acquisition"><i class="fas fa-handshake me-2"></i>Type d'acquisition</label>
                                        @error('type_acquisition')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="fournisseur" id="fournisseur" class="form-control @error('fournisseur') is-invalid @enderror"
                                               value="{{ old('fournisseur') }}" placeholder="Fournisseur">
                                        <label for="fournisseur"><i class="fas fa-truck me-2"></i>Fournisseur</label>
                                        @error('fournisseur')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="nat" id="nat" class="form-control @error('nat') is-invalid @enderror"
                                               value="{{ old('nat') }}" placeholder="NAT">
                                        <label for="nat"><i class="fas fa-file-invoice me-2"></i>NAT</label>
                                        @error('nat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_acquisition" id="date_acquisition" class="form-control @error('date_acquisition') is-invalid @enderror"
                                               value="{{ old('date_acquisition') }}">
                                        <label for="date_acquisition"><i class="fas fa-calendar-plus me-2"></i>Date d'acquisition</label>
                                        @error('date_acquisition')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_fin_garantie" id="date_fin_garantie" class="form-control @error('date_fin_garantie') is-invalid @enderror"
                                               value="{{ old('date_fin_garantie') }}">
                                        <label for="date_fin_garantie"><i class="fas fa-shield-alt me-2"></i>Date fin de garantie</label>
                                        @error('date_fin_garantie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Informations techniques -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-info fw-bold mb-2">
                                    <i class="fas fa-cogs me-2"></i>
                                    Informations techniques
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="sn" id="sn" class="form-control @error('sn') is-invalid @enderror"
                                               value="{{ old('sn') }}" placeholder="Numéro de série">
                                        <label for="sn"><i class="fas fa-hashtag me-2"></i>Numéro de série</label>
                                        @error('sn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="nom_machine" id="nom_machine" class="form-control @error('nom_machine') is-invalid @enderror"
                                               value="{{ old('nom_machine') }}" placeholder="Nom de la machine">
                                        <label for="nom_machine"><i class="fas fa-server me-2"></i>Nom machine</label>
                                        @error('nom_machine')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="ecran" id="ecran" class="form-control @error('ecran') is-invalid @enderror"
                                               value="{{ old('ecran') }}" placeholder="Informations écran">
                                        <label for="ecran"><i class="fas fa-tv me-2"></i>Écran</label>
                                        @error('ecran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="etat_affectation" id="etat_affectation" class="form-select @error('etat_affectation') is-invalid @enderror">
                                            <option value="">État d'affectation</option>
                                            <option value="Affecté" {{ old('etat_affectation') == 'Affecté' ? 'selected' : '' }}>Affecté</option>
                                            <option value="Non affecté" {{ old('etat_affectation') == 'Non affecté' ? 'selected' : '' }}>Non affecté</option>
                                            <option value="En attente" {{ old('etat_affectation') == 'En attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="En maintenance" {{ old('etat_affectation') == 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
                                        </select>
                                        <label for="etat_affectation"><i class="fas fa-user-check me-2"></i>État d'affectation</label>
                                        @error('etat_affectation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Affectation -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-warning fw-bold mb-2">
                                    <i class="fas fa-users me-2"></i>
                                    Affectation
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="utilisateur" id="utilisateur" class="form-control @error('utilisateur') is-invalid @enderror"
                                               value="{{ old('utilisateur') }}" placeholder="Nom de l'utilisateur">
                                        <label for="utilisateur"><i class="fas fa-user me-2"></i>Utilisateur</label>
                                        @error('utilisateur')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="service" id="service" class="form-control @error('service') is-invalid @enderror"
                                               value="{{ old('service') }}" placeholder="Service">
                                        <label for="service"><i class="fas fa-briefcase me-2"></i>Service</label>
                                        @error('service')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="departement" id="departement" class="form-control @error('departement') is-invalid @enderror"
                                               value="{{ old('departement') }}" placeholder="Département">
                                        <label for="departement"><i class="fas fa-sitemap me-2"></i>Département</label>
                                        @error('departement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="direction" id="direction" class="form-control @error('direction') is-invalid @enderror"
                                               value="{{ old('direction') }}" placeholder="Direction">
                                        <label for="direction"><i class="fas fa-building me-2"></i>Direction</label>
                                        @error('direction')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <div class="text-muted small">
                                <i class="fas fa-info-circle me-2"></i>
                                Les champs marqués d'un * sont obligatoires
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{ route('materiels.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Enregistrer le matériel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .section-divider {
        height: 3px;
        background: linear-gradient(90deg, var(--bs-primary), transparent);
        border: none;
        margin-top: 0.5rem;
    }

    .form-section {
        position: relative;
        padding: 1.5rem;
        border-radius: 12px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-section:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .form-floating > label {
        font-weight: 500;
        color: #495057;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-select:focus ~ label {
        color: var(--bs-primary);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-outline-secondary {
        border-width: 2px;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        padding: 2rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .section-header h5 {
        position: relative;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .card-header {
            padding: 1.5rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-group {
            width: 100%;
        }

        .btn-group .btn {
            flex: 1;
        }
    }

    .invalid-feedback {
        font-weight: 500;
    }

    .is-invalid {
        border-color: #dc3545;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate warranty end date based on acquisition date
    const dateAcquisition = document.getElementById('date_acquisition');
    const dateFinGarantie = document.getElementById('date_fin_garantie');

    dateAcquisition.addEventListener('change', function() {
        if (this.value && !dateFinGarantie.value) {
            const acquisitionDate = new Date(this.value);
            acquisitionDate.setFullYear(acquisitionDate.getFullYear() + 2); // Add 2 years by default
            dateFinGarantie.value = acquisitionDate.toISOString().split('T')[0];
        }
    });

    // Form validation feedback
    const form = document.getElementById('materielForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Scroll to first invalid field
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        }
    });

    // Remove invalid class on input
    document.querySelectorAll('.form-control, .form-select').forEach(field => {
        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Progress indicator
    const sections = document.querySelectorAll('.form-section');
    const progressBar = document.createElement('div');
    progressBar.className = 'progress mb-4';
    progressBar.innerHTML = '<div class="progress-bar bg-primary" role="progressbar"></div>';

    function updateProgress() {
        const totalFields = form.querySelectorAll('.form-control, .form-select').length;
        const filledFields = Array.from(form.querySelectorAll('.form-control, .form-select')).filter(field => field.value.trim()).length;
        const progress = (filledFields / totalFields) * 100;

        const progressBarFill = progressBar.querySelector('.progress-bar');
        progressBarFill.style.width = progress + '%';
        progressBarFill.textContent = Math.round(progress) + '%';
    }

    // Add progress bar to form
    form.insertBefore(progressBar, form.firstChild);

    // Update progress on input
    document.querySelectorAll('.form-control, .form-select').forEach(field => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });

    // Initial progress calculation
    updateProgress();
});
</script>
@endsection
