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
        Schema::create('cheque_banque', function (Blueprint $table) {
            $table->id('id_cheque_banque');
            $table->unsignedBigInteger('id_mode_encaissement')->nullable();
            $table->string('types')->nullable();
            $table->string('compte')->nullable();
          


            $table->timestamps();

            $table->foreign('id_mode_encaissement')->references('id_mode_encaissement')->on('mode_encaissement');
         
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cheque_banque');
    }
};
