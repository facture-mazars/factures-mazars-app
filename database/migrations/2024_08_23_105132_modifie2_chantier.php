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
            $table->dropColumn('id_partner_1');
            $table->dropColumn('id_partner_2');

        });
    }

    /**
     * Annuler les modifications apportées à la table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chantier', function (Blueprint $table) {

            // Restaurer les colonnes supprimées (en précisant leur type original)
            $table->integer('id_partner_1'); // Exemple de type, ajuste selon la définition originale
            $table->integer('id_partner_2');
        });
    }
};
