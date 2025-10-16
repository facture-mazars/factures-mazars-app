<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;
    
    protected $table = 'responsable';

    protected $fillable = [
        'types',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_responsable'; // Nom de la clé primaire




    public function budget()
    {
        return $this->hasMany(Budget::class, 'responsable', 'id_responsable');
    }
}

