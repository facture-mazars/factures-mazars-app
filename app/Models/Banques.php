<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banques extends Model
{
    use HasFactory;

    protected $table = 'banque';

    protected $fillable = [
        'type_banque',
        'compte',
        'type_monnaie',
        'paiement',
        'paiement2',
        'paiement3',
        'paiement4',
    ];

    public $timestamps = true;

    protected $primaryKey = 'id_banque'; // Nom de la clé primaire

    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'banque', 'id_banque');
    }
}
