@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building me-3 fs-4"></i>
                        <div>
                            <h4 class="mb-0">Ajouter une nouvelle société</h4>
                            <small class="opacity-75">Remplissez les informations de la société</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('societes.store') }}" method="POST" id="societeForm">
                        @csrf

                        <!-- Progress Bar -->
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%">0%</div>
                        </div>

                        <!-- Section 1: Informations générales -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-primary fw-bold mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informations générales
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"
                                               value="{{ old('nom') }}" placeholder="Nom de la société" required>
                                        <label for="nom"><i class="fas fa-building me-2"></i>Nom de la société *</label>
                                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="siret" id="siret" class="form-control @error('siret') is-invalid @enderror"
                                               value="{{ old('siret') }}" placeholder="Numéro SIRET">
                                        <label for="siret"><i class="fas fa-id-card me-2"></i>SIRET</label>
                                        @error('siret')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="secteur_activite" id="secteur_activite" class="form-select @error('secteur_activite') is-invalid @enderror">
                                            <option value="">Sélectionnez un secteur</option>
                                            <option value="Informatique" {{ old('secteur_activite') == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                            <option value="Finance" {{ old('secteur_activite') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                            <option value="Industrie" {{ old('secteur_activite') == 'Industrie' ? 'selected' : '' }}>Industrie</option>
                                            <option value="Services" {{ old('secteur_activite') == 'Services' ? 'selected' : '' }}>Services</option>
                                            <option value="Commerce" {{ old('secteur_activite') == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                                            <option value="Santé" {{ old('secteur_activite') == 'Santé' ? 'selected' : '' }}>Santé</option>
                                            <option value="Éducation" {{ old('secteur_activite') == 'Éducation' ? 'selected' : '' }}>Éducation</option>
                                            <option value="Autre" {{ old('secteur_activite') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <label for="secteur_activite"><i class="fas fa-industry me-2"></i>Secteur d'activité</label>
                                        @error('secteur_activite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="taille_entreprise" id="taille_entreprise" class="form-select @error('taille_entreprise') is-invalid @enderror">
                                            <option value="">Taille de l'entreprise</option>
                                            <option value="TPE (1-9 salariés)" {{ old('taille_entreprise') == 'TPE (1-9 salariés)' ? 'selected' : '' }}>TPE (1-9 salariés)</option>
                                            <option value="PME (10-249 salariés)" {{ old('taille_entreprise') == 'PME (10-249 salariés)' ? 'selected' : '' }}>PME (10-249 salariés)</option>
                                            <option value="ETI (250-4999 salariés)" {{ old('taille_entreprise') == 'ETI (250-4999 salariés)' ? 'selected' : '' }}>ETI (250-4999 salariés)</option>
                                            <option value="Grande entreprise (5000+ salariés)" {{ old('taille_entreprise') == 'Grande entreprise (5000+ salariés)' ? 'selected' : '' }}>Grande entreprise (5000+ salariés)</option>
                                        </select>
                                        <label for="taille_entreprise"><i class="fas fa-users me-2"></i>Taille de l'entreprise</label>
                                        @error('taille_entreprise')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                  style="height: 80px" placeholder="Description de la société">{{ old('description') }}</textarea>
                                        <label for="description"><i class="fas fa-align-left me-2"></i>Description</label>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Adresse et localisation -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-success fw-bold mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    Adresse et localisation
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror"
                                               value="{{ old('adresse') }}" placeholder="Adresse complète" required>
                                        <label for="adresse"><i class="fas fa-home me-2"></i>Adresse *</label>
                                        @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" name="code_postal" id="code_postal" class="form-control @error('code_postal') is-invalid @enderror"
                                               value="{{ old('code_postal') }}" placeholder="Code postal">
                                        <label for="code_postal"><i class="fas fa-mail-bulk me-2"></i>Code postal</label>
                                        @error('code_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" name="ville" id="ville" class="form-control @error('ville') is-invalid @enderror"
                                               value="{{ old('ville') }}" placeholder="Ville">
                                        <label for="ville"><i class="fas fa-city me-2"></i>Ville</label>
                                        @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" name="pays" id="pays" class="form-control @error('pays') is-invalid @enderror"
                                               value="{{ old('pays', 'France') }}" placeholder="Pays">
                                        <label for="pays"><i class="fas fa-flag me-2"></i>Pays</label>
                                        @error('pays')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Informations de contact -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-info fw-bold mb-2">
                                    <i class="fas fa-phone me-2"></i>
                                    Informations de contact
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="Email" required>
                                        <label for="email"><i class="fas fa-envelope me-2"></i>Email *</label>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                               value="{{ old('telephone') }}" placeholder="Téléphone">
                                        <label for="telephone"><i class="fas fa-phone me-2"></i>Téléphone</label>
                                        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="fax" id="fax" class="form-control @error('fax') is-invalid @enderror"
                                               value="{{ old('fax') }}" placeholder="Fax">
                                        <label for="fax"><i class="fas fa-fax me-2"></i>Fax</label>
                                        @error('fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="url" name="site_web" id="site_web" class="form-control @error('site_web') is-invalid @enderror"
                                               value="{{ old('site_web') }}" placeholder="Site web">
                                        <label for="site_web"><i class="fas fa-globe me-2"></i>Site web</label>
                                        @error('site_web')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Contact principal -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-warning fw-bold mb-2">
                                    <i class="fas fa-user-tie me-2"></i>
                                    Contact principal
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="contact_nom" id="contact_nom" class="form-control @error('contact_nom') is-invalid @enderror"
                                               value="{{ old('contact_nom') }}" placeholder="Nom du contact">
                                        <label for="contact_nom"><i class="fas fa-user me-2"></i>Nom du contact</label>
                                        @error('contact_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="contact_prenom" id="contact_prenom" class="form-control @error('contact_prenom') is-invalid @enderror"
                                               value="{{ old('contact_prenom') }}" placeholder="Prénom du contact">
                                        <label for="contact_prenom"><i class="fas fa-user me-2"></i>Prénom du contact</label>
                                        @error('contact_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="contact_fonction" id="contact_fonction" class="form-control @error('contact_fonction') is-invalid @enderror"
                                               value="{{ old('contact_fonction') }}" placeholder="Fonction">
                                        <label for="contact_fonction"><i class="fas fa-briefcase me-2"></i>Fonction</label>
                                        @error('contact_fonction')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror"
                                               value="{{ old('contact_email') }}" placeholder="Email du contact">
                                        <label for="contact_email"><i class="fas fa-envelope me-2"></i>Email du contact</label>
                                        @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="contact_tel" id="contact_tel" class="form-control @error('contact_tel') is-invalid @enderror"
                                               value="{{ old('contact_tel') }}" placeholder="Téléphone du contact">
                                        <label for="contact_tel"><i class="fas fa-phone me-2"></i>Téléphone du contact</label>
                                        @error('contact_tel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="contact_mobile" id="contact_mobile" class="form-control @error('contact_mobile') is-invalid @enderror"
                                               value="{{ old('contact_mobile') }}" placeholder="Mobile du contact">
                                        <label for="contact_mobile"><i class="fas fa-mobile-alt me-2"></i>Mobile du contact</label>
                                        @error('contact_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <a href="{{ route('societes.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Enregistrer la société
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

    .progress {
        height: 8px;
        border-radius: 10px;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
        transition: width 0.6s ease;
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
    const form = document.getElementById('societeForm');
    const progressBar = document.querySelector('.progress-bar');

    // Progress calculation
    function updateProgress() {
        const totalFields = form.querySelectorAll('.form-control, .form-select').length;
        const filledFields = Array.from(form.querySelectorAll('.form-control, .form-select'))
            .filter(field => field.value.trim()).length;
        const progress = (filledFields / totalFields) * 100;

        progressBar.style.width = progress + '%';
        progressBar.textContent = Math.round(progress) + '%';
    }

    // Auto-fill city based on postal code (French postal codes)
    const codePostalField = document.getElementById('code_postal');
    const villeField = document.getElementById('ville');

    codePostalField.addEventListener('blur', function() {
        const codePostal = this.value.trim();
        if (codePostal.length === 5 && !villeField.value) {
            // Simple mapping for major French cities
            const cityMap = {
                '75001': 'Paris', '75002': 'Paris', '75003': 'Paris', '75004': 'Paris',
                '69001': 'Lyon', '69002': 'Lyon', '69003': 'Lyon',
                '13001': 'Marseille', '13002': 'Marseille', '13003': 'Marseille',
                '31000': 'Toulouse', '44000': 'Nantes', '67000': 'Strasbourg',
                '59000': 'Lille', '33000': 'Bordeaux', '06000': 'Nice'
            };

            if (cityMap[codePostal]) {
                villeField.value = cityMap[codePostal];
                updateProgress();
            }
        }
    });

    // Email validation enhancement
    const emailFields = document.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        field.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && !email.includes('@')) {
                this.classList.add('is-invalid');
                let feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = 'Veuillez saisir une adresse email valide';
                }
            }
        });
    });

    // Phone number formatting
    const telFields = document.querySelectorAll('input[type="tel"]');
    telFields.forEach(field => {
        field.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('33')) {
                    value = '+' + value.slice(0, 2) + ' ' + value.slice(2);
                } else if (value.length === 10) {
                    value = value.replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
                }
                this.value = value;
            }
        });
    });

    // URL validation for website
    const siteWebField = document.getElementById('site_web');
    siteWebField.addEventListener('blur', function() {
        let url = this.value.trim();
        if (url && !url.startsWith('http://') && !url.startsWith('https://')) {
            this.value = 'https://' + url;
        }
    });

    // Form validation
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
            updateProgress();
        });

        field.addEventListener('change', updateProgress);
    });

    // SIRET validation
    const siretField = document.getElementById('siret');
    siretField.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 14) {
            value = value.slice(0, 14);
        }
        this.value = value;
    });

    // Initial progress calculation
    updateProgress();
});
</script>
@endsection
