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
        Schema::create('choix_banque', function (Blueprint $table) {
            $table->id('id_choix_banque');
            $table->timestamps();
            $table->unsignedBigInteger('id_facture')->nullable();
            $table->unsignedBigInteger('id_banque')->nullable();
            $table->foreign('id_facture')->references('id_facture')->on('facture')->onDelete('set null');
            $table->foreign('id_banque')->references('id_banque')->on('banques')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choix_banque');
    }
};
