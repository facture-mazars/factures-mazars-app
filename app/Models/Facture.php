<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Facture extends Model
{
    use HasFactory;

    // Nom de la table associée au modèle
    protected $table = 'facture';

    // Clé primaire
    protected $primaryKey = 'id_facture';

    // Les champs qui peuvent être remplis en masse (mass assignable)
    protected $fillable = [
        'id_chantier',
        'id_budget',
        'debours_decaissable',
        'debours_non_decaissable',
        'nb_tranche_facture',

    ];

    // Si vous n'utilisez pas les colonnes de timestamp (created_at, updated_at)
    public $timestamps = true;

    // Si vous voulez que la colonne etat ne soit jamais modifiée manuellement

    // Définir la relation avec le modèle Chantiers

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier', 'id_chantier');
    }

    public function budgets()
    {
        return $this->belongsToMany(Budget::class, 'facture_budget', 'id_facture', 'id_budget');
    }

    public function tranches()
    {
        return $this->hasMany(TrancheFacture::class, 'id_facture');
    }

    public function societes()
    {
        return $this->belongsTo(Societes::class, 'id_societe');
    }

    public function updateFactureStatus($id_facture)
    {
        // Récupérer toutes les tranches pour cette facture
        $tranches = DB::table('tranche_facture')->where('id_facture', $id_facture)->get();

        // Vérifier les états des tranches
        $allPaid = $tranches->every(function ($tranche) {
            return $tranche->etat === true; // 't' pour true
        });

        $anyPaid = $tranches->contains(function ($tranche) {
            return $tranche->etat === true; // Si au moins une tranche est payée
        });

        // Déterminer le nouvel état de la facture
        if ($allPaid) {
            $etat = 2; // Paiement total
        } elseif ($anyPaid) {
            $etat = 1; // Paiement partiel
        } else {
            $etat = 0; // Non payé
        }

        // Si l'état de la facture est 2, mettre à jour l'état dans la table chantier
        if ($etat === 2) {
            // Récupérer l'ID du chantier associé à la facture
            $chantierId = DB::table('facture')->where('id_facture', $id_facture)->value('id_chantier');

            // Mettre à jour l'état du chantier
            if ($chantierId) {
                DB::table('chantier')->where('id_chantier', $chantierId)->update(['etat' => true]);
            }
        }

        // Mettre à jour l'état de la facture
        DB::table('facture')->where('id_facture', $id_facture)->update(['etat' => $etat]);
    }

    public function tranchesFactures()
    {
        return $this->hasMany(TrancheFacture::class, 'id_facture', 'id_facture');
    }

    public function choixBanques()
    {
        return $this->hasMany(ChoixBanque::class, 'id_facture');
    }

    // Dans le modèle Facture

}
