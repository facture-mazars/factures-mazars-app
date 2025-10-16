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
        Schema::table('client', function (Blueprint $table) {


            // Ajouter de nouvelles colonnes
            $table->string('telephone_societe')->nullable();
            $table->string('email_societe')->nullable();
         
            // Ajoute d'autres colonnes selon tes besoins


              // Supprimer des colonnes existantes
              $table->dropColumn('dom_export');
            
        });
    }

 /**
     * Annuler les modifications apportées à la table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
          
            // Supprimer les colonnes ajoutées
            $table->dropColumn(['telephone_societe', 'email_societe']);
            // Supprime d'autres colonnes si nécessaire


                 // Restaurer les colonnes supprimées (en précisant leur type original)
                 $table->string('dom_export'); // Exemple de type, ajuste selon la définition originale
               
        });
    }
};
