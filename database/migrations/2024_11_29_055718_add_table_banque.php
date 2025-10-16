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
        Schema::create('banque', function (Blueprint $table) {
            $table->id('id_banque');
            $table->string('type_banque')->nullable();
            $table->string('compte')->nullable();
            $table->string('paiement')->nullable();
             
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banque');
    }
};

