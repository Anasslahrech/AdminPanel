<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('societes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('email')->unique();
            $table->timestamps();

            $table->engine = 'InnoDB'; // Pour supporter les clés étrangères
        });
    }

    public function down()
    {
        Schema::dropIfExists('societes');
    }
};
