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
        Schema::table('chantier', function (Blueprint $table) {


            $table->unsignedBigInteger('id_pays_intervention')->nullable(); // Ajoutez cette ligne

          

            $table->foreign('id_pays_intervention')->references('id_pays')->on('pays');

              // Supprimer des colonnes existantes
              $table->dropColumn('pays_intervention');
         
        });
    }

    /**
     * Revenir en arrière des modifications.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chantier', function (Blueprint $table) {
            // Réajouter les colonnes supprimées
            $table->boolean('pays_intervention')->nullable();
            $table->dropColumn('id_pays_intervention')->nullable();
     
        });
    }
};
