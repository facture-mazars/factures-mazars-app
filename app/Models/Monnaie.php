<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monnaie extends Model
{
    use HasFactory;
    
    protected $table = 'monnaie';

    protected $fillable = [
        'nom_monnaie',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_monnaie'; // Nom de la clé primaire




    public function contrat()
    {
        return $this->hasMany(Contrat::class, 'monnaie', 'id_monnaie');
    }
}
