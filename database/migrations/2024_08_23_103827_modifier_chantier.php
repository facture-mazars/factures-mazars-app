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
            // Renommer une colonne existante
            $table->renameColumn('id_mission', 'id_chantier');

            // Ajouter de nouvelles colonnes
            $table->string('reference_chantier', 100);
            $table->date('date_debut_intervention');
            $table->date('date_fin_intervention');
            $table->date('date_initialisation');
            $table->integer('mandat');
            // Ajoute d'autres colonnes selon tes besoins


              // Supprimer des colonnes existantes
              $table->dropColumn('code_mission');
            
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
            // Renommer la colonne à son nom original
            $table->renameColumn('id_chantier', 'id_mission');

            // Supprimer les colonnes ajoutées
            $table->dropColumn(['reference_chantier', 'date_debut_intervention','date_fin_intervention','date_initialisation','mandat']);
            // Supprime d'autres colonnes si nécessaire


                 // Restaurer les colonnes supprimées (en précisant leur type original)
                 $table->string('code_mission'); // Exemple de type, ajuste selon la définition originale
               
        });
    }
};
