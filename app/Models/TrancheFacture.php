<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrancheFactureHistorique;
use Illuminate\Support\Facades\Auth;

class TrancheFacture extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tranche_facture';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tranche_facture';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_facture',
        'taux_honoraire',
        'montant_honoraire',
        'taux_debours',
        'montant_debours',
        'id_taux',
        'date_prevision_facture',
        'date_prevision_recouvrement',
        'nom_tranche',
        'etat',
        'numero_facture',
        'date_reel_fac',
        'id_pourcentage_debours',
           'date_facture_annule',
        'numero_facture_annule'
    ];

    /**
     * Get the facture that owns the tranche.
     */
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'id_facture');
    }

    public function chantier()
{
    return $this->hasOneThrough(Chantier::class, Budget::class);
}


    public function societes()
    {
        return $this->belongsTo(Societes::class, 'id_societe');
    }
    /**
     * Get the taux that is associated with the tranche.
     */
    public function taux()
    {
        return $this->belongsTo(Taux::class, 'id_taux');
    }


    public function pourcentageDebours()
    {
        return $this->belongsTo(Taux::class, 'id_pourcentage_debours');
    }

    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'id_tranche_facture');
    }

    public function encaissements()
    {
        return $this->hasOne(Encaissement::class, 'id_tranche_facture');
    }

    public function getTrancheNumberAttribute()
{
    // Extrait les chiffres du champ nom_tranche
    return (int) filter_var($this->nom_tranche, FILTER_SANITIZE_NUMBER_INT);
}

    protected $dates = [
        'date_prevision_facture',
        'date_prevision_recouvrement',
    ];




    public function historiques()
    {
        return $this->hasMany(TrancheFactureHistorique::class, 'id_tranche_facture');
    }


}
