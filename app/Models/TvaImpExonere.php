<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvaImpExonere extends Model
{
   
    use HasFactory;

    protected $table = 'tva_imp_exonere';

    protected $primaryKey = 'id_tva_imp_exonere'; // Nom de la clé primaire


    protected $fillable = [
        'types',
        'taux',
    ];


}
