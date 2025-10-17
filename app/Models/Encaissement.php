<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encaissement extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'encaissement';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_encaissement';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tranche_facture',
        'datereel_encaissement',
        'id_banque',
        'id_cheque',
        'montant_a_encaisse',
        'pourcentage_encaisse',
        'etat',
        'reste_a_payer',
    ];

    /**
     * Define the relationship with TrancheFacture.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trancheFacture()
    {
        return $this->belongsTo(TrancheFacture::class, 'id_tranche_facture');
    }

    /**
     * Define the relationship with ModeEncaissement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Banques()
    {
        return $this->belongsTo(Banques::class, 'id_banque');
    }

    public function Cheques()
    {
        return $this->belongsTo(Cheques::class, 'id_cheque');
    }
}
