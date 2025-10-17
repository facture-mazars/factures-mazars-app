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
        Schema::table('encaissement', function (Blueprint $table) {

            $table->unsignedBigInteger('id_cheque_banque')->nullable(); // Ajoutez cette ligne

            $table->foreign('id_cheque_banque')->references('id_cheque_banque')->on('cheque_banque');

            // Supprimer des colonnes existantes
            $table->dropColumn('banque');
            $table->dropColumn('ref_encaissement');

        });
    }

    /**
     * Revenir en arrière des modifications.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encaissement', function (Blueprint $table) {
            // Réajouter les colonnes supprimées
            $table->boolean('banque')->nullable();
            $table->boolean('ref_encaissement')->nullable();
            $table->dropColumn('id_cheque_banque')->nullable();

        });
    }
};
