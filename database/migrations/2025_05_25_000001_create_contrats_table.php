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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('societe_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('statut')->default('actif'); // Ajout de la colonne statut
            $table->timestamps();

            $table->engine = 'InnoDB'; // Assure le support des clés étrangères
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
