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
        Schema::create('societe', function (Blueprint $table) {
            $table->id('id_societe');
            $table->string('nom_societe', 250)->nullable();
            $table->string('rue')->nullable();
            $table->string('addresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('n_is')->nullable();
            $table->string('n_if')->nullable();
            $table->string('n_cif')->nullable();


            $table->timestamps();

         
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('societe');
    }
};
