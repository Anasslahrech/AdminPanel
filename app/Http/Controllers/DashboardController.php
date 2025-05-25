<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Affectation;
use App\Models\Societe;
use App\Models\Contrat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer les statistiques
        $total_materiels = Materiel::count();
        $total_societes = Societe::count();
        $total_affectations = Affectation::count();
        $total_contrats = Contrat::count();

        // Statistiques supplémentaires (optionnel)
        $equipements_actifs = Materiel::where('statut', 'actif')->count();
        $affectations_actives = Affectation::where('statut', 'active')->count();
        $contrats_actifs = Contrat::where('statut', 'actif')->count();
        $alertes = Contrat::where('date_fin', '<=', now()->addDays(30))->count(); // Contrats expirant dans 30 jours
        $maintenances = 0; // À adapter selon votre logique métier

        return view('dashboard', compact(
            'total_materiels',
            'total_societes',
            'total_affectations',
            'total_contrats',
            'equipements_actifs',
            'alertes',
            'maintenances'
        ));
    }
}
