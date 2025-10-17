<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    protected $table = 'chantier';

    protected $primaryKey = 'id_chantier'; // Spécifier la clé primaire

    public $incrementing = true; // S'assurer que la clé primaire est auto-incrémentée

    protected $fillable = [
        'id_client',
        'id_type_mission',
        'id_sous_type_mission',
        'debut_exercice',
        'objet',
        'fin_exercice',
        'est_recurrent',
        'est_refere',
        'numero_lp_contrat',
        'date_lp_contrat',
        'bailleur',
        'lp_contrat',
        'id_pays_intervention',
        'id_monnaie',
        'referant',
        'origine_contrat',
        'engagement_with_individuel',
        'details_engagement_with_individuel',
        'engagement_with_other_mazars_entity',
        'details_engagement_with_other_mazars_entity',
        'framework_agreement',
        'details_framework_agreement',
        'reference_chantier',
        'date_initialisation',
        'date_debut_intervention',
        'date_fin_intervention',
        'dom_export',
        'etat',
        'ref_lp_contrat',
        'date_cloture',
        'ancien_mission',
        'exercice_clos',
        'statut_completion',
        'etape_actuelle',

    ];

    public function pays_intervention()
    {
        return $this->belongsTo(Pays::class, 'id_pays_intervention');
    }

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

    public function typeMission()
    {
        return $this->belongsTo(TypeMission::class, 'id_type_mission');
    }

    public function sousTypeMission()
    {
        return $this->belongsTo(SousTypeMission::class, 'id_sous_type_mission');
    }

    public function getDate()
    {
        return $this->hasMany(GetDate::class, 'id_chantier', 'id_chantier');
    }

    // Chantier.php
    public function clients()
    {
        return $this->hasMany(Client::class, 'id_client', 'id_client'); // Remplacez 'id_chantier' par la clé étrangère correcte
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'id_chantier');
    }

    public function totalBudget()
    {
        return $this->hasOne(TotalBudget::class, 'id_chantier');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_chantier', 'id_chantier');
    }

    /**
     * Met à jour l'étape actuelle du chantier
     */
    public function updateEtape($etape)
    {
        $this->update([
            'etape_actuelle' => $etape,
        ]);
    }

    /**
     * Marque le chantier comme complet
     */
    public function marquerComplet()
    {
        $this->update([
            'statut_completion' => 'complet',
            'etape_actuelle' => 'termine',
        ]);
    }

    /**
     * Vérifie si le chantier est complet
     */
    public function estComplet()
    {
        return $this->statut_completion === 'complet';
    }

    /**
     * Vérifie si le chantier est en cours de création
     */
    public function estEnCours()
    {
        return $this->statut_completion === 'en_cours';
    }
}
