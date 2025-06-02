@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Notifications : Matériels en stock faible</h2>
    @if($materiels->count() > 0)
        <ul class="list-group">
            @foreach($materiels as $materiel)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $materiel->nom }} (Référence : {{ $materiel->reference }})
                    <span class="badge bg-danger rounded-pill">Quantité : {{ $materiel->quantite }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-success mt-3">
            Aucun matériel en stock faible.
        </div>
    @endif
</div>
@endsection
