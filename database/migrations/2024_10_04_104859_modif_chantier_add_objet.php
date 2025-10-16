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
        Schema::table('chantier', function (Blueprint $table) {
            $table->string('objet')->nullable();  // false = non encaissée, true = encaissée
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chantier', function (Blueprint $table) {
            //
        });
    }
};
