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
        Schema::table('get_date', function (Blueprint $table) {
            $table->string('reference_date')->nullable(); // valeurs possibles : 'user', 'consultant', 'admin', etc.
        });
    }
    
    public function down()
    {
        Schema::table('get_date', function (Blueprint $table) {
            $table->dropColumn('reference_date');
        });
    }
    
};
