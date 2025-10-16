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
        Schema::table('encaissement', function (Blueprint $table) {
            // Drop the old foreign key constraint that references 'banque'
            $table->dropForeign('encaissement_id_banque_foreign');

            // Create new foreign key constraint that references 'banques'
            $table->foreign('id_banque')
                  ->references('id_banque')
                  ->on('banques')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encaissement', function (Blueprint $table) {
            // Drop the new foreign key constraint
            $table->dropForeign(['id_banque']);

            // Restore the old foreign key constraint that references 'banque'
            $table->foreign('id_banque')
                  ->references('id_banque')
                  ->on('banque')
                  ->onDelete('cascade');
        });
    }
};
