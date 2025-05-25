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
                                <i class="bi bi-file-earmark-text me-3"></i>Gestion des Contrats
                            </h1>
                            <p class="mb-0 opacity-75">Tableau de bord des contrats clients</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <i class="bi bi-funnel me-2"></i>Filtrer
                            </button>
                            <a href="{{ route('contrats.create') }}" class="btn btn-success btn-lg shadow-sm hover-lift">
                                <i class="bi bi-plus-circle me-2"></i>Nouveau contrat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $contrats->count() }}</h3>
                    <p class="text-muted mb-0">Total Contrats</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $contrats->where('date_fin', '>=', now())->count() }}</h3>
                    <p class="text-muted mb-0">Contrats Actifs</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $contrats->where('date_fin', '<', now())->count() }}</h3>
                    <p class="text-muted mb-0">Contrats Expirés</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages d'alerte -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                    <i class="bi bi-check-circle-fill text-success"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Succès !</strong> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        </div>
    @endif

    <!-- Tableau principal -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-table me-2"></i>Liste des Contrats
                </h5>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 bg-light"
                               placeholder="Rechercher..." id="searchInput">
                    </div>
                    <button class="btn btn-outline-secondary" onclick="exportTable()">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                </div>
            </div>
        </div>

        @if($contrats->isEmpty())
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Aucun contrat trouvé</h4>
                <p class="text-muted mb-4">Commencez par créer votre premier contrat</p>
                <a href="{{ route('contrats.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter un contrat
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="contratsTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="border-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="selectAll">
                                    ID
                                </div>
                            </th>
                            <th class="border-0">Société</th>
                            <th class="border-0">Date début</th>
                            <th class="border-0">Date fin</th>
                            <th class="border-0">Statut</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contrats as $contrat)
                            <tr class="table-row-hover">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-2 row-checkbox">
                                        <span class="badge bg-light text-dark">{{ $contrat->id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                            <i class="bi bi-building text-success"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $contrat->societe->nom }}</div>
                                            <small class="text-muted">{{ $contrat->societe->adresse ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $isExpired = \Carbon\Carbon::parse($contrat->date_fin)->isPast();
                                        $isExpiringSoon = \Carbon\Carbon::parse($contrat->date_fin)->diffInDays(now()) <= 30 && !$isExpired;
                                    @endphp
                                    <span class="badge bg-{{ $isExpired ? 'danger' : ($isExpiringSoon ? 'warning' : 'success') }}">
                                        {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    @if($isExpired)
                                        <span class="badge bg-danger d-inline-flex align-items-center">
                                            <i class="bi bi-x-circle me-1"></i>Expiré
                                        </span>
                                    @elseif($isExpiringSoon)
                                        <span class="badge bg-warning d-inline-flex align-items-center">
                                            <i class="bi bi-exclamation-triangle me-1"></i>Bientôt expiré
                                        </span>
                                    @else
                                        <span class="badge bg-success d-inline-flex align-items-center">
                                            <i class="bi bi-check-circle me-1"></i>Actif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('contrats.edit', $contrat->id) }}"
                                               class="btn btn-sm btn-outline-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer" onclick="confirmDelete({{ $contrat->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination et informations -->
            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Affichage de {{ $contrats->count() }} contrat(s)
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-danger" id="deleteSelected" style="display: none;">
                            <i class="bi bi-trash me-1"></i>Supprimer sélectionnés
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer ce contrat ?</p>
                <small class="text-muted">Cette action est irréversible.</small>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Supprimer
                    </button>
                </form>
            </div>
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

.table-row-hover {
    transition: all 0.3s ease;
}

.table-row-hover:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.badge {
    font-size: 0.75em;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-group .btn {
    border-radius: 0.375rem !important;
    margin: 0 1px;
}

#searchInput {
    border-radius: 0.5rem;
}

.input-group-text {
    border-radius: 0.5rem 0 0 0.5rem;
}

.alert {
    border-radius: 0.75rem;
}

code {
    font-size: 0.875em;
}
</style>

<script>
// Fonction de recherche
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#contratsTable tbody tr');

    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Gestion des cases à cocher
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const deleteBtn = document.getElementById('deleteSelected');

    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });

    deleteBtn.style.display = this.checked ? 'block' : 'none';
});

// Gestion des cases individuelles
document.querySelectorAll('.row-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const deleteBtn = document.getElementById('deleteSelected');
        const selectAll = document.getElementById('selectAll');

        deleteBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        selectAll.checked = checkedBoxes.length === document.querySelectorAll('.row-checkbox').length;
    });
});

// Fonction de confirmation de suppression
function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = `/contrats/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Fonction d'export (exemple)
function exportTable() {
    // Implémentation de l'export en CSV/Excel
    alert('Fonctionnalité d\'export à implémenter');
}

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
