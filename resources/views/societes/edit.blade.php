@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
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

    <div class="card border-0 shadow-lg">
        <div class="card-body p-4">
            <form action="{{ route('societes.update', $societe->id) }}" method="POST" id="societeForm">
                @csrf
                @method('PUT')

                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%">0%</div>
                </div>

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
                                       value="{{ old('nom', $societe->nom) }}" placeholder="Nom de la société" required>
                                <label for="nom"><i class="fas fa-building me-2"></i>Nom de la société *</label>
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="siret" id="siret" class="form-control @error('siret') is-invalid @enderror"
                                       value="{{ old('siret', $societe->siret) }}" placeholder="Numéro SIRET">
                                <label for="siret"><i class="fas fa-id-card me-2"></i>SIRET</label>
                                @error('siret')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="secteur_activite" id="secteur_activite" class="form-select @error('secteur_activite') is-invalid @enderror">
                                    <option value="">Sélectionnez un secteur</option>
                                    <option value="Informatique" {{ old('secteur_activite', $societe->secteur_activite) == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                    <option value="Finance" {{ old('secteur_activite', $societe->secteur_activite) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="Industrie" {{ old('secteur_activite', $societe->secteur_activite) == 'Industrie' ? 'selected' : '' }}>Industrie</option>
                                    <option value="Services" {{ old('secteur_activite', $societe->secteur_activite) == 'Services' ? 'selected' : '' }}>Services</option>
                                    <option value="Commerce" {{ old('secteur_activite', $societe->secteur_activite) == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                                    <option value="Santé" {{ old('secteur_activite', $societe->secteur_activite) == 'Santé' ? 'selected' : '' }}>Santé</option>
                                    <option value="Éducation" {{ old('secteur_activite', $societe->secteur_activite) == 'Éducation' ? 'selected' : '' }}>Éducation</option>
                                    <option value="Autre" {{ old('secteur_activite', $societe->secteur_activite) == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                <label for="secteur_activite"><i class="fas fa-industry me-2"></i>Secteur d'activité</label>
                                @error('secteur_activite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="taille_entreprise" id="taille_entreprise" class="form-select @error('taille_entreprise') is-invalid @enderror">
                                    <option value="">Taille de l'entreprise</option>
                                    <option value="TPE (1-9 salariés)" {{ old('taille_entreprise', $societe->taille_entreprise) == 'TPE (1-9 salariés)' ? 'selected' : '' }}>TPE (1-9 salariés)</option>
                                    <option value="PME (10-249 salariés)" {{ old('taille_entreprise', $societe->taille_entreprise) == 'PME (10-249 salariés)' ? 'selected' : '' }}>PME (10-249 salariés)</option>
                                    <option value="ETI (250-4999 salariés)" {{ old('taille_entreprise', $societe->taille_entreprise) == 'ETI (250-4999 salariés)' ? 'selected' : '' }}>ETI (250-4999 salariés)</option>
                                    <option value="Grande entreprise (5000+ salariés)" {{ old('taille_entreprise', $societe->taille_entreprise) == 'Grande entreprise (5000+ salariés)' ? 'selected' : '' }}>Grande entreprise (5000+ salariés)</option>
                                </select>
                                <label for="taille_entreprise"><i class="fas fa-users me-2"></i>Taille de l'entreprise</label>
                                @error('taille_entreprise')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            style="height: 80px" placeholder="Description de la société">{{ old('description', $societe->description) }}</textarea>
                                <label for="description"><i class="fas fa-align-left me-2"></i>Description</label>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Champ Sites comme liste déroulante multi-sélection --}}
                        <div class="col-12">
                            <div class="form-floating">
                                {{-- Le nom du champ doit être 'sites[]' pour envoyer un tableau --}}
                                <select name="sites[]" id="sites" class="form-select @error('sites') is-invalid @enderror" multiple style="height: 120px;">
                                    <option value="">Sélectionnez un ou plusieurs sites</option>
                                    {{-- Parcourt les sites disponibles et marque ceux qui sont déjà sélectionnés --}}
                                    @foreach($availableSites as $key => $name)
                                        <option value="{{ $key }}"
                                            {{ in_array($key, old('sites', $societe->sites ?? [])) ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="sites"><i class="fas fa-sitemap me-2"></i>Sites</label>
                                @error('sites')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        {{-- Fin du champ Sites --}}

                    </div>
                </div>

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
                                       value="{{ old('adresse', $societe->adresse) }}" placeholder="Adresse complète" required>
                                <label for="adresse"><i class="fas fa-home me-2"></i>Adresse *</label>
                                @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="code_postal" id="code_postal" class="form-control @error('code_postal') is-invalid @enderror"
                                       value="{{ old('code_postal', $societe->code_postal) }}" placeholder="Code postal">
                                <label for="code_postal"><i class="fas fa-mail-bulk me-2"></i>Code postal</label>
                                @error('code_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="ville" id="ville" class="form-control @error('ville') is-invalid @enderror"
                                       value="{{ old('ville', $societe->ville) }}" placeholder="Ville">
                                <label for="ville"><i class="fas fa-city me-2"></i>Ville</label>
                                @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="pays" id="pays" class="form-control @error('pays') is-invalid @enderror"
                                       value="{{ old('pays', $societe->pays) }}" placeholder="Pays">
                                <label for="pays"><i class="fas fa-flag me-2"></i>Pays</label>
                                @error('pays')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

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
                                       value="{{ old('email', $societe->email) }}" placeholder="Email" required>
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email *</label>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                       value="{{ old('telephone', $societe->telephone) }}" placeholder="Téléphone">
                                <label for="telephone"><i class="fas fa-phone me-2"></i>Téléphone</label>
                                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="fax" id="fax" class="form-control @error('fax') is-invalid @enderror"
                                       value="{{ old('fax', $societe->fax) }}" placeholder="Fax">
                                <label for="fax"><i class="fas fa-fax me-2"></i>Fax</label>
                                @error('fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="url" name="site_web" id="site_web" class="form-control @error('site_web') is-invalid @enderror"
                                       value="{{ old('site_web', $societe->site_web) }}" placeholder="Site web">
                                <label for="site_web"><i class="fas fa-globe me-2"></i>Site web</label>
                                @error('site_web')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

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
                                       value="{{ old('contact_nom', $societe->contact_nom) }}" placeholder="Nom du contact">
                                <label for="contact_nom"><i class="fas fa-user me-2"></i>Nom du contact</label>
                                @error('contact_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="contact_prenom" id="contact_prenom" class="form-control @error('contact_prenom') is-invalid @enderror"
                                       value="{{ old('contact_prenom', $societe->contact_prenom) }}" placeholder="Prénom du contact">
                                <label for="contact_prenom"><i class="fas fa-user me-2"></i>Prénom du contact</label>
                                @error('contact_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="contact_fonction" id="contact_fonction" class="form-control @error('contact_fonction') is-invalid @enderror"
                                       value="{{ old('contact_fonction', $societe->contact_fonction) }}" placeholder="Fonction">
                                <label for="contact_fonction"><i class="fas fa-briefcase me-2"></i>Fonction</label>
                                @error('contact_fonction')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror"
                                       value="{{ old('contact_email', $societe->contact_email) }}" placeholder="Email du contact">
                                <label for="contact_email"><i class="fas fa-envelope me-2"></i>Email du contact</label>
                                @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="contact_tel" id="contact_tel" class="form-control @error('contact_tel') is-invalid @enderror"
                                       value="{{ old('contact_tel', $societe->contact_tel) }}" placeholder="Téléphone du contact">
                                <label for="contact_tel"><i class="fas fa-phone me-2"></i>Téléphone du contact</label>
                                @error('contact_tel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="contact_mobile" id="contact_mobile" class="form-control @error('contact_mobile') is-invalid @enderror"
                                       value="{{ old('contact_mobile', $societe->contact_mobile) }}" placeholder="Mobile du contact">
                                <label for="contact_mobile"><i class="fas fa-mobile-alt me-2"></i>Mobile du contact</label>
                                @error('contact_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

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
                            <i class="fas fa-save me-2"></i>Mettre à jour la société
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Styles de votre code précédent */
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

    // Calcul de la progression
    function updateProgress() {
        const totalFields = form.querySelectorAll('.form-control, .form-select').length;
        const filledFields = Array.from(form.querySelectorAll('.form-control, .form-select'))
            .filter(field => field.value.trim()).length;
        const progress = (filledFields / totalFields) * 100;

        progressBar.style.width = progress + '%';
        progressBar.textContent = Math.round(progress) + '%';
    }

    // Remplissage automatique de la ville en fonction du code postal (codes postaux français)
    const codePostalField = document.getElementById('code_postal');
    const villeField = document.getElementById('ville');

    codePostalField.addEventListener('blur', function() {
        const codePostal = this.value.trim();
        // N'essaie de remplir automatiquement que si le code postal a 5 chiffres et que le champ ville est vide
        if (codePostal.length === 5 && !villeField.value) {
            fetch(`https://api-adresse.data.gouv.fr/search/?q=${codePostal}&type=municipality&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.features.length > 0) {
                        const city = data.features[0].properties.city;
                        if (city) {
                            villeField.value = city;
                            updateProgress();
                        }
                    }
                })
                .catch(error => console.error('Erreur lors de la récupération de la ville :', error));
        }
    });

    // Amélioration de la validation de l'e-mail
    const emailFields = document.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        field.addEventListener('blur', function() {
            const email = this.value.trim();
            // Une regex plus robuste pour la validation de l'e-mail
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email)) {
                this.classList.add('is-invalid');
                let feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = 'Veuillez saisir une adresse e-mail valide (ex: exemple@domaine.com)';
                } else {
                    // Crée un message de feedback s'il n'existe pas
                    const newFeedback = document.createElement('div');
                    newFeedback.classList.add('invalid-feedback');
                    newFeedback.textContent = 'Veuillez saisir une adresse e-mail valide (ex: exemple@domaine.com)';
                    this.parentNode.appendChild(newFeedback);
                }
            } else {
                this.classList.remove('is-invalid');
                let feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = ''; // Efface le message si valide
                }
            }
        });
    });

    // Formatage des numéros de téléphone (numéros français)
    const telFields = document.querySelectorAll('input[type="tel"]');
    telFields.forEach(field => {
        field.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, ''); // Supprime les non-chiffres
            let formattedValue = '';

            if (value.startsWith('0')) { // Numéro local français
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 2 === 0) {
                        formattedValue += ' ';
                    }
                    formattedValue += value[i];
                }
            } else if (value.startsWith('33')) { // Format international +33
                formattedValue = '+33 ';
                for (let i = 2; i < value.length; i++) {
                    if ((i - 2) > 0 && (i - 2) % 2 === 0) {
                        formattedValue += ' ';
                    }
                    formattedValue += value[i];
                }
            } else { // Supposons que c'est un format international standard ou autre
                 formattedValue = value;
            }

            this.value = formattedValue.trim(); // Supprime tout espace de fin
        });
    });

    // Validation de l'URL et ajout automatique de http(s) pour le site web
    const siteWebField = document.getElementById('site_web');
    siteWebField.addEventListener('blur', function() {
        let url = this.value.trim();
        if (url && !url.startsWith('http://') && !url.startsWith('https://')) {
            this.value = 'https://' + url;
        }
    });

    // Validation du formulaire lors de la soumission
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

        // Ré-exécute la validation de l'e-mail sur tous les champs e-mail avant la soumission
        emailFields.forEach(field => {
            const email = field.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (field.hasAttribute('required') || email) { // Valide si requis ou s'il y a une saisie
                if (!emailRegex.test(email)) {
                    field.classList.add('is-invalid');
                    isValid = false;
                    let feedback = field.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.textContent = 'Veuillez saisir une adresse e-mail valide (ex: exemple@domaine.com)';
                    } else {
                        const newFeedback = document.createElement('div');
                        newFeedback.classList.add('invalid-feedback');
                        newFeedback.textContent = 'Veuillez saisir une adresse e-mail valide (ex: exemple@domaine.com)';
                        field.parentNode.appendChild(newFeedback);
                    }
                } else {
                    field.classList.remove('is-invalid');
                    let feedback = field.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.textContent = '';
                    }
                }
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

    // Supprime la classe invalid lors de la saisie
    document.querySelectorAll('.form-control, .form-select').forEach(field => {
        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
            updateProgress();
        });

        field.addEventListener('change', updateProgress); // Pour les sélections
    });

    // Validation SIRET (numérique et longueur)
    const siretField = document.getElementById('siret');
    siretField.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Supprime les non-chiffres
        if (value.length > 14) {
            value = value.slice(0, 14);
        }
        this.value = value;
    });

    // Calcul initial de la progression au chargement de la page
    updateProgress();
});
</script>
@endsection
