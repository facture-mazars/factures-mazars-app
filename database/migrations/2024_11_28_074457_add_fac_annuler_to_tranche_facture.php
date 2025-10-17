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
            $table->date('date_facture_annule')->nullable();
            $table->string('numero_facture_annule')->nullable(); // valeurs possibles : 'user', 'consultant', 'admin', etc.
        });
    }

    public function down()
    {
        Schema::table('tranche_facture', function (Blueprint $table) {});
    }
};
