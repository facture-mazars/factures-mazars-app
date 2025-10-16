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
        Schema::create('budget', function (Blueprint $table) {
            $table->id('id_budget');
            $table->unsignedBigInteger('id_equipe');
            $table->integer('nb_jour_homme');
            $table->float('taux');
            $table->timestamps();

            $table->foreign('id_equipe')->references('id_equipe')->on('equipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget');
    }
};
