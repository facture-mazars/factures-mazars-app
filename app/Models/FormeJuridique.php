<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormeJuridique extends Model
{
    use HasFactory;
    
    protected $table = 'forme_juridique';

    protected $fillable = [
        'types',
    ];

    public $timestamps = true;

    protected $primaryKey = 'id_forme_juridique'; // Nom de la clé primaire




    public function client()
    {
        return $this->hasMany(Contrat::class, 'forme_juridique', 'id_forme_juridique');
    }
}
