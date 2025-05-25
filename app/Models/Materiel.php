<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiel extends Model
{
    use HasFactory;

    // Indique à Laravel que ces colonnes sont des dates et doivent être castées en objets Carbon
    protected $casts = [
        'date_acquisition' => 'datetime',
        'date_fin_garantie' => 'datetime',
    ];

    // Remplissables (assure-toi d’avoir toutes tes colonnes ici)
   protected $fillable = [
    'nom', 'reference', 'type', 'quantite', 'etat',
    'societe', 'type_acquisition', 'fournisseur', 'nat',
    'date_acquisition', 'date_fin_garantie',
    'libelle', 'sn', 'nom_machine', 'ecran',
    'utilisateur', 'service', 'departement', 'direction', 'etat_affectation',
];
}
