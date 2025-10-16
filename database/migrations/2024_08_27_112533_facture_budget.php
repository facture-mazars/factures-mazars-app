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
        Schema::create('facture_budget', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_facture');
            $table->unsignedBigInteger('id_budget');
            $table->timestamps();
    
            $table->foreign('id_facture')->references('id_facture')->on('facture')->onDelete('cascade');
            $table->foreign('id_budget')->references('id_budget')->on('budget')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
