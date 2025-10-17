<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    use HasFactory;

    protected $table = 'banques';

    protected $primaryKey = 'id_banque';

    protected $fillable = [
        'nom_banque',
        'compte',
        'type',

    ];

    public $timestamps = true;

    // Nom de la clé primaire

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'id_facture');
    }
}
