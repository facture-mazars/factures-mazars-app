<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
    protected $table = 'partner';

    protected $fillable = [
        'nom_partner',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_partner'; // Nom de la clé primaire




    public function contrat()
    {
        return $this->hasMany(Contrat::class, 'partner', 'id_partner');
    }
}
