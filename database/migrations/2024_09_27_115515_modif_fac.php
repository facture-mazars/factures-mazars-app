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
        Schema::table('facture', function (Blueprint $table) {

            // Supprimer des colonnes existantes
            $table->dropColumn('lib_facture');

        });
    }

    /**
     * Revenir en arrière des modifications.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facture', function (Blueprint $table) {
            // Réajouter les colonnes supprimées
            $table->string('lib_facture')->nullable();

        });
    }
};
