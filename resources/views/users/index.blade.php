@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    @if(session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
    @endif

    <!-- En-tête avec dégradé -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-2 fw-bold">
                                <i class="bi bi-people me-3"></i>Utilisateurs et Affectations
                            </h1>
                            <p class="mb-0 opacity-75">Consultation des utilisateurs et de leurs matériels affectés</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-lg shadow-sm" onclick="toggleFilter()">
                                <i class="bi bi-funnel me-2"></i>Filtrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $usersGrouped->count() }}</h3>
                    <p class="text-muted mb-0">Utilisateurs</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-laptop text-success fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $usersGrouped->sum(function($user) { return $user->count(); }) }}</h3>
                    <p class="text-muted mb-0">Affectations Totales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-graph-up text-info fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ number_format($usersGrouped->sum(function($user) { return $user->count(); }) / max($usersGrouped->count(), 1), 1) }}</h3>
                    <p class="text-muted mb-0">Moyenne par Utilisateur</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-calendar-check text-warning fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $usersGrouped->sum(function($user) { return $user->where('statut', 'actif')->count(); }) }}</h3>
                    <p class="text-muted mb-0">Affectations Actives</p>
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

    <!-- Barre de recherche et filtres -->
    <div class="card border-0 shadow-sm mb-4" id="filterCard" style="display: none;">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Rechercher un utilisateur</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Nom d'utilisateur..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Type de matériel</label>
                    <select class="form-select" id="typeFilter">
                        <option value="">Tous les types</option>
                        @foreach($usersGrouped->flatten()->unique('materiel_type')->pluck('materiel_type') as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Société</label>
                    <select class="form-select" id="societeFilter">
                        <option value="">Toutes les sociétés</option>
                        @foreach($usersGrouped->flatten()->unique('societe_nom')->pluck('societe_nom') as $societe)
                            <option value="{{ $societe }}">{{ $societe }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Actions</label>
                    <div class="d-grid">
                        <button class="btn btn-outline-secondary" onclick="resetFilters()">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau principal -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-table me-2"></i>Utilisateurs et leurs Affectations
                </h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success" onclick="downloadExcel()">
                        <i class="bi bi-file-earmark-excel me-1"></i>Excel
                    </button>
                    <button class="btn btn-outline-primary" onclick="downloadCSV()">
                        <i class="bi bi-file-earmark-text me-1"></i>CSV
                    </button>
                </div>
            </div>
        </div>

        @if($usersGrouped->isEmpty())
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Aucun utilisateur trouvé</h4>
                <p class="text-muted mb-4">Aucune affectation n'est enregistrée dans le système</p>
            </div>
        @else
            <div class="card-body p-0">
                @foreach($usersGrouped as $userName => $affectations)
                    <div class="user-section border-bottom" data-user="{{ strtolower($userName) }}">
                        <!-- En-tête utilisateur -->
                        <div class="user-header p-4 bg-light bg-opacity-50 border-bottom">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        <span class="fw-bold text-white">
                                            {{ strtoupper(substr($userName, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold text-dark">{{ $userName }}</h5>
                                        <small class="text-muted">
                                            <i class="bi bi-laptop me-1"></i>
                                            {{ $affectations->count() }} matériel(s) affecté(s)
                                        </small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                        aria-expanded="true">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Détails des affectations -->
                        <div class="collapse show" id="collapse{{ $loop->index }}">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0">Matériel</th>
                                            <th class="border-0">Référence</th>
                                            <th class="border-0">Type</th>
                                            <th class="border-0">Société</th>
                                            <th class="border-0">Date d'affectation</th>
                                            <th class="border-0">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($affectations as $affectation)
                                            <tr class="affectation-row"
                                                data-type="{{ strtolower($affectation->materiel_type) }}"
                                                data-societe="{{ strtolower($affectation->societe_nom) }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-circle me-2">
                                                            <i class="bi bi-laptop"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ $affectation->materiel_nom }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $affectation->materiel_reference }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $affectation->materiel_type }}</span>
                                                </td>
                                                <td>{{ $affectation->societe_nom }}</td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($affectation->date_affectation)->format('d/m/Y') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($affectation->statut == 'actif' || !$affectation->statut)
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle me-1"></i>Actif
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            <i class="bi bi-pause-circle me-1"></i>{{ ucfirst($affectation->statut) }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pied de page -->
            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <span id="userCount">{{ $usersGrouped->count() }}</span> utilisateur(s) -
                        <span id="affectationCount">{{ $usersGrouped->sum(function($user) { return $user->count(); }) }}</span> affectation(s)
                    </div>
                    <div class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Dernière mise à jour : {{ now()->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>
        @endif
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

.user-section {
    transition: all 0.3s ease;
}

.user-section:hover {
    background-color: rgba(0, 123, 255, 0.02);
}

.card {
    transition: all 0.3s ease;
    border-radius: 15px;
}

.btn {
    transition: all 0.3s ease;
}

.avatar-circle {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.icon-circle {
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
// Fonction pour basculer l'affichage des filtres
function toggleFilter() {
    const filterCard = document.getElementById('filterCard');
    filterCard.style.display = filterCard.style.display === 'none' ? 'block' : 'none';
}

// Fonction de recherche et filtrage
function applyFilters() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
    const societeFilter = document.getElementById('societeFilter').value.toLowerCase();

    const userSections = document.querySelectorAll('.user-section');
    let visibleUsers = 0;
    let visibleAffectations = 0;

    userSections.forEach(section => {
        const userName = section.dataset.user;
        const affectationRows = section.querySelectorAll('.affectation-row');
        let hasVisibleAffectations = false;

        // Vérifier si l'utilisateur correspond à la recherche
        const userMatches = !searchValue || userName.includes(searchValue);

        if (userMatches) {
            // Filtrer les affectations
            affectationRows.forEach(row => {
                const type = row.dataset.type;
                const societe = row.dataset.societe;

                const typeMatches = !typeFilter || type.includes(typeFilter);
                const societeMatches = !societeFilter || societe.includes(societeFilter);

                if (typeMatches && societeMatches) {
                    row.style.display = '';
                    hasVisibleAffectations = true;
                    visibleAffectations++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Afficher/masquer la section utilisateur
        if (userMatches && hasVisibleAffectations) {
            section.style.display = '';
            visibleUsers++;
        } else {
            section.style.display = 'none';
        }
    });

    // Mettre à jour les compteurs
    document.getElementById('userCount').textContent = visibleUsers;
    document.getElementById('affectationCount').textContent = visibleAffectations;
}

// Événements de filtrage
document.getElementById('searchInput').addEventListener('keyup', applyFilters);
document.getElementById('typeFilter').addEventListener('change', applyFilters);
document.getElementById('societeFilter').addEventListener('change', applyFilters);

// Fonction pour réinitialiser les filtres
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('societeFilter').value = '';
    applyFilters();
}

// Fonction pour extraire les données pour l'export
function extractDataForExport() {
    const data = [];
    const visibleSections = document.querySelectorAll('.user-section:not([style*="display: none"])');

    visibleSections.forEach(section => {
        const userName = section.querySelector('.fw-bold.text-dark').textContent;
        const visibleRows = section.querySelectorAll('.affectation-row:not([style*="display: none"])');

        visibleRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            data.push({
                'Utilisateur': userName,
                'Matériel': cells[0].querySelector('.fw-semibold').textContent.trim(),
                'Référence': cells[1].textContent.trim(),
                'Type': cells[2].textContent.trim(),
                'Société': cells[3].textContent.trim(),
                'Date affectation': cells[4].textContent.trim(),
                'Statut': cells[5].textContent.trim()
            });
        });
    });

    return data;
}

// Fonction de téléchargement Excel
function downloadExcel() {
    try {
        const data = extractDataForExport();
        if (data.length === 0) {
            alert('Aucune donnée à exporter');
            return;
        }

        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Utilisateurs_Affectations");

        const fileName = `utilisateurs_affectations_${new Date().toISOString().split('T')[0]}.xlsx`;
        XLSX.writeFile(wb, fileName);

        showNotification('Fichier Excel téléchargé avec succès!', 'success');
    } catch (error) {
        console.error('Erreur lors du téléchargement Excel:', error);
        showNotification('Erreur lors du téléchargement Excel', 'error');
    }
}

// Fonction de téléchargement CSV
function downloadCSV() {
    try {
        const data = extractDataForExport();
        if (data.length === 0) {
            alert('Aucune donnée à exporter');
            return;
        }

        const headers = Object.keys(data[0]);
        let csvContent = headers.join(',') + '\n';

        data.forEach(row => {
            const values = headers.map(header => `"${row[header]}"`);
            csvContent += values.join(',') + '\n';
        });

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);

        link.setAttribute('href', url);
        link.setAttribute('download', `utilisateurs_affectations_${new Date().toISOString().split('T')[0]}.csv`);
        link.style.visibility = 'hidden';

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showNotification('Fichier CSV téléchargé avec succès!', 'success');
    } catch (error) {
        console.error('Erreur lors du téléchargement CSV:', error);
        showNotification('Erreur lors du téléchargement CSV', 'error');
    }
}

// Fonction pour afficher les notifications
function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';

    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show border-0 shadow-sm position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';

    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-${type === 'success' ? 'success' : 'danger'} bg-opacity-10 p-2 me-3">
                <i class="bi ${iconClass} text-${type === 'success' ? 'success' : 'danger'}"></i>
            </div>
            <div class="flex-grow-1">
                ${message}
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 3000);
}
</script>
@endsection
