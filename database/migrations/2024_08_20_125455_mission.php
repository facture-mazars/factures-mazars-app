<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mission', function (Blueprint $table) {
            $table->id('id_mission');
            $table->string('code_mission', 50);
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_type_mission');
            $table->unsignedBigInteger('id_sous_type_mission');
            $table->date('debut_exercice');
            $table->date('fin_exercice');
            $table->boolean('est_recurrent');
            $table->boolean('est_refere');
            $table->string('numero_lp_contrat', 50);
            $table->date('date_lp_contrat');
            $table->boolean('est_cloture');
            $table->string('bailleur', 100);
            $table->unsignedBigInteger('id_partner_1');
            $table->unsignedBigInteger('id_partner_2');
            $table->enum('lp_contrat', ['LP', 'Contrat']);
            $table->string('pays_intervention', 100);
            $table->integer('nombre_annee');
            $table->unsignedBigInteger('id_monnaie');
            $table->string('referant', 250);
            $table->string('evaluation_honoraire', 50);
            $table->string('origine_contrat', 150);
            $table->boolean('engagement_with_individuel');
            $table->text('details_engagement_with_individuel');
            $table->boolean('engagement_with_other_mazars_entity');
            $table->text('details_engagement_with_other_mazars_entity');
            $table->boolean('framework_agreement');
            $table->text('details_framework_agreement');


           
            $table->timestamps();

       
            $table->foreign('id_client')->references('id_client')->on('client');
            $table->foreign('id_type_mission')->references('id_type_mission')->on('type_mission');
            $table->foreign('id_sous_type_mission')->references('id_sous_type_mission')->on('sous_type_mission');
            $table->foreign('id_partner_1')->references('id_partner')->on('partner');
            $table->foreign('id_partner_2')->references('id_partner')->on('partner');
            $table->foreign('id_monnaie')->references('id_monnaie')->on('monnaie');
       

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission');
    }
};
