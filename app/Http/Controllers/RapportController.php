<?php

namespace App\Http\Controllers;

use App\Models\Barometre;
use App\Models\Chantier;
use App\Models\Encaissement;
use App\Models\TrancheFacture;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\GetDate;
use App\Models\SecteurActivite;
use App\Models\TotalBudget;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class RapportController extends Controller
{
    /**
     * Affiche une liste de toutes les factures.
     *
     * @return \Illuminate\View\View
     */




public function getEncaissements100()
{


                              // Si la session contient des résultats de recherche, les afficher
                              if (session()->has('cloture')) {
                                $encaissements = session('cloture');
                                session()->forget('cloture'); // Supprimer les données de la session après l'affichage
                            } else {
                               
                                $encaissements = DB::select("
                                -- Sous-requête pour obtenir les totaux des tranches de facture
                                WITH FactureDetails AS (
                                    SELECT 
                                        id_facture, 
                                        SUM(taux_honoraire) AS total_taux_honoraire, 
                                        SUM(taux_debours) AS total_taux_debours,
                                        SUM(montant_honoraire) AS total_montant_honoraire,
                                        SUM(montant_debours) AS total_montant_debours,
                                        COUNT(*) AS total_tranches,
                                        SUM(CASE WHEN etat = true THEN 1 ELSE 0 END) AS tranches_valides
                                    FROM tranche_facture
                                    WHERE etat = true
                                    GROUP BY id_facture
                                    HAVING SUM(taux_honoraire) = 100 
                                       AND SUM(taux_debours) = 100
                                )
                                
                                -- Joindre les détails de la facture avec les informations client et chantier
                                SELECT 
                                    f.id_facture,
                                    c.id_client,
                                    c.nom_client,
                                    c.code_client,
                                    ch.id_chantier,
                                    g.reference_chantier,
                                    f.total_taux_honoraire,
                                    f.total_taux_debours,
                                    f.total_montant_honoraire,
                                    f.total_montant_debours,
                                    f.total_tranches,
                                    f.tranches_valides
                                FROM FactureDetails f
                                JOIN facture fac ON f.id_facture = fac.id_facture
                                JOIN chantier ch ON fac.id_chantier = ch.id_chantier
                                JOIN client c ON ch.id_client = c.id_client
                                LEFT JOIN get_date g ON ch.id_chantier = g.id_chantier 
                                   
                                
                                
                                
                                ");
                            }
                            




    return view('rapport_final.cloture', compact('encaissements'));
}




public function getEncaissements100AvecRecherche(Request $request)
{
    // Récupérer le terme de recherche si disponible
    $search = $request->input('search');

    // Ajoutez un WHERE pour filtrer par nom_client si la recherche n'est pas vide
    $query = "
    WITH FactureDetails AS (
        SELECT 
            id_facture, 
            SUM(taux_honoraire) AS total_taux_honoraire, 
            SUM(taux_debours) AS total_taux_debours,
            SUM(montant_honoraire) AS total_montant_honoraire,
            SUM(montant_debours) AS total_montant_debours,
            COUNT(*) AS total_tranches,
            SUM(CASE WHEN etat = true THEN 1 ELSE 0 END) AS tranches_valides
        FROM tranche_facture
        WHERE etat = true
        GROUP BY id_facture
        HAVING SUM(taux_honoraire) = 100 
           AND SUM(taux_debours) = 100
    )
    SELECT 
        f.id_facture,
        c.id_client,
        c.nom_client,
        c.code_client,
        ch.id_chantier,
        g.reference_chantier,
        f.total_taux_honoraire,
        f.total_taux_debours,
        f.total_montant_honoraire,
        f.total_montant_debours,
        f.total_tranches,
        f.tranches_valides
    FROM FactureDetails f
    JOIN facture fac ON f.id_facture = fac.id_facture
    JOIN chantier ch ON fac.id_chantier = ch.id_chantier
    JOIN client c ON ch.id_client = c.id_client
    LEFT JOIN get_date g ON ch.id_chantier = g.id_chantier
    ";




   
    // Appliquer le filtre de recherche sur le nom_client si un terme est fourni
    if (!empty($search)) {
        $query .= " WHERE c.nom_client ILIKE :search";
    }

    // Exécuter la requête avec un paramètre pour la recherche
    $encaissements = DB::select($query, ['search' => '%' . $search . '%']);


session()->put('cloture', $encaissements);

return redirect()->route('listesCloture');

}




    
public function getVerification()
{
    $verifier = DB::select("
        SELECT id_facture, 
       SUM(taux_honoraire) AS total_taux_honoraire, 
       SUM(taux_debours) AS total_taux_debours,
       COUNT(*) AS total_tranches,
       SUM(CASE WHEN etat = true THEN 1 ELSE 0 END) AS tranches_valides
        FROM tranche_facture
        GROUP BY id_facture;

    ");
    return view('rapport_final.suivi', compact('verifier'));

}


 

public function getAllTotal($idTranche){
    $allfacs = TrancheFacture::where('id_facture',$idTranche)->get();

    Log::info("Factures for ID {$idTranche}: ", $allfacs->toArray());

    $total = 0;

    foreach($allfacs as $fac) {
        $total += $fac->montant_honoraire + $fac->montant_debours;
    }
    Log::info("Total for ID {$idTranche}: {$total}");

    return $total;
}

// public function getAllHonoraire($idTranche){
//     $allfacs = TrancheFacture::where('id_facture',$idTranche)->get();

//     Log::info("Factures for ID {$idTranche}: ", $allfacs->toArray());

//     $total = 0;

//     foreach($allfacs as $fac) {
//         $total += $fac->montant_honoraire;
//     }
//     Log::info("Total for ID {$idTranche}: {$total}");

//     return $total;
// }


// public function getAllDebours($idTranche){
//     $allfacs = TrancheFacture::where('id_facture',$idTranche)->get();

//     Log::info("Factures for ID {$idTranche}: ", $allfacs->toArray());

//     $total = 0;

//     foreach($allfacs as $fac) {
//         $total += $fac->montant_debours;
//     }
//     Log::info("Total for ID {$idTranche}: {$total}");

//     return $total;
// }


public function sommeTvaHonoraire($tranches)
{
    $total_tva = 0; // Initialiser le total de la TVA

    foreach ($tranches as $tranche) {
        // Vérifiez que les valeurs nécessaires existent
        if ($tranche->montant_honoraire && $tranche->taux) {
            $taux_tva = $tranche->taux->pourcentage; // Supposons que pourcentage est le champ correct
            $total_tva += TrancheFactureController::calculerTvaHonoraireParTranche($tranche->montant_honoraire, $taux_tva);
        }
    }

    return $total_tva; // Retourner la somme totale de la TVA
}
     public function show($id){
         $factures = Facture::with([            
                                                 'chantier',
                                                 'chantier.typeMission',
                                                 'chantier.sousTypeMission',
                                                 'chantier.client',
                                                 'chantier.client.pays',
                                                 'chantier.client.pays_groupe',
                                                 'chantier.monnaie',
                                                 'budgets',
                                                 'budgets.equipe',        
                                                 'budgets.equipe.grade',           
                                                 'budgets.equipe.listePersonnel' 
                                                 
                                                
                                        
                                                 ])
                                         ->findOrFail($id);


 // Récupérer les tranches liées à la facture et leur taux de TVA
 $tranches = TrancheFacture::where('id_facture', $id)->with(['taux'])->get();

                    // Initialiser les variables pour les totaux
                    $total_honoraire = 0;
                    $total_debours = 0;
                    $total_tva_honoraire = [];

                    foreach ($tranches as $tranche) {
                        $montant_honoraire = $tranche->montant_honoraire;
                        $taux_tva = $tranche->taux ? $tranche->taux->pourcentage : 0;

                        $tva_honoraire = TrancheFactureController::calculerTvaHonoraireParTranche($montant_honoraire, $taux_tva);
                        
                        $total_tva_honoraire[] = [
                            'nom_tranche' => $tranche->nom_tranche,
                            'tva_honoraire' => $tva_honoraire
                        ];
                    }

        $encaissement = Encaissement::all();

        $id_chantier = $factures->chantier->id_chantier;  // Assurez-vous que la relation existe
        $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);
        $totalsDebours = FactureController::getTotalGlobalDebours($id_chantier);

        // Appel de la fonction sommeTvaHonoraire pour calculer le total de tva_honoraire
        $total_pourcentage_taux = $this->sommeTvaHonoraire($tranches);

        $AllMontant = $totalsDebours + $totalsHonoraire + $total_pourcentage_taux;

          
         // Récupérer les données de total_budget
    $totalBudgets = TotalBudget::where('id_chantier', $id_chantier)->get();
    $date = GetDate::where('id_chantier', $id_chantier)->get();



         return view('rapport_final.detailsFinal', compact('factures','encaissement','tranches', 'total_honoraire', 'total_debours', 'total_tva_honoraire','totalsHonoraire','totalsDebours','total_pourcentage_taux','AllMontant','totalBudgets','date'));
 
     }

 
  

     public function barometre(){


    
      // Récupérer toutes les données depuis la vue
      $barometres = Barometre::all();

// Initialiser les totaux
$totalJourHomme = 0;
$totalGlobal = 0;

       // Réorganiser les données en une structure pivotée
       $chantiers = [];
       $moisAnnees = [];
       $totauxAnnuelParMois = [];

       $sommeTotalJourHomme = 0;
       $sommeTotalGlobal = 0;
       $chantiersTraites = []; 

       foreach ($barometres as $barometre) {
           // Stocker chaque mois-année unique
           $moisAnnees[$barometre->mois_annee_facture] = true;

           // Réorganiser les factures par chantier
           if (!isset($chantiers[$barometre->id_chantier])) {
               $chantiers[$barometre->id_chantier] = [
                'sous_type_mission' => $barometre->sous_type_mission,
                'date_initialisation' => $barometre->date_initialisation,
                   'reference_chantier' => $barometre->reference_chantier,
                   'nom_client' => $barometre->nom_client,
                   'total_jour_homme' => $barometre->total_jour_homme,
                   'total_global' => $barometre->total_global,
                   'montant_honoraire_total' => $barometre->montant_honoraire_total,
                   'montant_honoraire_par_facture' => $barometre->montant_honoraire_par_facture,
                   'taux_moyen' => $barometre->taux_moyen,
                   'factures_par_mois' => [],
                   'total_annuel' => 0,
               ];
           }

        // Ajouter le montant de la facture dans le mois correspondant
        $montant = $barometre->montant_honoraire_total;
        $moisAnnee = $barometre->mois_annee_facture;

        // Ajouter le montant de la barometre dans le mois correspondant
        $chantiers[$barometre->id_chantier]['factures_par_mois'][$moisAnnee] = $montant;
        
        // Ajouter au total annuel pour le chantier
        $chantiers[$barometre->id_chantier]['total_annuel'] += $montant;

        // Ajouter au total général
        if (!in_array($barometre->id_chantier, $chantiersTraites)) {
            // Ajouter cet id_chantier au tableau des chantiers traités
            $chantiersTraites[] = $barometre->id_chantier;

            // Ajouter les totaux pour ce chantier
            $sommeTotalJourHomme += $barometre->total_jour_homme;
            $sommeTotalGlobal += $barometre->total_global;
        }

        // Ajouter le montant au total mensuel par année
        if (!isset($totauxAnnuelParMois[$moisAnnee])) {
            $totauxAnnuelParMois[$moisAnnee] = 0;
        }
        $totauxAnnuelParMois[$moisAnnee] += $montant;

       }

       // Trier les mois pour les afficher dans le bon ordre
       $moisAnnees = array_keys($moisAnnees);
     
       $moisOrdre = [
        'Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4,
        'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8,
        'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12,
    ];



    usort($moisAnnees, function ($a, $b) use ($moisOrdre) {
        $aParts = explode(' ', $a);
        $bParts = explode(' ', $b);
        
        // Vérifier que chaque valeur est bien divisée en deux parties (mois et année)
        if (count($aParts) < 2 || count($bParts) < 2) {
            // Gérer les cas où le format est incorrect, en plaçant ces éléments à la fin
            return count($aParts) <=> count($bParts);
        }
        
        list($moisA, $anneeA) = $aParts;
        list($moisB, $anneeB) = $bParts;
        
        // Comparer les années d'abord
        if ($anneeA !== $anneeB) {
            return $anneeA <=> $anneeB;
        }
    
        // Si les années sont égales, comparer les mois
        return $moisOrdre[$moisA] <=> $moisOrdre[$moisB];
    });



     // Créer un tableau des totaux annuels par année
     $totauxAnnuels = []; 
     foreach ($totauxAnnuelParMois as $moisAnnee => $total) {

            // Diviser la clé mois-année en deux parties (mois et année)
    $parts = explode(' ', $moisAnnee);

    // Vérifier que le format est correct (doit avoir 2 éléments après l'explosion)
    if (count($parts) < 2) {
        continue; // Ignorer les valeurs qui ne sont pas au format attendu
    }

    list($mois, $annee) = $parts;

    // Initialiser l'année si elle n'existe pas encore dans le tableau
    if (!isset($totauxAnnuels[$annee])) {
        $totauxAnnuels[$annee] = [];
    }

    // Associer le total au mois-année
    $totauxAnnuels[$annee][$moisAnnee] = $total;


     }

     $availableYears = DB::table('v_barometre')
     ->selectRaw("DISTINCT EXTRACT(YEAR FROM TO_DATE(mois_annee_facture, 'Mon YY')) AS year")
     ->orderBy('year', 'desc')
     ->pluck('year');

      return view('rapport_final.barometre', compact('chantiers','moisAnnees','totauxAnnuels','moisOrdre','availableYears', 'sommeTotalJourHomme', 'sommeTotalGlobal'));
     

     
    }


    public function barometreFiltre(Request $request) {
        // Récupérer l'année sélectionnée
        $selectedYear = $request->input('year');

         // Récupérer toutes les années distinctes de la colonne mois_annee_facture
    $availableYears = DB::table('v_barometre')
    ->selectRaw("DISTINCT EXTRACT(YEAR FROM TO_DATE(mois_annee_facture, 'Mon YY')) AS year")
    ->orderBy('year', 'desc')
    ->pluck('year');
    
        // Vérifier si une année est sélectionnée
        if (!$selectedYear) {
            return redirect()->back()->with('error', 'Veuillez sélectionner une année.');
        }
    
        // Récupérer les données de la vue SQL filtrées par année
        $barometres = DB::table('v_barometre')
                        ->whereRaw("EXTRACT(YEAR FROM TO_DATE(mois_annee_facture, 'Mon YY')) = ?", [$selectedYear])
                        ->get();
        // Récupérer toutes les informations nécessaires pour l'affichage
        $chantiers = [];
        $moisAnnees = [];
        $totauxMensuels = [];

        $sommeTotalJourHomme = 0;
        $sommeTotalGlobal = 0;
        $chantiersTraites = [];

        foreach ($barometres as $barometre) {
            $moisAnnees[$barometre->mois_annee_facture] = true;
    
            if (!isset($chantiers[$barometre->id_chantier])) {
                $chantiers[$barometre->id_chantier] = [
                    'sous_type_mission' => $barometre->sous_type_mission,
                    'date_initialisation' => $barometre->date_initialisation,
                    'reference_chantier' => $barometre->reference_chantier,
                    'nom_client' => $barometre->nom_client,
                    'total_jour_homme' => $barometre->total_jour_homme,
                    'total_global' => $barometre->total_global,
                    'montant_honoraire_total' => $barometre->montant_honoraire_total,
                    'montant_honoraire_par_facture' => $barometre->montant_honoraire_par_facture,
                    'taux_moyen' => $barometre->taux_moyen,
                    'factures_par_mois' => [],
                    'total_annuel' => 0,
                ];
            }
    
            $montant = $barometre->montant_honoraire_total;
            $chantiers[$barometre->id_chantier]['factures_par_mois'][$barometre->mois_annee_facture] = $montant;
            $chantiers[$barometre->id_chantier]['total_annuel'] += $montant;

             // Calculer le total par mois
        if (!isset($totauxMensuels[$barometre->mois_annee_facture])) {
            $totauxMensuels[$barometre->mois_annee_facture] = 0;
        }
        $totauxMensuels[$barometre->mois_annee_facture] += $montant;

        if (!in_array($barometre->id_chantier, $chantiersTraites)) {
            // Ajouter cet id_chantier au tableau des chantiers traités
            $chantiersTraites[] = $barometre->id_chantier;

            // Ajouter les totaux pour ce chantier
            $sommeTotalJourHomme += $barometre->total_jour_homme;
            $sommeTotalGlobal += $barometre->total_global;
        }


        }



    
        $moisAnnees = array_keys($moisAnnees);
        $moisOrdre = [
            'Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4,
            'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8,
            'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12,
        ];
    
    
        // Fonction de comparaison pour trier par mois et année
        usort($moisAnnees, function ($a, $b) use ($moisOrdre) {
            list($moisA, $anneeA) = explode(' ', $a);
            list($moisB, $anneeB) = explode(' ', $b);
            
            // Comparer les années d'abord
            if ($anneeA !== $anneeB) {
                return $anneeA <=> $anneeB;
            }
    
            // Si les années sont égales, comparer les mois
            return $moisOrdre[$moisA] <=> $moisOrdre[$moisB];
        });


    

    
        // Retourner la nouvelle vue avec les données filtrées
        return view('rapport_final.barometre_filtre', compact('chantiers', 'moisAnnees', 'selectedYear','totauxMensuels','availableYears', 'sommeTotalJourHomme', 'sommeTotalGlobal'));
    }
    
    
}
