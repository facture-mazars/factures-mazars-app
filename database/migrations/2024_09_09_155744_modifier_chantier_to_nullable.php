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
            // Modification des colonnes existantes pour les rendre nullable
            $table->unsignedBigInteger('id_client')->nullable()->change();
            $table->unsignedBigInteger('id_type_mission')->nullable()->change();
            $table->unsignedBigInteger('id_sous_type_mission')->nullable()->change();
            $table->date('debut_exercice')->nullable()->change();
            $table->date('fin_exercice')->nullable()->change();
            $table->boolean('est_recurrent')->nullable()->change();
            $table->boolean('est_refere')->nullable()->change();
            $table->string('numero_lp_contrat')->nullable()->change();
            $table->date('date_lp_contrat')->nullable()->change();
            $table->string('bailleur')->nullable()->change();
            $table->string('lp_contrat')->nullable()->change();
            $table->string('pays_intervention')->nullable()->change();
            $table->unsignedBigInteger('id_monnaie')->nullable()->change();
            $table->string('referant')->nullable()->change();
            $table->string('origine_contrat')->nullable()->change();
            $table->boolean('engagement_with_individuel')->nullable()->change();
            $table->text('details_engagement_with_individuel')->nullable()->change();
            $table->boolean('engagement_with_other_mazars_entity')->nullable()->change();
            $table->text('details_engagement_with_other_mazars_entity')->nullable()->change();
            $table->boolean('framework_agreement')->nullable()->change();
            $table->text('details_framework_agreement')->nullable()->change();
            $table->string('reference_chantier')->nullable()->change();
            $table->date('date_debut_intervention')->nullable()->change();
            $table->date('date_fin_intervention')->nullable()->change();
            $table->date('date_initialisation')->nullable()->change();
            $table->enum('dom_export', ['Domestique', 'Export'])->nullable();

            // Supprimer des colonnes existantes
            $table->dropColumn('est_cloture');
            $table->dropColumn('nombre_annee');
            $table->dropColumn('evaluation_honoraire');
            $table->dropColumn('mandat');
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
            $table->boolean('est_cloture')->nullable();
            $table->integer('nombre_annee')->nullable();
            $table->decimal('evaluation_honoraire', 10, 2)->nullable();
            $table->integer('mandat')->nullable();

            // Remettre les colonnes modifiées à leur état précédent
            $table->unsignedBigInteger('id_client')->nullable(false)->change();
            $table->unsignedBigInteger('id_type_mission')->nullable(false)->change();
            $table->unsignedBigInteger('id_sous_type_mission')->nullable(false)->change();
            $table->date('debut_exercice')->nullable(false)->change();
            $table->date('fin_exercice')->nullable(false)->change();
            $table->boolean('est_recurrent')->nullable(false)->change();
            $table->boolean('est_refere')->nullable(false)->change();
            $table->string('numero_lp_contrat')->nullable(false)->change();
            $table->date('date_lp_contrat')->nullable(false)->change();
            $table->string('bailleur')->nullable(false)->change();
            $table->string('lp_contrat')->nullable(false)->change();
            $table->string('pays_intervention')->nullable(false)->change();
            $table->unsignedBigInteger('id_monnaie')->nullable(false)->change();
            $table->string('referant')->nullable(false)->change();
            $table->string('origine_contrat')->nullable(false)->change();
            $table->boolean('engagement_with_individuel')->nullable(false)->change();
            $table->text('details_engagement_with_individuel')->nullable(false)->change();
            $table->boolean('engagement_with_other_mazars_entity')->nullable(false)->change();
            $table->text('details_engagement_with_other_mazars_entity')->nullable(false)->change();
            $table->boolean('framework_agreement')->nullable(false)->change();
            $table->text('details_framework_agreement')->nullable(false)->change();
            $table->string('reference_chantier')->nullable(false)->change();
            $table->date('date_debut_intervention')->nullable(false)->change();
            $table->date('date_fin_intervention')->nullable(false)->change();
            $table->date('date_initialisation')->nullable(false)->change();
            $table->enum('dom_export', ['Domestique', 'Export'])->nullable(false);
        });
    }
};
