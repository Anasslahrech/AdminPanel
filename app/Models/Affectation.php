<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = ['materiel_id', 'societe_id', 'date_affectation'];

    // Cast date_affectation to a Carbon instance
    protected $casts = [
        'date_affectation' => 'datetime',
    ];

    // Une affectation appartient à un matériel
    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

    // Une affectation appartient à une société
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
