<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Affectation;

class UserController extends Controller
{
    public function index()
    {
        // Récupérer les utilisateurs avec leurs affectations
        $users = DB::table('affectations')
                    ->join('materiels', 'affectations.materiel_id', '=', 'materiels.id')
                    ->join('societes', 'affectations.societe_id', '=', 'societes.id')
                    ->select(
                        'affectations.nom_utilisateur',
                        'affectations.id as affectation_id',
                        'affectations.date_affectation',
                        'affectations.statut',
                        'materiels.nom as materiel_nom',
                        'materiels.reference as materiel_reference',
                        'materiels.type as materiel_type',
                        'societes.nom as societe_nom'
                    )
                    ->orderBy('affectations.nom_utilisateur')
                    ->orderBy('affectations.date_affectation', 'desc')
                    ->get();

        // Grouper les affectations par utilisateur
        $usersGrouped = $users->groupBy('nom_utilisateur');

        return view('users.index', compact('usersGrouped'));
    }
}
