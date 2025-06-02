<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'materiel_id',
        'societe_id',
        'nom_utilisateur',
        'date_affectation',
        'statut'
    ];

    // Cast date_affectation to a Carbon instance
    protected $casts = [
        'date_affectation' => 'datetime',
    ];

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }


}

