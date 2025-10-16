<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taux extends Model
{
   
    use HasFactory;

    protected $table = 'taux';

    protected $primaryKey = 'id_taux'; // Nom de la clé primaire


    protected $fillable = [
        'types',
        'pourcentage',
    ];


}
