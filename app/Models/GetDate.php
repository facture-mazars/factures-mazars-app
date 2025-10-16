<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetDate extends Model
{
    use HasFactory;

    protected $table = 'get_date';

    protected $primaryKey = 'id_get_date'; // Spécifier la clé primaire
    public $incrementing = true; // S'assurer que la clé primaire est auto-incrémentée


    protected $fillable = [
        'id_chantier',
        'reference_chantier',
        'date_initialisation',
        'date_debut_intervention',
        'date_fin_intervention', 
        'reference_date',
    ];
  




    // Relation avec le modèle Client
    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier');
    }




  
}
