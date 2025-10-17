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
            $table->string('nom_tranche')->nullable(); // Ajoutez cette ligne
        });
    }

    public function down()
    {
        Schema::table('tranche_facture', function (Blueprint $table) {
            $table->dropColumn('nom_tranche');
        });
    }
};
