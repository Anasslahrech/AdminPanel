<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
    public function index()
    {
        $societes = Societe::all();
        return view('societes.index', compact('societes'));
    }

    public function create()
    {
        return view('societes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'email' => 'required|email',
        ]);

        Societe::create($request->all());

        return redirect()->route('societes.index')->with('success', 'Société ajoutée avec succès.');
    }

    public function edit($id)
    {
        $societe = Societe::findOrFail($id);
        return view('societes.edit', compact('societe'));
    }

    public function update(Request $request, $id)
    {
        $societe = Societe::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'email' => 'required|email',
        ]);

        $societe->update($request->all());

        return redirect()->route('societes.index')->with('success', 'Société mise à jour.');
    }

    public function destroy($id)
    {
        $societe = Societe::findOrFail($id);
        $societe->delete();

        return redirect()->route('societes.index')->with('success', 'Société supprimée.');
    }
}
