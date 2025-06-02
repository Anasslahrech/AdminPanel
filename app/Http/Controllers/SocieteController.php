<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // N'oubliez pas d'importer la classe Rule

class SocieteController extends Controller
{
    /**
     * Affiche une liste des ressources.
     */
    public function index()
    {
        $societes = Societe::latest()->get();
        return view('societes.index', compact('societes'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     */
    public function create()
    {
        // Passe les sites disponibles à la vue
        $availableSites = Societe::getSitesDisponibles();
        return view('societes.create', compact('availableSites'));
    }

    /**
     * Stocke une nouvelle ressource dans le stockage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:societes,nom',
            'siret' => 'nullable|string|max:14|unique:societes,siret',
            'secteur_activite' => 'nullable|string|max:255',
            'taille_entreprise' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            // Validation pour 'sites' comme un tableau de valeurs autorisées
            'sites' => 'nullable|array',
            'sites.*' => 'string|in:' . implode(',', array_keys(Societe::getSitesDisponibles())),
            'adresse' => 'required|string|max:500',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'required|string|max:100',
            'pays' => 'nullable|string|max:100',
            'email' => 'required|email|unique:societes,email',
            'telephone' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'site_web' => 'nullable|url|max:255',
            'contact_nom' => 'nullable|string|max:255',
            'contact_prenom' => 'nullable|string|max:255',
            'contact_fonction' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_tel' => 'nullable|string|max:20',
            'contact_mobile' => 'nullable|string|max:20',
        ], [
            'nom.required' => 'Le nom de la société est obligatoire.',
            'nom.unique' => 'Une société avec ce nom existe déjà.',
            'siret.unique' => 'Ce numéro SIRET est déjà utilisé.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'ville.required' => 'La ville est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'sites.array' => 'Les sites doivent être sous forme de liste.',
            'sites.*.in' => 'Un ou plusieurs sites sélectionnés ne sont pas valides.',
            'site_web.url' => 'Le site web doit être une URL valide.',
        ]);

        // Filtre les valeurs vides du tableau des sites si elles existent
        if (isset($validated['sites'])) {
            $validated['sites'] = array_filter($validated['sites']);
        } else {
            // S'assure que 'sites' est un tableau vide si non fourni, pour la cohérence avec le casting JSON
            $validated['sites'] = [];
        }

        Societe::create($validated);

        return redirect()
            ->route('societes.index')
            ->with('success', 'La société a été créée avec succès !');
    }

    /**
     * Affiche la ressource spécifiée.
     */
    public function show(Societe $societe)
    {
        return view('societes.show', compact('societe'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     */
    public function edit(Societe $societe)
    {
        // Passe les sites disponibles à la vue
        $availableSites = Societe::getSitesDisponibles();
        return view('societes.edit', compact('societe', 'availableSites'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     */
    public function update(Request $request, Societe $societe)
    {
        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('societes', 'nom')->ignore($societe->id)
            ],
            'siret' => [
                'nullable',
                'string',
                'max:14',
                Rule::unique('societes', 'siret')->ignore($societe->id)
            ],
            'secteur_activite' => 'nullable|string|max:255',
            'taille_entreprise' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            // Validation pour 'sites' comme un tableau de valeurs autorisées
            'sites' => 'nullable|array',
            'sites.*' => 'string|in:' . implode(',', array_keys(Societe::getSitesDisponibles())),
            'adresse' => 'required|string|max:500',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'required|string|max:100',
            'pays' => 'nullable|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('societes', 'email')->ignore($societe->id)
            ],
            'telephone' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'site_web' => 'nullable|url|max:255',
            'contact_nom' => 'nullable|string|max:255',
            'contact_prenom' => 'nullable|string|max:255',
            'contact_fonction' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_tel' => 'nullable|string|max:20',
            'contact_mobile' => 'nullable|string|max:20',
        ], [
            'nom.required' => 'Le nom de la société est obligatoire.',
            'nom.unique' => 'Une société avec ce nom existe déjà.',
            'siret.unique' => 'Ce numéro SIRET est déjà utilisé.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'ville.required' => 'La ville est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'sites.array' => 'Les sites doivent être sous forme de liste.',
            'sites.*.in' => 'Un ou plusieurs sites sélectionnés ne sont pas valides.',
            'site_web.url' => 'Le site web doit être une URL valide.',
        ]);

        // Filtre les valeurs vides du tableau des sites si elles existent
        if (isset($validated['sites'])) {
            $validated['sites'] = array_filter($validated['sites']);
        } else {
            // S'assure que 'sites' est un tableau vide si non fourni, pour la cohérence avec le casting JSON
            $validated['sites'] = [];
        }

        $societe->update($validated);

        return redirect()
            ->route('societes.index')
            ->with('success', 'La société a été mise à jour avec succès !');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     */
    public function destroy(Societe $societe)
    {
        $nom = $societe->nom;
        $societe->delete();

        return redirect()
            ->route('societes.index')
            ->with('success', "La société \"{$nom}\" a été supprimée avec succès !");
    }

    /**
     * Supprime plusieurs sociétés sélectionnées.
     */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:societes,id'
        ]);

        $count = Societe::whereIn('id', $request->ids)->count();
        Societe::whereIn('id', $request->ids)->delete();

        return redirect()
            ->route('societes.index')
            ->with('success', "{$count} société(s) ont été supprimée(s) avec succès !");
    }

    /**
     * Recherche de sociétés.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $ville = $request->get('ville', '');
        $site = $request->get('site', '');

        $societes = Societe::query();

        if (!empty($query)) {
            $societes->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('adresse', 'like', "%{$query}%");
            });
        }

        if (!empty($ville)) {
            $societes->where('ville', $ville);
        }

        // Ceci suppose que 'sites' est stocké comme un tableau JSON dans la base de données
        if (!empty($site)) {
            $societes->whereJsonContains('sites', $site);
        }

        $societes = $societes->latest()->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('societes.partials.table-rows', compact('societes'))->render(),
                'count' => $societes->count()
            ]);
        }

        return view('societes.index', compact('societes'));
    }

    /**
     * Export des données des sociétés.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        $societes = Societe::all();

        if ($format === 'csv') {
            return $this->exportCsv($societes);
        }

        return redirect()->back()->with('error', 'Format d\'export non supporté.');
    }

    private function exportCsv($societes)
    {
        $filename = 'societes_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($societes) {
            $file = fopen('php://output', 'w');
            // Assurez-vous que les en-têtes correspondent aux champs exportés
            fputcsv($file, ['ID', 'Nom', 'SIRET', 'Secteur d\'activité', 'Taille entreprise', 'Description', 'Sites', 'Adresse', 'Code Postal', 'Ville', 'Pays', 'Email', 'Téléphone', 'Fax', 'Site Web', 'Contact Nom', 'Contact Prénom', 'Contact Fonction', 'Contact Email', 'Contact Téléphone', 'Contact Mobile', 'Date de création', 'Dernière mise à jour']);

            foreach ($societes as $societe) {
                fputcsv($file, [
                    $societe->id,
                    $societe->nom,
                    $societe->siret,
                    $societe->secteur_activite,
                    $societe->taille_entreprise,
                    $societe->description,
                    // Implode le tableau des sites pour le CSV, en utilisant l'accesseur
                    implode(', ', $societe->sites_names),
                    $societe->adresse,
                    $societe->code_postal,
                    $societe->ville,
                    $societe->pays,
                    $societe->email,
                    $societe->telephone,
                    $societe->fax,
                    $societe->site_web,
                    $societe->contact_nom,
                    $societe->contact_prenom,
                    $societe->contact_fonction,
                    $societe->contact_email,
                    $societe->contact_tel,
                    $societe->contact_mobile,
                    $societe->created_at ? $societe->created_at->format('d/m/Y H:i') : '',
                    $societe->updated_at ? $societe->updated_at->format('d/m/Y H:i') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
