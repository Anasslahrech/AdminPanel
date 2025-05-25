<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = ['societe_id', 'date_debut', 'date_fin'];

    // Un contrat appartient à une société
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
