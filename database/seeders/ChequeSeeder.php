<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cheque;

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
