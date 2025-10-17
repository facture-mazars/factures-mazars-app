<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurActivite extends Model
{
    use HasFactory;

    protected $table = 'secteur_activite';

    protected $primaryKey = 'id_secteur_activite';

    protected $fillable = [
        'code_secteur',
        'nom_secteur_activite',
        'secteur_mazars',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class, 'id_secteur_activite');
    }
}
