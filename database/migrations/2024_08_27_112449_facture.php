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
        Schema::create('facture', function (Blueprint $table) {
            $table->id('id_facture'); // Utilise 'id' pour créer une colonne de clé primaire auto-incrémentée
            $table->unsignedBigInteger('id_chantier');
            $table->string('ref_facture_emise', 50);
            $table->string('lib_facture', 250);
            $table->float('debours_decaissable');
            $table->float('debours_non_decaissable');
            $table->integer('nb_tranche_facture');
            $table->integer('etat')->default(0);

            $table->timestamps(); // Ajoute les colonnes created_at et updated_at

            $table->foreign('id_chantier')->references('id_chantier')->on('chantier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture');
    }
};
