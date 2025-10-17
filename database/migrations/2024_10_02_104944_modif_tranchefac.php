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
            $table->date('date_reel_fac')->nullable();  // false = non encaissée, true = encaissée
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
