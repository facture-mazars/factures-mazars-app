<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheques extends Model
{
    use HasFactory;

    protected $table = 'cheque';

    protected $fillable = [
        'nom',

    ];

    public $timestamps = false;

    protected $primaryKey = 'id_cheque'; // Nom de la clé primaire

    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'cheque', 'id_cheque');
    }
}
