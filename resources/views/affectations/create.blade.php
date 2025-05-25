@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exchange-alt me-3 fs-4"></i>
                        <div>
                            <h4 class="mb-0">Nouvelle affectation</h4>
                            <small class="opacity-75">Créez une nouvelle affectation de matériel</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('affectations.store') }}" method="POST" id="affectationForm">
                        @csrf

                        <!-- Progress Bar -->
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%">0%</div>
                        </div>

                        <!-- Section 1: Informations de l'affectation -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <h5 class="text-primary fw-bold mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Détails de l'affectation
                                </h5>
                                <hr class="section-divider">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="materiel_id" id="materiel_id" class="form-select @error('materiel_id') is-invalid @enderror" required>
                                            <option value="">Sélectionnez un matériel</option>
                                            @foreach($materiels as $m)
                                            <option value="{{ $m->id }}" {{ old('materiel_id') == $m->id ? 'selected' : '' }}>{{ $m->nom }}</option>
                                            @endforeach
                                        </select>
                                        <label for="materiel_id"><i class="fas fa-laptop me-2"></i>Matériel *</label>
                                        @error('materiel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="societe_id" id="societe_id" class="form-select @error('societe_id') is-invalid @enderror" required>
                                            <option value="">Sélectionnez une société</option>
                                            @foreach($societes as $s)
                                            <option value="{{ $s->id }}" {{ old('societe_id') == $s->id ? 'selected' : '' }}>{{ $s->nom }}</option>
                                            @endforeach
                                        </select>
                                        <label for="societe_id"><i class="fas fa-building me-2"></i>Société *</label>
                                        @error('societe_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_affectation" id="date_affectation" class="form-control @error('date_affectation') is-invalid @enderror"
                                               value="{{ old('date_affectation', date('Y-m-d')) }}" required>
                                        <label for="date_affectation"><i class="fas fa-calendar-alt me-2"></i>Date d'affectation *</label>
                                        @error('date_affectation')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <a href="{{ route('affectations.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Enregistrer l'affectation
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
    const form = document.getElementById('affectationForm');
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

    // Initial progress calculation
    updateProgress();
});
</script>
@endsection
