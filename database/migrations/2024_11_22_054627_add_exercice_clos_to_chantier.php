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
            $table->date('exercice_clos')->nullable(); // valeurs possibles : 'user', 'consultant', 'admin', etc.
        });
    }

    public function down()
    {
        Schema::table('chantier', function (Blueprint $table) {
            $table->dropColumn('exercice_clos');
        });
    }
};
