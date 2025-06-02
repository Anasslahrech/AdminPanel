<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Materiel;
use App\Models\Societe;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function index()
    {
        $affectations = Affectation::with('materiel', 'societe')->get();
        return view('affectations.index', compact('affectations'));
    }

    public function create()
    {
        $materiels = Materiel::all();
        $societes = Societe::all();
        return view('affectations.create', compact('materiels', 'societes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'societe_id' => 'required|exists:societes,id',
            'nom_utilisateur' => 'required|string|max:255',
            'date_affectation' => 'required|date',
        ]);

        Affectation::create($request->all());

        return redirect()->route('affectations.index')->with('success', 'Affectation enregistrée.');
    }

    public function edit($id)
    {
        $affectation = Affectation::findOrFail($id);
        $materiels = Materiel::all();
        $societes = Societe::all();
        return view('affectations.edit', compact('affectation', 'materiels', 'societes'));
    }

    public function update(Request $request, $id)
    {
        $affectation = Affectation::findOrFail($id);

        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'societe_id' => 'required|exists:societes,id',
            'nom_utilisateur' => 'required|string|max:255',
            'date_affectation' => 'required|date',
        ]);

        $affectation->update($request->all());

        return redirect()->route('affectations.index')->with('success', 'Affectation mise à jour.');
    }

    public function destroy($id)
    {
        $affectation = Affectation::findOrFail($id);
        $affectation->delete();

        return redirect()->route('affectations.index')->with('success', 'Affectation supprimée.');
    }

    public function bulkDelete(Request $request)
{
    Affectation::whereIn('id', $request->ids)->delete();
    return response()->json(['status' => 'success']);
}

public function show($id)
    {
        $affectation = Affectation::with(['materiel', 'societe'])->findOrFail($id);
        return view('affectations.show', compact('affectation'));
    }
}
