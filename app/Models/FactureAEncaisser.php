<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureAEncaisser extends Model
{
    use HasFactory;

    protected $table = 'facture_a_encaisser';

    protected $fillable = [
        'id_tranche_facture',
        'total_a_payer',
    ];

    // Relation avec TrancheFacture
    public function trancheFacture()
    {
        return $this->belongsTo(TrancheFacture::class, 'id_tranche_facture');
    }
}
