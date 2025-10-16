<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Appliquer les modifications à la table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tranche_facture', function (Blueprint $table) {

         
              
            $table->unsignedBigInteger('id_pourcentage_debours')->nullable()->constrained();

              $table->foreign('id_pourcentage_debours')->references('id_taux')->on('taux');
             
        });
    }

    /**
     * Revenir en arrière des modifications.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tranche_facture', function (Blueprint $table) {
            // Réajouter les colonnes supprimées
           
      
         
     
        });
    }
};
