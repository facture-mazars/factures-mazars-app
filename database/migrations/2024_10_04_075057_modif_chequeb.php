<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cheque_banque', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pays')->nullable(); // Ajoutez cette ligne
            $table->foreign('id_pays')->references('id_pays')->on('pays');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cheque_banque', function (Blueprint $table) {
            //
        });
    }
};
