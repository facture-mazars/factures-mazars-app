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

            // Supprimer des colonnes existantes
            $table->dropColumn('reference_chantier');
            $table->dropColumn('date_initialisation');
            $table->dropColumn('date_debut_intervention');
            $table->dropColumn('date_fin_intervention');

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
            $table->string('reference_chantier')->nullable();
            $table->date('date_initialisation')->nullable();
            $table->date('date_debut_intervention')->nullable();
            $table->date('date_fin_intervention')->nullable();

        });
    }
};
