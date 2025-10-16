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


            $table->dropColumn('dateprobable_encaissement');
            $table->dropColumn('id_mode_encaissement');
            $table->dropColumn('date_encaissement_prevu_calcule');
            $table->dropColumn('id_cheque_banque');
             
            $table->unsignedBigInteger('id_banque')->nullable(); // Ajoutez cette ligne
            $table->foreign('id_banque')->references('id_banque')->on('banque');

            $table->unsignedBigInteger('id_cheque')->nullable(); // Ajoutez cette ligne
            $table->foreign('id_cheque')->references('id_cheque')->on('cheque');
            
            $table->float('montant_a_encaisse')->nullable();
            $table->float('pourcentage_encaisse')->nullable();
            $table->integer('etat')->default(0);

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
        
      
         
     
        });
    }
};
