<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrancheFactureHistorique extends Model
{
    use HasFactory;

    // Nom de la table associé au modèle
    protected $table = 'tranche_facture_historiques';

    // Désactive la gestion automatique des colonnes created_at et updated_at par Laravel
    public $timestamps = true;

    // Définition des champs modifiables en masse
    protected $fillable = [
        'id_tranche_facture',
        'date_prevision_facture',
        'date_prevision_recouvrement',
        'date_reel_fac',
        'date_modification',
    ];

 
    public function trancheFacture()
    {
        return $this->belongsTo(TrancheFacture::class, 'id_tranche_facture');
    }

 

}
