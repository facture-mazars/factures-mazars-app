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
        Schema::create('get_date', function (Blueprint $table) {
            $table->id('id_get_date');
          
            $table->unsignedBigInteger('id_chantier')->nullable();
               $table->string('reference_chantier', 250)->nullable();
               $table->date('date_debut_intervention')->nullable();
               $table->date('date_fin_intervention')->nullable();
               $table->date('date_initialisation')->nullable();


            $table->timestamps();

            $table->foreign('id_chantier')->references('id_chantier')->on('chantier');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_date');
    }
};
