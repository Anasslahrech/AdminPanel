<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'email'];

    // Une société peut avoir plusieurs affectations
    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }

    // Une société peut avoir plusieurs contrats
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}

