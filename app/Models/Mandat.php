<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandat extends Model
{
    use HasFactory;
    
    protected $table = 'mandat';

    protected $fillable = [
        'types',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_mandat'; // Nom de la clé primaire




    public function chantier()
    {
        return $this->hasMany(Chantier::class, 'mandat', 'id_mandat');
    }
}
