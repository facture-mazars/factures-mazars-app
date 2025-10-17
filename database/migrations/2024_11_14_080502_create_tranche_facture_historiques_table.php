<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrancheFactureHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranche_facture_historiques', function (Blueprint $table) {
            $table->id(); // Equivalent à SERIAL pour l'auto-incrémentation
            $table->foreignId('id_tranche_facture')->constrained('tranche_facture', 'id_tranche_facture')->onDelete('cascade'); // Clé étrangère avec contrainte
            $table->date('date_prevision_facture')->nullable();
            $table->date('date_prevision_recouvrement')->nullable();
            $table->date('date_reel_fac')->nullable();
            $table->timestamp('date_modification')->useCurrent(); // Date et heure de la modification
            $table->timestamps(); // Ajoute created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tranche_facture_historiques');
    }
}
