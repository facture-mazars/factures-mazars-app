<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoixBanque extends Model
{
    use HasFactory;

    protected $table = 'choix_banque';

    protected $primaryKey = 'id_choix_banque';

    protected $fillable = ['id_facture', 'id_banque'];

    public function banque()
    {
        return $this->belongsTo(Banque::class, 'id_banque'); // Remplacez 'id_banque' par le nom exact de la clé étrangère si elle diffère.
    }
}
