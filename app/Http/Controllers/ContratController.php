<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Societe;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratsExport;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::with('societe')->get();
        return view('contrats.index', compact('contrats'));
    }

    public function create()
    {
        $societes = Societe::all();
        return view('contrats.create', compact('societes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'societe_id' => 'required|exists:societes,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        Contrat::create($request->all());

        return redirect()->route('contrats.index')->with('success', 'Contrat ajouté.');
    }

    public function show($id)
    {
        $contrat = Contrat::with('societe')->findOrFail($id);
        return view('contrats.show', compact('contrat'));
    }

    public function edit($id)
    {
        $contrat = Contrat::findOrFail($id);
        $societes = Societe::all();
        return view('contrats.edit', compact('contrat', 'societes'));
    }

    public function update(Request $request, $id)
    {
        $contrat = Contrat::findOrFail($id);

        $request->validate([
            'societe_id' => 'required|exists:societes,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $contrat->update($request->all());

        return redirect()->route('contrats.index')->with('success', 'Contrat mis à jour.');
    }

    public function destroy($id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();

        return redirect()->route('contrats.index')->with('success', 'Contrat supprimé.');
    }

    // Export des contrats
    public function export($format = 'xlsx')
    {
        $formatsAutorises = ['xlsx', 'csv'];

        if (!in_array($format, $formatsAutorises)) {
            abort(404, "Format d'export non supporté.");
        }

        $fileName = 'contrats.' . $format;

        return Excel::download(new ContratsExport, $fileName);
    }
}
