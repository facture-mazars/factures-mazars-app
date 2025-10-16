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
            // Modification des colonnes existantes pour les rendre nullable
          
            $table->string('ref_facture_emise')->nullable()->change();
            $table->string('lib_facture')->nullable()->change();
            $table->float('debours_decaissable')->nullable()->change();
            $table->float('debours_non_decaissable')->nullable()->change();
       

       
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
          
            $table->string('ref_facture_emise')->nullable(false)->change();
            $table->string('lib_facture')->nullable(false)->change();
            $table->float('debours_decaissable')->nullable(false)->change();
            $table->float('debours_non_decaissable')->nullable(false)->change();
        });
    }
};
