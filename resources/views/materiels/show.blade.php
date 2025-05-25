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
                                <i class="bi bi-laptop me-3"></i>Détails du Matériel
                            </h1>
                            <p class="mb-0 opacity-75">{{ $materiel->nom }} - {{ $materiel->reference }}</p>
                        </div>
                        <div>
                            <a href="{{ route('materiels.index') }}" class="btn btn-light btn-lg shadow-sm hover-lift">
                                <i class="bi bi-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">Informations de base</h5>
                        <hr>
                        <p><strong>Nom:</strong> {{ $materiel->nom }}</p>
                        <p><strong>Référence:</strong> {{ $materiel->reference }}</p>
                        <p><strong>Type:</strong> {{ $materiel->type }}</p>
                        <p><strong>Quantité:</strong> {{ $materiel->quantite }}</p>
                        <p><strong>État:</strong>
                            <span class="badge bg-{{ $materiel->etat === 'Neuf' ? 'success' : ($materiel->etat === 'Usagé' ? 'warning' : 'danger') }}">
                                {{ $materiel->etat }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">Détails techniques</h5>
                        <hr>
                        <p><strong>Numéro de série:</strong> {{ $materiel->sn ?? '-' }}</p>
                        <p><strong>Nom machine:</strong> {{ $materiel->nom_machine ?? '-' }}</p>
                        <p><strong>Écran:</strong> {{ $materiel->ecran ?? '-' }}</p>
                        <p><strong>Libellé:</strong> {{ $materiel->libelle ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">Acquisition</h5>
                        <hr>
                        <p><strong>Société:</strong> {{ $materiel->societe ?? '-' }}</p>
                        <p><strong>Type d'acquisition:</strong> {{ $materiel->type_acquisition ?? '-' }}</p>
                        <p><strong>Fournisseur:</strong> {{ $materiel->fournisseur ?? '-' }}</p>
                        <p><strong>NAT:</strong> {{ $materiel->nat ?? '-' }}</p>
                        <p><strong>Date acquisition:</strong> {{ $materiel->date_acquisition?->format('d/m/Y') ?? '-' }}</p>
                        <p><strong>Fin garantie:</strong>
                            @if($materiel->date_fin_garantie)
                                <span class="badge bg-{{ $materiel->date_fin_garantie->isPast() ? 'danger' : 'success' }}">
                                    {{ $materiel->date_fin_garantie->format('d/m/Y') }}
                                </span>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">Affectation</h5>
                        <hr>
                        <p><strong>Utilisateur:</strong> {{ $materiel->utilisateur ?? '-' }}</p>
                        <p><strong>Service:</strong> {{ $materiel->service ?? '-' }}</p>
                        <p><strong>Département:</strong> {{ $materiel->departement ?? '-' }}</p>
                        <p><strong>Direction:</strong> {{ $materiel->direction ?? '-' }}</p>
                        <p><strong>État d'affectation:</strong>
                            @if($materiel->etat_affectation)
                                <span class="badge bg-info">{{ $materiel->etat_affectation }}</span>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('materiels.edit', $materiel) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil me-1"></i> Modifier
                </a>
                <form action="{{ route('materiels.destroy', $materiel) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce matériel?')">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
