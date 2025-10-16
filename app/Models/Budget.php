<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

     protected $table = 'budget';

       // Indiquer à Laravel que la clé primaire est id_client
    protected $primaryKey = 'id_budget';

     // Les attributs qui sont assignables en masse
     protected $fillable = [
        'id_chantier',
        'id_equipe',
        'nom',
        'nb_jour_homme',
        'taux',
        
     ];
 
     public function chantier()
     {
         return $this->belongsTo(Chantier::class, 'id_chantier');
     }
 
     public function equipe()
     {
         return $this->belongsTo(Equipe::class, 'id_equipe');
     }
   


   

     public function factures()
     {
         return $this->belongsToMany(Facture::class, 'facture_budget', 'id_budget', 'id_facture');
     }


    


    
}
