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
        Schema::create('secteur_activite', function (Blueprint $table) {
            $table->id('id_secteur_activite');
            $table->string('code_secteur', 50)->nullable();
            $table->string('nom_secteur_activite', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secteur_activite');
    }
};
