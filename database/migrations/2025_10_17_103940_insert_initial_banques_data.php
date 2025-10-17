<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('banques')->insert([
            [
                'nom_banque' => 'BMOI Antaninarenina',
                'compte' => '00004 00001 02115501102 04 mg46 0000 4000 0102 1155 0110 204',
                'type' => 'IBAN',
                'monnaie' => 'Dollars',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'BMOIMGMG',
                'compte' => '',
                'type' => 'BIC',
                'monnaie' => 'Euros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'BMOI Antaninarenina',
                'compte' => '00004 00001 02115501101 07',
                'type' => '',
                'monnaie' => 'Mga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'BMOI Antaninarenina',
                'compte' => '00004 00001 02115500155 32',
                'type' => '',
                'monnaie' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'La Banque pour l\'industrie et le Commerce (BIC) Agence Moroni aux Comores',
                'compte' => '210187 001 05 KMF 008 - Code banque : 0001 - Code agence : 00001',
                'type' => '',
                'monnaie' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'BOA-M Antaninarenina',
                'compte' => '00009 05000 18424150035 29',
                'type' => '',
                'monnaie' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_banque' => 'BFV-SG Antaninarenina',
                'compte' => '00008 00005 21010043939 50',
                'type' => '',
                'monnaie' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('banques')->whereIn('nom_banque', [
            'BMOI Antaninarenina',
            'BMOIMGMG',
            'La Banque pour l\'industrie et le Commerce (BIC) Agence Moroni aux Comores',
            'BOA-M Antaninarenina',
            'BFV-SG Antaninarenina',
        ])->delete();
    }
};
