<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Client;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Méthode principale qui appelle les autres méthodes
    public function chartSuivi(Request $request)
    {
        // Récupérer les données pour chaque graphique
        $annees = $this->getChantiersParAnnee();
        $chantiersParMois = $this->getChantiersParMois($request);
        $anneesfacture = $this->getAnneesFactures();
        $factures = $this->getFacturesParEtat($request);
        $anneesBudget = $this->getAnneesBudget();
        $budgetsData = $this->getBudgetsParMois($request);
        $nbClients = $this->nbClient();
        $nbChantiersEnCours = $this->nbChantierEnCour();
        $allJ = $this->sommeTotalJourHomme();
        $allF = $this->nbFacture();
        $chantiersIncomplets = $this->getChantiersIncomplets();

        // Retourner la vue avec les données
        return view('dashboard', array_merge($annees, $chantiersParMois, $anneesfacture, $factures, $anneesBudget, $budgetsData, $nbClients, $nbChantiersEnCours, $allJ, $allF, $chantiersIncomplets));
    }

    // Méthode pour récupérer les chantiers par année
    private function getChantiersParAnnee()
    {
        $annees = DB::table('get_date')
            ->select(DB::raw('EXTRACT(YEAR FROM date_initialisation) as annee'))
            ->distinct()
            ->orderBy('annee', 'desc')
            ->pluck('annee');

        return compact('annees');
    }

    // Méthode pour récupérer les chantiers par mois
    private function getChantiersParMois($request)
    {
        $selectedYear = $request->input('annee_chantier') ?? date('Y');

        $chantiersParMois = DB::table('get_date')
            ->select(DB::raw("to_char(date_initialisation, 'YYYY-MM') as mois"), DB::raw('count(id_chantier) as nombre_chantiers'))
            ->whereYear('date_initialisation', $selectedYear)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return compact('chantiersParMois', 'selectedYear');
    }

    // Méthode pour récupérer les années des factures
    private function getAnneesFactures()
    {
        $anneesfacture = DB::table('tranche_facture')
            ->select(DB::raw('EXTRACT(YEAR FROM date_prevision_facture) as anneefac'))
            ->distinct()
            ->orderBy('anneefac', 'desc')
            ->pluck('anneefac');

        return compact('anneesfacture');
    }

    // Méthode pour récupérer les factures par état
    private function getFacturesParEtat($request)
    {
        $selectedYearFacture = $request->input('annee_facture') ?? date('Y');

        $factures = DB::table('tranche_facture')
            ->join('facture', 'tranche_facture.id_facture', '=', 'facture.id_facture') // Jointure avec la table facture
            ->select(
                DB::raw('COUNT(CASE WHEN facture.etat = 2 THEN 1 END) as payees'),
                DB::raw('COUNT(CASE WHEN facture.etat = 0 THEN 1 END) as non_payees'),
                DB::raw('COUNT(CASE WHEN facture.etat = 1 THEN 1 END) as partiellement_payees')
            )
            ->whereYear('tranche_facture.date_prevision_facture', $selectedYearFacture)
            ->first();

        // Si aucune facture n'a été trouvée, on définit des valeurs par défaut
        if (! $factures) {
            $factures = (object) [
                'payees' => 0,
                'non_payees' => 0,
                'partiellement_payees' => 0,
            ];
        }

        return compact('factures', 'selectedYearFacture');
    }

    // Méthode pour récupérer les années de budget
    private function getAnneesBudget()
    {
        $anneesBudget = DB::table('total_budget')
            ->select(DB::raw('EXTRACT(YEAR FROM created_at) as annee_budget'))
            ->distinct()
            ->orderBy('annee_budget', 'desc')
            ->pluck('annee_budget');

        return compact('anneesBudget');
    }

    // Méthode pour récupérer les budgets par mois
    private function getBudgetsParMois($request)
    {
        $selectedYearBudget = $request->input('annee_budget') ?? date('Y');

        // Récupérer les totaux pour `total_global`
        $budgetsGlobal = DB::table('total_budget')
            ->select(
                DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
                DB::raw('SUM(total_global) as total_budget')
            )
            ->whereYear('created_at', $selectedYearBudget) // Filtrer par année
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Récupérer les totaux pour `total_jour_homme`
        $budgetsJourHomme = DB::table('total_budget')
            ->select(
                DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
                DB::raw('SUM(total_jour_homme) as total_jour_homme')
            )
            ->whereYear('created_at', $selectedYearBudget) // Filtrer par année
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Initialiser des tableaux pour les montants des mois (janvier à décembre)
        $montantsGlobal = array_fill(0, 12, 0); // Total Global
        $montantsJourHomme = array_fill(0, 12, 0); // Total Jour Homme

        // Remplir les montants en fonction des résultats de la requête `total_global`
        foreach ($budgetsGlobal as $budget) {
            $montantsGlobal[$budget->mois - 1] = $budget->total_budget; // -1 pour ajuster l'indexation
        }

        // Remplir les montants en fonction des résultats de la requête `total_jour_homme`
        foreach ($budgetsJourHomme as $budget) {
            $montantsJourHomme[$budget->mois - 1] = $budget->total_jour_homme; // -1 pour ajuster l'indexation
        }

        return compact('budgetsGlobal', 'budgetsJourHomme', 'selectedYearBudget', 'montantsGlobal', 'montantsJourHomme');
    }

    private function nbClient()
    {
        $clientCount = Client::count(); // Compte tous les clients

        $clientsRecents = Client::where('created_at', '>=', now()->subMonth())->count(); // Chantiers créés au cours du dernier mois

        // Récupérer tous les chantiers
        $clients = Client::all();

        // Initialiser les statistiques
        $variationClients = [
            'clientsRecents' => 0,
            // Ajoutez d'autres statistiques selon vos besoins
        ];

        // Calculez le nombre total de chantiers et chantiers récents (ex: ceux créés dans les 30 derniers jours)
        foreach ($clients as $client) {

            // Exemples d'évaluation pour chantiers récents
            if ($client->created_at >= now()->subDays(30)) {
                $variationClients['clientsRecents']++;
            }
        }

        return compact('clientCount', 'variationClients', 'clientsRecents');
    }

    private function nbChantierEnCour()
    {
        $chantierCount = Chantier::where('etat', false)->count(); // Compte tous les clients
        $chantiersRecents = Chantier::where('created_at', '>=', now()->subMonth())->count(); // Chantiers créés au cours du dernier mois

        // Récupérer tous les chantiers
        $chantiers = Chantier::all();

        // Initialiser les statistiques
        $variationStatistiques = [
            'totalChantiers' => 0,
            'chantiersRecents' => 0,
            // Ajoutez d'autres statistiques selon vos besoins
        ];

        // Calculez le nombre total de chantiers et chantiers récents (ex: ceux créés dans les 30 derniers jours)
        foreach ($chantiers as $chantier) {
            $variationStatistiques['totalChantiers']++;

            // Exemples d'évaluation pour chantiers récents
            if ($chantier->created_at >= now()->subDays(30)) {
                $variationStatistiques['chantiersRecents']++;
            }
        }

        return compact('chantierCount', 'chantiersRecents', 'variationStatistiques');
    }

    private function sommeTotalJourHomme()
    {
        // Calcule la somme totale de total_jour_homme
        $totalAllJourHomme = DB::table('total_budget')->sum('total_jour_homme');

        return compact('totalAllJourHomme');
    }

    private function nbFacture()
    {
        $facCount = Facture::count(); // Compte tous les clients

        return compact('facCount');
    }

    private function getChantiersIncomplets()
    {
        $chantiersIncomplets = \App\Models\Chantier::where('statut_completion', 'en_cours')
            ->with(['client', 'typeMission'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        $nbChantiersIncomplets = \App\Models\Chantier::where('statut_completion', 'en_cours')->count();

        return compact('chantiersIncomplets', 'nbChantiersIncomplets');
    }
}
