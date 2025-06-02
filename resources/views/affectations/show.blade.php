<!-- resources/views/affectations/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Détails de l'affectation</h1>

    <p><strong>Société :</strong> {{ $affectation->societe->nom ?? 'N/A' }}</p>
    <p><strong>Matériel :</strong> {{ $affectation->materiel->nom ?? 'N/A' }}</p>
    <p><strong>Nom utilisateur :</strong> {{ $affectation->nom_utilisateur }}</p>
    <p><strong>Date d'affectation :</strong> {{ $affectation->date_affectation->format('d/m/Y') }}</p>
    <p><strong>Statut :</strong> {{ $affectation->statut }}</p>

    <a href="{{ route('affectations.index') }}">Retour à la liste</a>
@endsection
