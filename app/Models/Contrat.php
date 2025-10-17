<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'contrat';

    protected $primaryKey = 'id_contrat'; // Spécifier la clé primaire

    public $incrementing = true; // S'assurer que la clé primaire est auto-incrémentée

    protected $fillable = [
        'id_client',
        'id_monnaie',
        'lp_contrat',
        'exercice_clos',
        'debut_mandat',
        'fin_mandat',
        'date_lp_contrat',
        'numero_lp_contrat',
        'id_partner_1',
        'id_partner_2',
        'client_refere',
        'mission_recurente',
        'restrictions_specifiques',
        'client_domestique',
        'engagement_with_individuel',
        'details_engagement_with_individuel',
        'engagement_with_mazars_entity',
        'details_engagement_with_mazars_entity',
        'framework_agreement',
        'details_framework_agreement',
        'reviseur_independant',
        'ref_ic_we_check',
        'project_code',
        'nombre_annee',
        'evaluation_horaire',
        'bureau_mazars',
    ];

    // Relation avec le modèle Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function monnaie()
    {
        return $this->belongsTo(Monnaie::class, 'id_monnaie');
    }
    // Relation avec le modèle TypeMission

    public function partner1()
    {
        return $this->belongsTo(Partner::class, 'partner', 'id_partner');
    }

    public function partner2()
    {
        return $this->belongsTo(Partner::class, 'partner', 'id_partner');
    }
}
