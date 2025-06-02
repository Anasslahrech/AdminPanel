<?php

namespace App\Imports;

use App\Models\Materiel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation; // IMPORTANT: Add this import
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log; // <--- ADD THIS LINE

class MaterielsImport implements ToModel, WithHeadingRow, WithValidation // IMPORTANT: Add WithValidation here
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Log the raw row data to help debug mapping issues
        Log::debug('Processing row for import:', $row); // Use Log directly after import

        // Helper function to safely convert Excel date to DateTime object
        $convertExcelDate = function($excelDate) {
            // Check if the value is not empty and is numeric
            if (!empty($excelDate) && is_numeric($excelDate)) {
                // Check if it's a valid Excel date number (e.g., greater than 0 for dates after 1900)
                if ($excelDate > 0) {
                    try {
                        return Date::excelToDateTimeObject($excelDate);
                    } catch (\Exception $e) {
                        // Log a warning if date conversion fails for a numeric value
                        Log::warning("Error converting Excel date '{$excelDate}' to DateTime object: " . $e->getMessage());
                        return null;
                    }
                }
            }
            return null; // Return null if not numeric, empty, or invalid Excel date number
        };

        return new Materiel([
            'nom'               => $row['nom'] ?? null,
            'reference'         => $row['reference'] ?? null,
            'type'              => $row['type'] ?? null,
            'quantite'          => (int) ($row['quantite'] ?? 0),
            'etat'              => $row['etat'] ?? null,
            'societe'           => $row['societe'] ?? null,
            'type_acquisition'  => $row['type_acquisition'] ?? null,
            'fournisseur'       => $row['fournisseur'] ?? null,
            'nat'               => $row['nat'] ?? null,
            'date_acquisition'  => $convertExcelDate($row['date_acquisition'] ?? null),
            'date_fin_garantie' => $convertExcelDate($row['date_fin_garantie'] ?? null),
            'libelle'           => $row['libelle'] ?? null,
            'sn'                => $row['sn'] ?? null,
            'nom_machine'       => $row['nom_machine'] ?? null,
            'ecran'             => $row['ecran'] ?? null,
            'utilisateur'       => $row['utilisateur'] ?? null,
            'service'           => $row['service'] ?? null,
            'departement'       => $row['departement'] ?? null,
            'direction'         => $row['direction'] ?? null,
            'etat_affectation'  => $row['etat_affectation'] ?? null,
        ]);
    }

    /**
     * Define validation rules for each row.
     * This will catch data type mismatches and missing required fields from your Excel file.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:materiels,reference',
            'type' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'etat' => 'nullable|string|in:Neuf,Usagé,Défaillant',
            'societe' => 'nullable|string|max:255',
            'type_acquisition' => 'nullable|string|max:255',
            'fournisseur' => 'nullable|string|max:255',
            'nat' => 'nullable|string|max:255',
            'date_acquisition' => 'nullable|numeric',
            'date_fin_garantie' => 'nullable|numeric',
            'libelle' => 'nullable|string|max:255',
            'sn' => 'nullable|string|max:255',
            'nom_machine' => 'nullable|string|max:255',
            'ecran' => 'nullable|string|max:255',
            'utilisateur' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'direction' => 'nullable|string|max:255',
            'etat_affectation' => 'nullable|string|max:255',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
