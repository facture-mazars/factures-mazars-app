<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalBudgetTable extends Migration
{
    public function up()
    {
        Schema::create('total_budget', function (Blueprint $table) {
            $table->id('id_total_budget');
            $table->unsignedBigInteger('id_chantier');
            $table->decimal('total_jour_homme', 15, 2);
            $table->decimal('total_global', 15, 2);
            $table->decimal('taux_moyen', 15, 2);
            $table->timestamps();

            $table->foreign('id_chantier')->references('id_chantier')->on('chantier');
        });
    }

    public function down()
    {
        Schema::dropIfExists('total_budget');
    }
}


