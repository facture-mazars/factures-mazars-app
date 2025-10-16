<?php


namespace App\Imports;

use App\Models\Equipe;
use App\Models\Budget;
use App\Models\Facture;
use App\Models\TrancheFacture;
use App\Models\ListePersonnel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as DBFacade;
use Maatwebsite\Excel\Concerns\ToCollection;

class BudgetFactureImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            $budgetRows = $rows[0]; // Feuille `Budget`
            $factureRows = $rows[1]; // Feuille `Facture`

            // Étape 1 : Insérer dans `equipe` et `budget`
            foreach ($budgetRows as $budget) {
                $idChantier = $this->getIdChantier($budget['code_chantier']);

                if (!$idChantier) {
                    throw new \Exception("Code chantier introuvable : " . $budget['code_chantier']);
                }

                $trigramme = $this->extractTrigramme($budget['code_chantier']);
                $personnel = ListePersonnel::where('trigramme', $trigramme)->first();

                if (!$personnel) {
                    // Créer une équipe par défaut si nécessaire
                    $personnel = ListePersonnel::create([
                        'nom' => 'Inconnu',
                        'prenom' => 'Inconnu',
                        'id_grade' => 1, // Exemple de valeur par défaut
                        'trigramme' => $trigramme,
                    ]);
                }

                $equipe = Equipe::create([
                    'id_chantier' => $idChantier,
                    'id_grade' => $personnel->id_grade,
                    'id_liste_personnel' => $personnel->id_liste_personnel,
                ]);

                Budget::create([
                    'id_equipe' => $equipe->id_equipe,
                    'nb_jour_homme' => $budget['nb_jour_homme'],
                    'taux' => $budget['taux'],
                    'id_chantier' => $idChantier,
                ]);
            }

            // Étape 2 : Insérer dans `facture` et `tranche_facture`
            foreach ($factureRows as $facture) {
                $idChantier = $this->getIdChantier($facture['code_chantier']);
                $trigramme = $this->extractTrigramme($facture['numero_facture']);

                if (!$idChantier) {
                    throw new \Exception("Code chantier introuvable : " . $facture['code_chantier']);
                }

                $factureModel = Facture::create([
                    'id_chantier' => $idChantier,
                    'debours_decaissable' => $facture['debours_decaissable'],
                    'debours_non_decaissable' => $facture['debours_non_decaissable'],
                    'nb_tranche_facture' => 0, // Calculé après
                    'etat' => $facture['etat'],
                ]);

                TrancheFacture::create([
                    'id_facture' => $factureModel->id_facture,
                    'taux_honoraire' => $facture['taux_honoraire'],
                    'montant_honoraire' => $facture['montant_honoraire'],
                    'taux_debours' => $facture['taux_debours'],
                    'montant_debours' => $facture['montant_debours'],
                    'date_prevision_facture' => $facture['date_prevision_facture'],
                    'nom_tranche' => $facture['nom_tranche'],
                    'etat' => $facture['etat'],
                ]);
            }

            // Mettre à jour le nombre de tranches pour chaque facture
            $this->updateNbTrancheFacture();
        });
    }

    /**
     * Récupère l'id_chantier à partir du code_chantier
     */
    private function getIdChantier($codeChantier)
    {
        return DBFacade::table('get_date')
            ->where('reference_chantier', $codeChantier)
            ->value('id_chantier');
    }

    /**
     * Extrait le trigramme d'un numéro de facture ou de code_chantier
     */
    private function extractTrigramme($input)
    {
        preg_match('/n°([A-Z]{3})/', $input, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Met à jour le nombre de tranches de chaque facture
     */
    private function updateNbTrancheFacture()
    {
        $factures = Facture::all();
        foreach ($factures as $facture) {
            $nbTranches = TrancheFacture::where('id_facture', $facture->id_facture)->count();
            $facture->update(['nb_tranche_facture' => $nbTranches]);
        }
    }
}



