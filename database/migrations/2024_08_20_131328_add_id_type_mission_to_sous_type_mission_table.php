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
        Schema::table('sous_type_mission', function (Blueprint $table) {
            $table->unsignedBigInteger('id_type_mission')->after('id_sous_type_mission')->nullable();
            $table->foreign('id_type_mission')->references('id_type_mission')->on('type_mission')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sous_type_mission', function (Blueprint $table) {
            $table->dropForeign(['id_type_mission']);
            $table->dropColumn('id_type_mission');
        });
    }
};
