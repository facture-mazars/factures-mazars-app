<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';

    // Indiquer à Laravel que la clé primaire est id_client
    protected $primaryKey = 'id_client';

    // Les attributs qui sont assignables en masse
    protected $fillable = [
        'code_client',
        'nom_client',
        'sigle_client',
        'telephone_societe',
        'email_societe',
        'n_rcs',
        'n_stat',
        'n_nif',
        'n_cif',
        'adresse_client',
        'id_pays',
        'ville_siege',
        'zone_geographique',
        'contact_aupres_client',
        'fonction_contact',
        'tel_contact',
        'mail_contact',
        'nom_groupe',
        'id_pays_groupe',
        'id_secteur_activite',
        'bvdid',
        'restrictions',
        'id_forme_juridique',
        'dg',
        'daf',
        'directeur_juridique',
        'controle_interne',
        'dsi',
        'ca',
        'type',

    ];

    public $timestamps = true;

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier');
    }

    public function chantiers()
    {
        return $this->hasMany(Chantier::class, 'id_client');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }

    public function pays_groupe()
    {
        return $this->belongsTo(Pays::class, 'id_pays_groupe');
    }

    public function secteurActivite()
    {
        return $this->belongsTo(SecteurActivite::class, 'id_secteur_activite');
    }

    public function formeJuridique()
    {
        return $this->belongsTo(Pays::class, 'id_forme_juridique');
    }

    public function montantHonoraireParChantier()
    {
        return $this->chantiers()->with(['factures' => function ($query) {
            $query->withSum('tranchesFactures as total_montant_honoraire', 'montant_honoraire');
        }]);
    }
}
