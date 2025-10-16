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
        Schema::create('tranche_facture', function (Blueprint $table) {
            $table->id('id_tranche_facture');
            $table->unsignedBigInteger('id_facture');
            $table->float('taux_honoraire');
            $table->float('montant_honoraire');
            $table->float('taux_debours');
            $table->float('montant_debours');
            $table->unsignedBigInteger('id_taux')->nullable()->constrained();;
            $table->date('date_prevision_facture')->nullable();
            $table->date('date_prevision_recouvrement')->nullable();
            $table->timestamps();
            // Foreign keys
            $table->foreign('id_facture')->references('id_facture')->on('facture');
            $table->foreign('id_taux')->references('id_taux')->on('taux');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tranche_facture');
    }
};
