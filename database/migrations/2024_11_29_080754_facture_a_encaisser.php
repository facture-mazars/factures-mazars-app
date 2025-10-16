<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // Migration pour créer la table 'facture_a_encaisser'
public function up()
{
    Schema::create('facture_a_encaisser', function (Blueprint $table) {
        $table->id(); // Clé primaire
        $table->unsignedBigInteger('id_tranche_facture')->nullable(); // Ajoutez cette ligne
        $table->foreign('id_tranche_facture')->references('id_tranche_facture')->on('tranche_facture');
        $table->float('total_a_payer'); // Montant à payer
        $table->timestamps(); // Pour stocker les dates de création et de mise à jour
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture_a_encaisser');
    }
};

