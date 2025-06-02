<!-- resources/views/contrats/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Détails du contrat</h1>

    <p><strong>Société :</strong> {{ $contrat->societe->nom ?? 'N/A' }}</p>
    <p><strong>Date début :</strong> {{ $contrat->date_debut }}</p>
    <p><strong>Date fin :</strong> {{ $contrat->date_fin }}</p>

    <a href="{{ route('contrats.index') }}">Retour à la liste</a>
@endsection
