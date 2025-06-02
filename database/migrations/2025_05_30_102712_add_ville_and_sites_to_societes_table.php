<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('societes', function (Blueprint $table) {
            // Add 'siret' column if it doesn't exist.
            // Using 'string' type with nullable, consistent with your controller validation.
            // It's good practice to place new columns after existing ones, e.g., after 'nom'.
            // You can adjust the 'after' method as per your desired column order.
            if (!Schema::hasColumn('societes', 'siret')) {
                $table->string('siret', 14)->nullable()->after('nom');
            }

            // Ensure 'ville' is added if it's not present (from your original migration snippet)
            if (!Schema::hasColumn('societes', 'ville')) {
                $table->string('ville', 100)->nullable()->after('adresse');
            }

            // Ensure 'sites' is added and cast to JSON (as per previous discussions for array handling)
            // If you previously had 'sites' as a string, you might need to handle data conversion.
            if (!Schema::hasColumn('societes', 'sites')) {
                $table->json('sites')->nullable(); // Changed to json for array casting
            } else {
                // If 'sites' already exists but is not JSON, alter it.
                // This 'change()' method requires 'doctrine/dbal' package.
                // composer require doctrine/dbal
                $table->json('sites')->nullable()->change();
            }

            // Add other missing columns based on your form and controller validation
            // These were identified from the full controller validation in previous turns.
            if (!Schema::hasColumn('societes', 'secteur_activite')) {
                $table->string('secteur_activite', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'taille_entreprise')) {
                $table->string('taille_entreprise', 255)->nullable();
            }
            // Description is already a textarea, likely text type, but adding if missing
            if (!Schema::hasColumn('societes', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('societes', 'code_postal')) {
                $table->string('code_postal', 10)->nullable();
            }
            if (!Schema::hasColumn('societes', 'pays')) {
                $table->string('pays', 100)->nullable();
            }
            if (!Schema::hasColumn('societes', 'telephone')) {
                $table->string('telephone', 20)->nullable();
            }
            if (!Schema::hasColumn('societes', 'fax')) {
                $table->string('fax', 20)->nullable();
            }
            if (!Schema::hasColumn('societes', 'site_web')) {
                $table->string('site_web', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_nom')) {
                $table->string('contact_nom', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_prenom')) {
                $table->string('contact_prenom', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_fonction')) {
                $table->string('contact_fonction', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_email')) {
                $table->string('contact_email', 255)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_tel')) {
                $table->string('contact_tel', 20)->nullable();
            }
            if (!Schema::hasColumn('societes', 'contact_mobile')) {
                $table->string('contact_mobile', 20)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('societes', function (Blueprint $table) {
            // Drop all columns added in the 'up' method
            if (Schema::hasColumn('societes', 'siret')) {
                $table->dropColumn('siret');
            }
            if (Schema::hasColumn('societes', 'ville')) {
                $table->dropColumn('ville');
            }
            if (Schema::hasColumn('societes', 'sites')) {
                $table->dropColumn('sites');
            }
            if (Schema::hasColumn('societes', 'secteur_activite')) {
                $table->dropColumn('secteur_activite');
            }
            if (Schema::hasColumn('societes', 'taille_entreprise')) {
                $table->dropColumn('taille_entreprise');
            }
            if (Schema::hasColumn('societes', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('societes', 'code_postal')) {
                $table->dropColumn('code_postal');
            }
            if (Schema::hasColumn('societes', 'pays')) {
                $table->dropColumn('pays');
            }
            if (Schema::hasColumn('societes', 'telephone')) {
                $table->dropColumn('telephone');
            }
            if (Schema::hasColumn('societes', 'fax')) {
                $table->dropColumn('fax');
            }
            if (Schema::hasColumn('societes', 'site_web')) {
                $table->dropColumn('site_web');
            }
            if (Schema::hasColumn('societes', 'contact_nom')) {
                $table->dropColumn('contact_nom');
            }
            if (Schema::hasColumn('societes', 'contact_prenom')) {
                $table->dropColumn('contact_prenom');
            }
            if (Schema::hasColumn('societes', 'contact_fonction')) {
                $table->dropColumn('contact_fonction');
            }
            if (Schema::hasColumn('societes', 'contact_email')) {
                $table->dropColumn('contact_email');
            }
            if (Schema::hasColumn('societes', 'contact_tel')) {
                $table->dropColumn('contact_tel');
            }
            if (Schema::hasColumn('societes', 'contact_mobile')) {
                $table->dropColumn('contact_mobile');
            }
        });
    }
};
