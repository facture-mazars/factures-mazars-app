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
        Schema::table('budget', function (Blueprint $table) {
          

     
            // Ajoute d'autres colonnes selon tes besoins
            $table->unsignedBigInteger('id_chantier');

            $table->foreign('id_chantier')->references('id_chantier')->on('chantier');
            
        });
    }

 /**
     * Annuler les modifications apportées à la table.
     *
     * @return void
     */
    public function down()
    {
       
    }
};
