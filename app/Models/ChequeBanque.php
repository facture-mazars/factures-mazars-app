<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChequeBanque extends Model
{
    use HasFactory;

    protected $table = 'cheque_banque';

    protected $fillable = [
        'id_mode_encaissement',
        'types',
    ];

    public $timestamps = true;

    protected $primaryKey = 'id_cheque_banque'; // Nom de la clé primaire

    public function modeEncaissement()
    {
        return $this->belongsTo(ModeEncaissement::class, 'id_mode_encaissement');
    }

    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'cheque_banque', 'id_cheque_banque');
    }
}
