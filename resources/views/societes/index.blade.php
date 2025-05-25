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
                                <i class="bi bi-building me-3"></i>Gestion des Sociétés
                            </h1>
                            <p class="mb-0 opacity-75">Tableau de bord des sociétés partenaires</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <i class="bi bi-funnel me-2"></i>Filtrer
                            </button>
                            <a href="{{ route('societes.create') }}" class="btn btn-success btn-lg shadow-sm hover-lift">
                                <i class="bi bi-plus-circle me-2"></i>Nouvelle société
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-building text-primary fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $societes->count() }}</h3>
                    <p class="text-muted mb-0">Total Sociétés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-calendar-plus text-success fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $societes->where('created_at', '>=', now()->subMonth())->count() }}</h3>
                    <p class="text-muted mb-0">Ce mois</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-envelope text-info fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $societes->count() }}</h3>
                    <p class="text-muted mb-0">Emails configurés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-clock text-warning fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $societes->where('created_at', '>=', now()->subDay())->count() }}</h3>
                    <p class="text-muted mb-0">Aujourd'hui</p>
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
                    <i class="bi bi-table me-2"></i>Liste des Sociétés
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

        @if($societes->isEmpty())
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-building text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Aucune société trouvée</h4>
                <p class="text-muted mb-4">Commencez par ajouter votre première société</p>
                <a href="{{ route('societes.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter une société
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="societesTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="border-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="selectAll">
                                    ID
                                </div>
                            </th>
                            <th class="border-0">Nom</th>
                            <th class="border-0">Adresse</th>
                            <th class="border-0">Email</th>
                            <th class="border-0">Date de création</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($societes as $societe)
                            <tr class="table-row-hover">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-2 row-checkbox">
                                        <span class="badge bg-light text-dark">{{ $societe->id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <span class="text-primary fw-bold" style="font-size: 0.8rem;">
                                                {{ strtoupper(substr($societe->nom, 0, 2)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $societe->nom }}</div>
                                            <small class="text-muted">Société partenaire</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt text-muted me-2"></i>
                                        <span>{{ Str::limit($societe->adresse, 50) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope text-muted me-2"></i>
                                        <a href="mailto:{{ $societe->email }}" class="text-decoration-none">
                                            {{ $societe->email }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $societe->created_at->format('d/m/Y') }}</span>
                                        <small class="text-muted">{{ $societe->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    title="Voir détails" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $societe->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="{{ route('societes.edit', $societe) }}"
                                               class="btn btn-sm btn-outline-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer" onclick="confirmDelete({{ $societe->id }})">
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
                        Affichage de {{ $societes->count() }} société(s)
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-danger" id="deleteSelected" style="display: none;">
                            <i class="bi bi-trash me-1"></i>Supprimer sélectionnées
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modals de détails pour chaque société -->
@foreach($societes as $societe)
    <div class="modal fade" id="detailModal{{ $societe->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title">
                        <i class="bi bi-building me-2"></i>Détails de la société
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <span class="text-primary fw-bold fs-5">
                                        {{ strtoupper(substr($societe->nom, 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $societe->nom }}</h4>
                                    <span class="badge bg-primary">ID: {{ $societe->id }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted fw-semibold">
                                <i class="bi bi-geo-alt me-1"></i>Adresse
                            </label>
                            <div class="form-control-plaintext bg-light rounded p-3">{{ $societe->adresse }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted fw-semibold">
                                <i class="bi bi-envelope me-1"></i>Email
                            </label>
                            <div class="form-control-plaintext bg-light rounded p-3">
                                <a href="mailto:{{ $societe->email }}" class="text-decoration-none">{{ $societe->email }}</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted fw-semibold">
                                <i class="bi bi-calendar-plus me-1"></i>Date de création
                            </label>
                            <div class="form-control-plaintext bg-light rounded p-3">{{ $societe->created_at->format('d/m/Y à H:i') }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted fw-semibold">
                                <i class="bi bi-pencil me-1"></i>Dernière modification
                            </label>
                            <div class="form-control-plaintext bg-light rounded p-3">{{ $societe->updated_at->format('d/m/Y à H:i') }}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ route('societes.edit', $societe->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Modifier
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

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
                <p class="mb-1">Êtes-vous sûr de vouloir supprimer cette société ?</p>
                <p class="text-muted mb-0">
                    <strong id="deleteCompanyName"></strong>
                </p>
                <small class="text-muted">Cette action est irréversible.</small>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Supprimer définitivement
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

.form-control-plaintext {
    background: #f8f9fa !important;
    border: 1px solid #e9ecef !important;
    font-weight: 500;
}

.modal-content {
    border-radius: 1rem;
}

.modal-header {
    border-radius: 1rem 1rem 0 0;
}
</style>

<script>
// Fonction de recherche
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#societesTable tbody tr');

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
    const companyName = document.getElementById('deleteCompanyName');

    // Récupérer le nom de la société depuis le tableau
    const row = document.querySelector(`tr[data-id="${id}"]`) ||
                document.querySelector(`input[onclick*="${id}"]`).closest('tr');
    const societeName = row ? row.querySelector('td:nth-child(2) .fw-semibold').textContent : '';

    form.action = `/societes/${id}`;
    companyName.textContent = societeName;

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

    // Auto-hide success alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
@endsection
