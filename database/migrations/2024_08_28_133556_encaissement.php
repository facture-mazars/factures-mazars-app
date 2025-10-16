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
        Schema::create('encaissement', function (Blueprint $table) {
            $table->id('id_encaissement');
            $table->unsignedBigInteger('id_tranche_facture');
            $table->date('dateprobable_encaissement')->nullable();
            $table->date('datereel_encaissement')->nullable();
            $table->unsignedBigInteger('id_mode_encaissement');
            $table->string('banque', 50)->nullable();
            $table->date('date_encaissement_prevu_calcule')->nullable();
            $table->string('ref_encaissement', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_tranche_facture')->references('id_tranche_facture')->on('tranche_facture');
            $table->foreign('id_mode_encaissement')->references('id_mode_encaissement')->on('mode_encaissement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encaissement');
    }
};
