@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Centralized Alert Display --}}
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-2 me-3">
                    <i class="bi bi-x-circle-fill text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Erreur !</strong> {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        </div>
    @endif

    {{-- Moved the "alert" session handling here, if you still want it for general alerts --}}
    @if(session('alert') && !session('success') && !session('error'))
        <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                    <i class="bi bi-info-circle-fill text-info"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Information :</strong> {{ session('alert') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-2 fw-bold">
                                <i class="bi bi-tools me-3"></i>Gestion des Matériels
                            </h1>
                            <p class="mb-0 opacity-75">Tableau de bord des équipements informatiques</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <i class="bi bi-funnel me-2"></i>Filtrer
                            </button>
                            <a href="{{ route('materiels.create') }}" class="btn btn-success btn-lg shadow-sm hover-lift">
                                <i class="bi bi-plus-circle me-2"></i>Nouveau matériel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-laptop text-primary fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $materiels->count() }}</h3>
                    <p class="text-muted mb-0">Total Matériels</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $materiels->where('etat', 'Neuf')->count() }}</h3>
                    <p class="text-muted mb-0">État Neuf</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $materiels->where('etat', 'Usagé')->count() }}</h3>
                    <p class="text-muted mb-0">État Usagé</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-box text-info fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $materiels->sum('quantite') }}</h3>
                    <p class="text-muted mb-0">Quantité Totale</p>
                </div>
            </div>
        </div>
    </div>


    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-table me-2"></i>Liste des Matériels
                </h5>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 bg-light"
                               placeholder="Rechercher..." id="searchInput">
                    </div>
                    <a href="{{ route('materiels.export') }}" class="btn btn-outline-success">
                        <i class="bi bi-file-earmark-excel me-1"></i>Télécharger Excel
                    </a>
                    <a href="{{ route('materiels.export', ['format' => 'csv']) }}" class="btn btn-outline-primary ms-2">
                        <i class="bi bi-file-earmark-text me-1"></i>Télécharger CSV
                    </a>
                    {{-- New Import Button --}}
                    <button type="button" class="btn btn-outline-info ms-2" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i>Importer Excel
                    </button>
                </div>
            </div>
        </div>

        @if($materiels->isEmpty())
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Aucun matériel trouvé</h4>
                <p class="text-muted mb-4">Commencez par ajouter votre premier matériel</p>
                <a href="{{ route('materiels.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter un matériel
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="materielsTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="border-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="selectAll">
                                    ID
                                </div>
                            </th>
                            <th class="border-0">Nom</th>
                            <th class="border-0">Référence</th>
                            <th class="border-0">Type</th>
                            <th class="border-0 text-center">Quantité</th>
                            <th class="border-0 text-center">État</th>
                            <th class="border-0">Société</th>
                            <th class="border-0">Acquisition</th>
                            <th class="border-0">Fournisseur</th>
                            <th class="border-0">NAT</th>
                            <th class="border-0">Date Acq.</th>
                            <th class="border-0">Fin Garantie</th>
                            <th class="border-0">Libellé</th>
                            <th class="border-0">SN</th>
                            <th class="border-0">Machine</th>
                            <th class="border-0">Écran</th>
                            <th class="border-0">Utilisateur</th>
                            <th class="border-0">Service</th>
                            <th class="border-0">Département</th>
                            <th class="border-0">Direction</th>
                            <th class="border-0">Affectation</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materiels as $materiel)
                            <tr class="table-row-hover">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-2 row-checkbox">
                                        <span class="badge bg-light text-dark">{{ $materiel->id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="bi bi-laptop text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $materiel->nom }}</div>
                                            <small class="text-muted">{{ Str::limit($materiel->libelle ?? '', 30) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-dark">
                                        {{ $materiel->reference }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-20 text-info">
                                        {{ $materiel->type }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fs-6">
                                        {{ $materiel->quantite ?? 0 }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($materiel->etat)
                                        @php
                                            $etatConfig = [
                                                'Neuf' => ['bg' => 'success', 'icon' => 'check-circle'],
                                                'Usagé' => ['bg' => 'warning', 'icon' => 'exclamation-triangle'],
                                                'Défaillant' => ['bg' => 'danger', 'icon' => 'x-circle']
                                            ];
                                            $config = $etatConfig[$materiel->etat] ?? ['bg' => 'secondary', 'icon' => 'question-circle'];
                                        @endphp
                                        <span class="badge bg-{{ $config['bg'] }} d-inline-flex align-items-center">
                                            <i class="bi bi-{{ $config['icon'] }} me-1"></i>
                                            {{ $materiel->etat }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $materiel->societe ?? '-' }}</td>
                                <td>{{ $materiel->type_acquisition ?? '-' }}</td>
                                <td>{{ $materiel->fournisseur ?? '-' }}</td>
                                <td>{{ $materiel->nat ?? '-' }}</td>
                                <td>
                                    {{ $materiel->date_acquisition ? $materiel->date_acquisition->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    @if($materiel->date_fin_garantie)
                                        @php
                                            $isExpired = $materiel->date_fin_garantie->isPast();
                                            $isExpiringSoon = $materiel->date_fin_garantie->diffInDays(now()) <= 30 && !$isExpired;
                                        @endphp
                                        <span class="badge bg-{{ $isExpired ? 'danger' : ($isExpiringSoon ? 'warning' : 'success') }}">
                                            {{ $materiel->date_fin_garantie->format('d/m/Y') }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ Str::limit($materiel->libelle ?? '-', 20) }}</td>
                                <td>
                                    @if($materiel->sn)
                                        <code class="bg-light p-1 rounded">{{ $materiel->sn }}</code>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $materiel->nom_machine ?? '-' }}</td>
                                <td>{{ $materiel->ecran ?? '-' }}</td>
                                <td>
                                    @if($materiel->utilisateur)
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-secondary bg-opacity-10 p-1 me-2">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            {{ $materiel->utilisateur }}
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $materiel->service ?? '-' }}</td>
                                <td>{{ $materiel->departement ?? '-' }}</td>
                                <td>{{ $materiel->direction ?? '-' }}</td>
                                <td class="text-center">
                                    @if($materiel->etat_affectation)
                                        <span class="badge bg-info">{{ $materiel->etat_affectation }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <div class="btn-group" role="group">

                                            <a href="{{ route('materiels.edit', $materiel) }}"
                                               class="btn btn-sm btn-outline-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                            title="Supprimer" onclick="confirmDelete({{ $materiel->id }})">
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

            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Affichage de {{ $materiels->count() }} matériel(s)
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
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer ce matériel ?</p>
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

<div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-info text-white">
                <h5 class="modal-title" id="importExcelModalLabel">
                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Importer des Matériels (Excel)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('materiels.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-4">
                    <p class="text-muted mb-4">Veuillez sélectionner un fichier Excel (.xlsx ou .xls) à importer.</p>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="excelFile" name="file" accept=".xlsx, .xls" required>
                        <label class="input-group-text" for="excelFile">Parcourir</label>
                    </div>
                    @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info">
                        <i class="bi bi-upload me-1"></i>Importer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Your existing CSS styles */
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
    const tableRows = document.querySelectorAll('#materielsTable tbody tr');

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
    form.action = `/materiels/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
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

    // --- Added for Import Modal ---
    // Show the import modal automatically if there are validation errors related to the file upload
    @if($errors->has('file'))
        const importModal = new bootstrap.Modal(document.getElementById('importExcelModal'));
        importModal.show();
    @endif
    // --- End Added for Import Modal ---
});
</script>
@endsection
