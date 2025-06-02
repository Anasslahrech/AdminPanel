<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'siret',
        'secteur_activite',
        'taille_entreprise',
        'description',
        'sites', // Ce champ sera casté en tableau/JSON
        'adresse',
        'code_postal',
        'ville',
        'pays',
        'email',
        'telephone',
        'fax',
        'site_web',
        'contact_nom',
        'contact_prenom',
        'contact_fonction',
        'contact_email',
        'contact_tel',
        'contact_mobile',
    ];

    // Caste l'attribut 'sites' en tableau pour la sérialisation/désérialisation JSON automatique
    protected $casts = [
        'sites' => 'array',
    ];

    /**
     * Récupère une liste des sites disponibles (par exemple, à partir d'une configuration, d'une base de données ou d'un tableau statique).
     * Cette méthode est utilisée pour la validation et le remplissage des listes déroulantes/cases à cocher.
     * Remplacez ceci par votre liste réelle de sites prédéfinis.
     *
     * @return array
     */
    public static function getSitesDisponibles(): array
    {
        // Exemple : Remplacez par votre liste réelle de sites disponibles
        return [
            'site_paris' => 'Site de Paris',
            'site_lyon' => 'Site de Lyon',
            'site_marseille' => 'Site de Marseille',
            'site_nantes' => 'Site de Nantes',
            'site_bordeaux' => 'Site de Bordeaux',
            // Ajoutez d'autres sites si nécessaire
        ];
    }

    /**
     * Accesseur pour obtenir les noms affichables des sites sélectionnés.
     * Ceci est utile pour l'affichage dans les tableaux ou les exportations.
     *
     * @return array
     */
    public function getSitesNamesAttribute(): array
    {
        $selectedSiteKeys = $this->sites ?? []; // Récupère les clés des sites stockés (par exemple, ['site_paris', 'site_lyon'])
        $availableSites = self::getSitesDisponibles(); // Récupère la carte de tous les sites disponibles

        $displayNames = [];
        foreach ($selectedSiteKeys as $key) {
            if (isset($availableSites[$key])) {
                $displayNames[] = $availableSites[$key];
            }
        }
        return $displayNames;
    }
}
