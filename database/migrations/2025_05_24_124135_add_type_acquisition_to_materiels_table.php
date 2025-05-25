<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('materiels', function (Blueprint $table) {
        $table->string('type_acquisition')->nullable()->after('societe');
        // ajoute d'autres colonnes manquantes si besoin
    });
}

public function down()
{
    Schema::table('materiels', function (Blueprint $table) {
        $table->dropColumn('type_acquisition');
        // supprime aussi les autres colonnes ajoutées si besoin
    });
}

};
