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
        Schema::table('chantier', function (Blueprint $table) {
            $table->enum('statut_completion', ['en_cours', 'complet'])->default('en_cours')->after('id_chantier');
            $table->string('etape_actuelle')->default('chantier')->after('statut_completion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chantier', function (Blueprint $table) {
            $table->dropColumn(['statut_completion', 'etape_actuelle']);
        });
    }
};
