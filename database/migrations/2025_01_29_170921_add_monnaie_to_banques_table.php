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
        Schema::table('banques', function (Blueprint $table) {
            $table->string('monnaie')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('banques', function (Blueprint $table) {
            $table->dropColumn('monnaie');
        });
    }
};
