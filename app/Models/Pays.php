<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
   
    use HasFactory;

    protected $table = 'pays';

    protected $primaryKey = 'id_pays'; // Nom de la clé primaire


    protected $fillable = [
        'nom_pays',
    ];

}
