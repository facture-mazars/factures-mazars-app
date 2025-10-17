<?php

namespace Database\Seeders;

use App\Models\Cheque;
use Illuminate\Database\Seeder;

class ChequeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si un enregistrement existe déjà
        if (Cheque::count() === 0) {
            Cheque::create([
                'nom' => 'Au nom du Cabinet Mazars Fivoarana',
            ]);
        }
    }
}
