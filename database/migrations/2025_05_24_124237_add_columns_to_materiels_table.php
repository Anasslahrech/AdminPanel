<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMaterielsTable extends Migration
{
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Ajouter ici toutes les colonnes manquantes

            $table->string('fournisseur')->nullable()->after('type_acquisition');
            $table->string('nat')->nullable()->after('fournisseur');
            $table->date('date_acquisition')->nullable()->after('nat');
            $table->date('date_fin_garantie')->nullable()->after('date_acquisition');
            $table->string('libelle')->nullable()->after('date_fin_garantie');
            $table->string('sn')->nullable()->after('libelle');
            $table->string('nom_machine')->nullable()->after('sn');
            $table->string('ecran')->nullable()->after('nom_machine');
            $table->string('utilisateur')->nullable()->after('ecran');
            $table->string('service')->nullable()->after('utilisateur');
            $table->string('departement')->nullable()->after('service');
            $table->string('direction')->nullable()->after('departement');
            $table->string('etat_affectation')->nullable()->after('direction');
        });
    }

    public function down()
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->dropColumn([
                'type_acquisition', 'fournisseur', 'nat', 'date_acquisition', 'date_fin_garantie',
                'libelle', 'sn', 'nom_machine', 'ecran', 'utilisateur', 'service', 'departement',
                'direction', 'etat_affectation'
            ]);
        });
    }
}
