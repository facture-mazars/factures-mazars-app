<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barometre extends Model
{
    use HasFactory;
    protected $table = 'v_barometre'; 

  
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_chantier',
        'reference_chantier',
        'date_initialisation',
        'nom_client',
        'sous_type_mission',
        'total_jour_homme',
        'total_global',
        'taux_moyen',
        'mois_annee_facture',
        'total_facture'
    ];

    


    
}
