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
        Schema::table('secteur_activite', function (Blueprint $table) {
            $table->string('secteur_mazars')->nullable();  // false = non encaissée, true = encaissée
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secteur_activite', function (Blueprint $table) {
            //
        });
    }
};
