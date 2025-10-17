<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societes extends Model
{
    use HasFactory;

    protected $table = 'societe';

    protected $fillable = [
        'nom_societe',
        'rue',
        'addresse',
        'email',
        'raison_sociale',
        'n_is',
        'n_if',
        'n_cif',

    ];

    protected $primaryKey = 'id_societe'; // Nom de la clé primaire

    public function tranches()
    {
        return $this->hasMany(TrancheFacture::class, 'id_facture');
    }
}
