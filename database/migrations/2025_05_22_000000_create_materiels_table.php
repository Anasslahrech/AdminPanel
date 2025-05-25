<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Met avant les colonnes pour garantir InnoDB et support FK

            $table->id();
            $table->string('nom');
            $table->string('reference')->unique();
            $table->string('type');
            $table->string('etat')->nullable();
            $table->string('statut')->default('actif');
            $table->foreignId('societe_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materiels');
    }
};
