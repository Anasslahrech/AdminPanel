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
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materiel_id');
            $table->unsignedBigInteger('societe_id');
            $table->date('date_affectation');
            $table->string('statut')->default('active');  // Ajout de la colonne statut
            $table->timestamps();

            $table->foreign('materiel_id')->references('id')->on('materiels')->onDelete('cascade');
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
