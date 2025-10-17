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
        Schema::create('equipe', function (Blueprint $table) {
            $table->id('id_equipe');
            $table->unsignedBigInteger('id_chantier');
            $table->unsignedBigInteger('id_grade');
            $table->unsignedBigInteger('id_liste_personnel');

            $table->timestamps();

            $table->foreign('id_chantier')->references('id_chantier')->on('chantier');
            $table->foreign('id_grade')->references('id_grade')->on('grade');
            $table->foreign('id_liste_personnel')->references('id_liste_personnel')->on('liste_personnel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
