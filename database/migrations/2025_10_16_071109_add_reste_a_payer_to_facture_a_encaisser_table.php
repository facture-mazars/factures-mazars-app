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
        Schema::table('facture_a_encaisser', function (Blueprint $table) {
            $table->double('reste_a_payer')->nullable()->after('total_a_payer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facture_a_encaisser', function (Blueprint $table) {
            $table->dropColumn('reste_a_payer');
        });
    }
};
