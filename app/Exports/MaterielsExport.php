<?php

namespace App\Exports;

use App\Models\Materiel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Ajout pour les en-têtes

class MaterielsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Materiel::all();
    }

    // Ajout des en-têtes pour un meilleur export Excel
    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Référence',
            'Type',
            'Quantité',
            'État',
            'Société',
            'Type d\'acquisition',
            'Fournisseur',
            'NAT',
            'Date d\'acquisition',
            'Date fin garantie',
            'Libellé',
            'S/N',
            'Nom machine',
            'Écran',
            'Utilisateur',
            'Service',
            'Département',
            'Direction',
            'État affectation',
            'Créé le',
            'Mis à jour le'
        ];
    }
}
