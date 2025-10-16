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
        Schema::table('tranche_facture', function (Blueprint $table) {
            $table->integer('numero_facture')->default(0); // false = non encaissée, true = encaissée
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tranche_facture', function (Blueprint $table) {
            //
        });
    }
};
