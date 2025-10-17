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
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('code_client', 100);
            $table->string('nom_client');
            $table->string('sigle_client')->nullable();
            $table->string('n_rcs')->nullable();
            $table->string('n_stat')->nullable();
            $table->string('n_nif')->nullable();
            $table->string('n_cif')->nullable();
            $table->string('adresse_client')->nullable();
            $table->unsignedBigInteger('id_pays')->nullable();
            $table->string('ville_siege')->nullable();
            $table->string('zone_geographique')->nullable();
            $table->string('contact_aupres_client')->nullable();
            $table->string('fonction_contact')->nullable();
            $table->string('tel_contact')->nullable();
            $table->string('mail_contact')->nullable();
            $table->enum('dom_export', ['Domestique', 'Export'])->nullable();
            $table->string('nom_groupe')->nullable();
            $table->unsignedBigInteger('id_pays_groupe')->nullable();
            $table->unsignedBigInteger('id_secteur_activite')->nullable();
            $table->string('bvdid')->nullable();
            $table->string('restrictions')->nullable();
            $table->unsignedBigInteger('id_forme_juridique')->nullable();
            $table->string('dg')->nullable();
            $table->string('daf')->nullable();
            $table->string('directeur_juridique')->nullable();
            $table->string('controle_interne')->nullable();
            $table->string('dsi')->nullable();
            $table->string('ca')->nullable();

            $table->timestamps();

            // Définir les clés étrangères

            $table->foreign('id_pays')->references('id_pays')->on('pays')->onDelete('set null');
            $table->foreign('id_pays_groupe')->references('id_pays')->on('pays')->onDelete('set null');
            $table->foreign('id_secteur_activite')->references('id_secteur_activite')->on('secteur_activite')->onDelete('set null');
            $table->foreign('id_forme_juridique')->references('id_forme_juridique')->on('forme_juridique')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
