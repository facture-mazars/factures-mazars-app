<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeEncaissement extends Model
{
    use HasFactory;
    
    protected $table = 'mode_encaissement';

    protected $fillable = [
        'types',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_mode_encaissement'; // Nom de la clé primaire




    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'mode_encaissement', 'id_mode_encaissement');
    }
}
