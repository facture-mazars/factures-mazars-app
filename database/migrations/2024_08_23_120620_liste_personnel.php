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
    { Schema::create('liste_personnel', function (Blueprint $table) {
        $table->id('id_liste_personnel');
        $table->string('nom', 200);
        $table->string('prenom', 200);
        $table->unsignedBigInteger('id_grade');
        $table->string('matricule', 100);
        $table->boolean('actif');
        $table->timestamps();


        $table->foreign('id_grade')->references('id_grade')->on('grade');
    });
 
    



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
