<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Appliquer les modifications à la table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

         
          

              $table->string('email')->nullable(); 
             
        });
    }

    /**
     * Revenir en arrière des modifications.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
         
      
         
     
        });
    }
};
