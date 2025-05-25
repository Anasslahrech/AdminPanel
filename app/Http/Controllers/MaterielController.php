<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MaterielsExport;

class MaterielController extends Controller
{
    /**
     * Affiche la liste des matériels
     */
    public function index()
{
    // Pagination à 15 matériels par page (à adapter)
    $materiels = Materiel::paginate(15);

    // On vérifie la quantité sur TOUTE la table, pas juste la page en cours
    $lowStock = Materiel::where('quantite', '<', 5)->exists();

    if ($lowStock) {
        session()->flash('alert', 'Attention, certains matériels ont une quantité inférieure à 5 !');
    }

    return view('materiels.index', compact('materiels'));
}



    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('materiels.create');
    }

    /**
     * Enregistre un nouveau matériel
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:materiels,reference',
            'type' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'etat' => 'nullable|string|max:255',
            'societe' => 'nullable|string|max:255',
            'type_acquisition' => 'nullable|string|max:255',
            'fournisseur' => 'nullable|string|max:255',
            'nat' => 'nullable|string|max:255',
            'date_acquisition' => 'nullable|date',
            'date_fin_garantie' => 'nullable|date',
            'libelle' => 'nullable|string|max:255',
            'sn' => 'nullable|string|max:255',
            'nom_machine' => 'nullable|string|max:255',
            'ecran' => 'nullable|string|max:255',
            'utilisateur' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'direction' => 'nullable|string|max:255',
            'etat_affectation' => 'nullable|string|max:255',
        ]);

        Materiel::create($validated);

        return redirect()->route('materiels.index')
                         ->with('success', 'Matériel créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);
        return view('materiels.edit', compact('materiel'));
    }

    /**
     * Met à jour un matériel existant
     */
    public function update(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:materiels,reference,' . $id,
            'type' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'etat' => 'nullable|string|max:255',
            'societe' => 'nullable|string|max:255',
            'type_acquisition' => 'nullable|string|max:255',
            'fournisseur' => 'nullable|string|max:255',
            'nat' => 'nullable|string|max:255',
            'date_acquisition' => 'nullable|date',
            'date_fin_garantie' => 'nullable|date',
            'libelle' => 'nullable|string|max:255',
            'sn' => 'nullable|string|max:255',
            'nom_machine' => 'nullable|string|max:255',
            'ecran' => 'nullable|string|max:255',
            'utilisateur' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'direction' => 'nullable|string|max:255',
            'etat_affectation' => 'nullable|string|max:255',
        ]);

        $materiel->update($validated);

        return redirect()->route('materiels.index')
                         ->with('success', 'Matériel mis à jour avec succès.');
    }

    /**
     * Supprime un matériel
     */
    public function destroy($id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->route('materiels.index')
                         ->with('success', 'Matériel supprimé avec succès.');
    }

    /**
     * Affiche les détails d'un matériel
     */
    public function show(Materiel $materiel)
    {
        return view('materiels.show', compact('materiel'));
    }

    /**
     * Exporte les matériels en Excel/CSV
     */
    public function export()
    {
        $format = request('format', 'xlsx'); // 'xlsx' par défaut
        $filename = 'materiels-' . now()->format('Y-m-d') . '.' . $format;

        return Excel::download(new MaterielsExport(), $filename);
    }
}
