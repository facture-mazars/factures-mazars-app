<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureBudget extends Model
{
    use HasFactory;

    // Spécifiez la table associée à ce modèle
    protected $table = 'facture_budget';

    // Spécifiez les colonnes que vous pouvez remplir
    protected $fillable = [
        'id_facture',
        'id_budget',
    ];

    // Vous pouvez définir ici les relations avec d'autres modèles si nécessaire
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'id_facture');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'id_budget');
    }
}
