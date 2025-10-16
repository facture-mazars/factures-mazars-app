<?php

namespace App\Http\Controllers;

use App\Models\FactureAEncaisser;
use App\Models\TrancheFactureHistorique;
use Illuminate\Http\Request;
use App\Models\TrancheFacture;
use App\Models\Facture;
use App\Models\Taux;
use App\Models\Chantier;
use App\Models\ChequeBanque;
use App\Models\Client;
use App\Models\Encaissement;
use App\Models\Equipe;
use App\Models\Monnaie;
use App\Models\Societes;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;


class TrancheFactureController extends Controller
{
    // Afficher la liste des tranches de facture
      /**
     * Affiche une liste de toutes les factures.
     *
     * @return \Illuminate\View\View
     */


    // Afficher le formulaire de création d'une nouvelle tranche de facture
    public function create($id_facture)
    {
        $facture = Facture::findOrFail($id_facture);

        $chantier = Chantier::all();

        $client = Client::all();
      
        $tauxOptions = Taux::all();
        

        $monnaie = Monnaie::all();

        
        $totalDebours = $facture->debours_decaissable + $facture->debours_non_decaissable;

        $totalHonoraire = BudgetController::getTotalGlobalHonoraire($facture->id_chantier); 

        return view('tranche_facture.insertTrancheFacture', compact('facture', 'tauxOptions','totalHonoraire','totalDebours','chantier','client','monnaie'));
    }

    // Stocker une nouvelle tranche de facture dans la base de données

 

    public static function getTotalTrancheFacture($idTranche){
        $tranches = TrancheFacture::where('id_tranche_facture',$idTranche)->get();

        Log::info("Factures for ID {$idTranche}: ", $tranches->toArray());

        $total = 0;

        foreach($tranches as $tranche) {
            $total += $tranche->montant_honoraire + $tranche->montant_debours;
        }
        Log::info("Total for ID {$idTranche}: {$total}");

        return $total;
    }




    public function store(Request $request)
    {
         // Validation des données
    $request->validate([
        'id_facture' => 'required|exists:facture,id_facture',
        'tranches.*.taux_honoraire' => 'required|numeric|min:0|max:100',
        'tranches.*.montant_honoraire' => 'required|numeric|min:0',
        'tranches.*.taux_debours' => 'required|numeric|min:0|max:100',
        'tranches.*.montant_debours' => 'required|numeric|min:0',
        'tranches.*.date_prevision_facture' => 'required|date',
        'tranches.*.date_prevision_recouvrement' => 'required|date',
      'tranches.*.id_taux' => 'nullable|exists:taux,id_taux',
      'tranches.*.id_pourcentage_debours' => 'nullable|exists:taux,id_taux',
      'tranches.*.nom_tranche' => 'nullable|string'
   
    ], [
        'tranches.*.montant_honoraire.required' => 'Le montant honoraire ne peut pas être null.',
        'tranches.*.montant_debours.required' => 'Le montant debours ne peut pas être null.',
        'tranches.*.taux_honoraire.min' => 'Le taux honoraire doit être positif.',
        'tranches.*.taux_honoraire.max' => 'Le taux honoraire ne doit pas depasser 100%.',
        'tranches.*.montant_honoraire.min' => 'Le montant honoraire doit être positif.',
        'tranches.*.taux_debours.min' => 'Le taux debours doit être positif.',
        'tranches.*.taux_debours.max' => 'Le taux debours ne doit pas depasser 100%.',
        'tranches.*.montant_debours.min' => 'Le montant debours doit être positif.',
      
    ]);

        // Validation personnalisée : seulement un des deux champs `id_taux` ou `id_pourcentage_debours` doit être rempli
        foreach ($request->input('tranches', []) as $index => $tranche) {
            if (!empty($tranche['id_taux']) && !empty($tranche['id_pourcentage_debours'])) {
                return redirect()->back()
                    ->withErrors(["tranches.$index.id_taux" => 'Vous ne pouvez sélectionner qu’un seul des champs : soit taxe honoraire soit taxe debours.'])
                    ->withInput();
            }
        }
    
    

    $idFacture = $request->input('id_facture');
    $tranches = $request->input('tranches');


     // Vérification des taux
     $totalTauxHonoraire = 0;
     $totalTauxDebours = 0;
 
     foreach ($tranches as $tranche) {

          // Vérifier si des valeurs sont négatives
          if ($tranche['taux_honoraire'] < 0 || $tranche['montant_honoraire'] < 0 || 
          $tranche['taux_debours'] < 0 || $tranche['montant_debours'] < 0) {
          return redirect()->back()
                           ->withErrors(['valeur' => 'Les valeurs ne peuvent pas être négatives.'])
                           ->withInput();
      }
      
         $totalTauxHonoraire += $tranche['taux_honoraire'];
         $totalTauxDebours += $tranche['taux_debours'];
     }
 
     // Vérifier si les totaux dépassent 100%
     if ($totalTauxHonoraire > 100 || $totalTauxDebours > 100) {
         return redirect()->back()
                          ->withErrors(['taux' => 'La somme des taux_honoraire et taux_debours ne peut pas dépasser 100%.'])
                          ->withInput();
     }



    // Variable pour stocker le taux de la première tranche
    $idTauxPremierTranche = null;
    $idTauxPremierTrancheDebours = null;
    // Boucle sur chaque tranche pour les insérer dans la base de données

    foreach ($tranches as $index =>$tranche) {

         // Pour la première tranche (index 0), on récupère le taux (s'il est défini)
         if ($index === 0 && isset($tranche['id_taux'])) {
            $idTauxPremierTranche = $tranche['id_taux'];
        }

    
        // Pour les tranches suivantes, on utilise le taux de la première tranche
        $idTaux = $index === 0 ? $idTauxPremierTranche : $idTauxPremierTranche;


 // Pour la première tranche (index 0), on récupère le taux (s'il est défini)
 if ($index === 0 && isset($tranche['id_pourcentage_debours'])) {
    $idTauxPremierTrancheDebours = $tranche['id_pourcentage_debours'];
}
       

        // Pour les tranches suivantes, on utilise le taux de la première tranche
        $idTauxDebours = $index === 0 ? $idTauxPremierTrancheDebours : $idTauxPremierTrancheDebours;


         TrancheFacture::create([
            'id_facture' => $idFacture,
            'taux_honoraire' => $tranche['taux_honoraire'],
            'montant_honoraire' => $tranche['montant_honoraire'],
            'taux_debours' => $tranche['taux_debours'],
            'montant_debours' => $tranche['montant_debours'],
            'id_taux' => $idTaux,
            'id_pourcentage_debours' => $idTauxDebours,
            'date_prevision_facture' => $tranche['date_prevision_facture'],
            'date_prevision_recouvrement' => $tranche['date_prevision_recouvrement'],
            'nom_tranche' => $tranche['nom_tranche'],

        ]);



    }
    
        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('choix.create', ['id_facture' => $idFacture])
                         ->with('success', 'Les tranches de la facture ont été ajoutées avec succès.');
    }
    







    public function showSansFiltre(Request $request)
{
    $encaissements = Encaissement::pluck('id_tranche_facture')->toArray();

  // Si la session contient des résultats de recherche, les afficher
  if (session()->has('trancheFacture')) {
    $trancheFacture = session('trancheFacture');
    session()->forget('trancheFacture'); // Supprimer les données de la session après l'affichage
} else {
   
    // Créer une requête de base
    $trancheFacture = TrancheFacture::with(['facture.budgets.chantier.client'])
                            ->whereNotIn('id_tranche_facture', $encaissements)
                            ->whereNull('date_reel_fac')
                            ->orderBy('date_prevision_facture', 'asc')
                            ->get();
}




    // Calculer les totaux pour chaque tranche
    $totals = [];
    $totalAvecTaxeDebours = 0;
    $totalGlobalAvecImp = 0;
    $totalAvecPourcentageTaxeDebours = 0;
    $totalGlobalDeboursAvecImp = 0;


   foreach ($trancheFacture as $tranche) {
        $total = $this->getTotalTrancheFacture($tranche->id_tranche_facture);

        // Calculer les montants selon les taux et pourcentage de débours
        $montant_honoraire = $tranche->montant_honoraire;
        $montant_debours = $tranche->montant_debours;
        $montant_imp = 0;
        $taux_tva = 0;

        if ($tranche->taux) {
            if ($tranche->taux->types === 'IMP') {
                $pourcentageIMP = $tranche->taux->pourcentage;
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100);
                $montant_honoraire *= (1 - ($pourcentageIMP / 100));
            }
            $taux_tva = $tranche->taux->pourcentage;
        }

        $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire, $taux_tva);
        $totalAvecTaxe = $montant_honoraire + $tva;
        $totalAvecTaxeDebours += $totalAvecTaxe + $montant_debours;

        $totals[$tranche->id_tranche_facture] = $total;

        $totalAvecImp = $montant_honoraire + $montant_imp + $montant_debours;
        $totalGlobalAvecImp += $totalAvecImp;

        $totalAvecPourcentageDebours = $montant_debours + $tva + $montant_honoraire;
        $totalAvecPourcentageTaxeDebours += $totalAvecPourcentageDebours;
        $totalGlobalDeboursAvecImp += $totalAvecTaxeDebours + $montant_imp;
    }




    return view('Tranche_facture.listeTrancheFacture', compact(
        'trancheFacture',
        'totals',
        'totalAvecTaxeDebours',
        'totalGlobalAvecImp',
        'totalAvecPourcentageTaxeDebours',
        'totalGlobalDeboursAvecImp'
    ));
    


}



    public function show(Request $request)
{
    $encaissements = Encaissement::pluck('id_tranche_facture')->toArray();


    // Créer une requête de base
    $query = TrancheFacture::with(['facture.budgets.chantier.client'])
                            ->whereNotIn('id_tranche_facture', $encaissements)
                            ->whereNull('date_reel_fac')
                            ->orderBy('date_prevision_facture', 'asc');

   // Filtrer par nom_client
   if ($request->filled('nom_client')) {
    $query->whereHas('facture.budgets.chantier.client', function($q) use ($request) {
        $q->where('nom_client', 'ilike', '%' . $request->nom_client . '%');
    });
}



// Filtrer par date prévision facture
if ($request->filled('date_debut') && $request->filled('date_fin')) {
    $query->whereBetween('date_prevision_facture', [$request->date_debut, $request->date_fin]);
}

// Récupérer les résultats
$trancheFacture = $query->orderBy('created_at', 'desc')->get();
 
// Calculer les totaux pour chaque tranche
$totals = [];
foreach ($trancheFacture as $tranche) {
    $total = $this->getTotalTrancheFacture($tranche->id_tranche_facture);
    $totals[$tranche->id_tranche_facture] = $total;
}

// Stocker les résultats dans la session
session()->put('trancheFacture', $trancheFacture);

// Rediriger vers la méthode 'index' pour afficher les résultats
return redirect()->route('tranchelistes');
  
}


    
    // Fonction réutilisable pour calculer la TVA d'une tranche
    public static function calculerTvaHonoraireParTranche($montant_honoraire, $taux_tva)
    {
        // Calcul de la TVA : montant_honoraire * taux_tva / 100
        return $montant_honoraire * $taux_tva / 100;
    }

    public static function calculerTvaDeboursParTranche($montant_debours, $taux_tva)
    {
        // Calcul de la TVA : montant_honoraire * taux_tva / 100
        return $montant_debours * $taux_tva / 100;
    }

    public static function calculerIMPHonoraireParTranche($montant_honoraire, $taux_imp)
    {
        // Calcul de la TVA : montant_honoraire * taux_tva / 100
        return $montant_honoraire * $taux_imp / 100;
    }


    public static function calculerIMPDeboursParTranche($montant_debours, $taux_imp)
    {
        // Calcul de la TVA : montant_debours * taux_tva / 100
        return $montant_debours * $taux_imp / 100;
    }
  


    public function voirFacture($id){
        $trancheFacture = TrancheFacture::with([
                                                'taux',
                                                'facture.chantier',
                                                'facture.chantier.typeMission',
                                                'facture.chantier.sousTypeMission',
                                                'facture.chantier.client',
                                                'facture.chantier.client.pays',
                                                'facture.chantier.getDate',

                                                ])
                                        ->findOrFail($id);




        $id_chantier = $trancheFacture->facture->chantier->id_chantier;  // Assurez-vous que la relation existe
        $id_facture = $trancheFacture->facture->id_facture;


    // Récupérer le dernier id_tranche_facture pour ce chantier
    $dernierIdTrancheFacture = DB::table('tranche_facture')
    ->where('id_facture', $id_facture)
    ->max('id_tranche_facture');


   // Générer le nom de la tranche
   $trancheFacture->nom_genere = $this->genererNom($trancheFacture->nom_tranche, $trancheFacture->id_tranche_facture, $dernierIdTrancheFacture);

        

    // Récupérer les équipes associées à cet id_chantier avec les données de personnel
    $equipes = Equipe::with('listePersonnel')->where('id_chantier', $id_chantier)->first();

        $totals = $this->getTotalTrancheFacture($id);

     
        $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);

        $montant_honoraire = $trancheFacture->montant_honoraire;
        $montant_debours = $trancheFacture->montant_debours;
        $montant_imp = 0; 
        $taux_tva = 0;


       // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
    if ($trancheFacture->taux) {
        if ($trancheFacture->taux->types === 'IMP') {
            $pourcentageIMP = $trancheFacture->taux->pourcentage; // Par exemple 8%

            if($montant_honoraire != null) {
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            } else if($montant_honoraire == null){
                $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            }
            
        }

        $taux_tva = $trancheFacture->taux->pourcentage; // Si c'est TVA
    } else {
        $taux_tva = 0; // Ou une valeur par défaut
    }



         // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
         if ($trancheFacture->pourcentageDebours) {
            if ($trancheFacture->pourcentageDebours->types === 'IMP') {
                $pourcentageIMP = $trancheFacture->pourcentageDebours->pourcentage; // Par exemple 8%
    
                if($montant_honoraire != null) {
                    $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                } else if($montant_honoraire == null){
                    $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                }
                
            }
    
            $taux_tva_deb = $trancheFacture->pourcentageDebours->pourcentage; // Si c'est TVA
        } else {
            $taux_tva_deb = 0; // Ou une valeur par défaut
        }

        $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire,$taux_tva);
     
        $totalAvecTaxe = $montant_honoraire + $tva;
        $totalAvecTaxeDebours = $totalAvecTaxe + $montant_debours;


        $totahHonoraireAvecIMP = $montant_honoraire + $montant_imp;
        $totalGlobalAvecImp = $totahHonoraireAvecIMP + $montant_debours;


        $tva_debours = $this->calculerTvaDeboursParTranche($montant_debours,$taux_tva_deb);

        $totalAvecPourcentageDebours = $montant_debours + $tva_debours;
        $totalAvecPourcentageTaxeDebours = $totalAvecPourcentageDebours + $montant_honoraire;

        $totalDeboursAvecIMP = $montant_debours + $montant_imp;
        $totalGlobalDeboursAvecImp = $totalDeboursAvecIMP + $montant_honoraire;


        $societes = Societes::all();

    // Récupérer l'ID du pays du client
    $id_pays_client = $trancheFacture->facture->chantier->client->pays->id_pays ?? null;

    // Récupérer les chèques/bank pour le pays du client
    $chequesBanque = DB::table('cheque_banque')
        ->where('id_pays', $id_pays_client)
        ->get();


   // Si aucun chèque n'est trouvé, récupérer ceux avec id_pays = 1
 if ($chequesBanque->isEmpty()) {
     $chequesBanque = DB::table('cheque_banque')->where('id_pays', 1)->get();
 }


  // Créer une collection des types avec comptes associés
  $chequesAvecCompte = $chequesBanque->filter(function($cheque) {
    return !empty($cheque->compte); // Ne garder que les chèques avec un compte
});


// Vérifier si l'équipe et le personnel existent
 if ($equipes && $equipes->listePersonnel) {
    // Récupérer le trigramme du personnel
    $trigramme = $equipes->listePersonnel->trigramme ?? 'DVR';

 // Récupérer le dernier numéro de facture pour ce chantier
$lastFacture = DB::table('tranche_facture')
->where('numero_facture', 'LIKE', "FAC/{$trigramme}/%")
->orderBy('numero_facture', 'desc')
->first();


$nextNumber = 0;

if ($lastFacture && !empty($lastFacture->numero_facture)) {
    // Séparer le numéro de facture en parties
    $parts = explode('/', $lastFacture->numero_facture);

    // Vérifier si la troisième partie est un nombre valide
    if (count($parts) >= 3 && is_numeric($parts[2])) {
        // Incrémenter le dernier numéro trouvé
        $nextNumber = intval($parts[2]) + 1;
    }
}


// Récupérer l'année courante
$year = date('y');

// Vérification des doublons
$newNumeroFacture = "FAC/{$trigramme}/{$nextNumber}/{$year}";

// Vérifier si ce numéro de facture existe déjà
$existingFacture = DB::table('tranche_facture')
                     ->where('numero_facture', $newNumeroFacture)
                     ->first();

if ($existingFacture) {
    // Si le numéro existe déjà, incrémenter de 1
    $nextNumber++;
    $newNumeroFacture = "FAC/{$trigramme}/{$nextNumber}/{$year}";
}

$equipeGrade1 = Equipe::where('id_chantier', $id_chantier)
->where('id_grade', 1)
->get();



        return view('Tranche_facture.voirTrancheFacture', compact(
    'trancheFacture',
            'totals',
            'societes',
            'totalsHonoraire',
            'tva',
            'tva_debours',
            'totalAvecTaxe',
            'totalAvecTaxeDebours',
            'totalAvecPourcentageTaxeDebours',
            'totalAvecPourcentageDebours',
            'equipes',
            'montant_honoraire', 
            'montant_imp',
            'totahHonoraireAvecIMP',
            'totalDeboursAvecIMP',
            'chequesBanque',
            'chequesAvecCompte',
            'newNumeroFacture',
            'totalGlobalAvecImp',
            'totalGlobalDeboursAvecImp',
            'equipeGrade1'
    )); 

 } else {
        // Gérer l'absence de l'équipe ou du personnel
        return redirect()->back()->with('error', 'Équipe ou personnel non trouvés.');
    }

    }

    public function index($id){
        $trancheFacture = TrancheFacture::with([
                                                'taux',
                                                'facture.chantier',
                                                'facture.chantier.typeMission',
                                                'facture.chantier.sousTypeMission',
                                                'facture.chantier.client',
                                                'facture.chantier.client.pays',
                                                'facture.chantier.getDate',
                                                'facture.chantier.monnaie',
                                                'facture.choixBanques.banque

                                                ])
                                        ->findOrFail($id);





        $id_chantier = $trancheFacture->facture->chantier->id_chantier;  // Assurez-vous que la relation existe

        $id_facture = $trancheFacture->facture->id_facture;


        // Récupérer le dernier id_tranche_facture pour ce chantier
        $dernierIdTrancheFacture = DB::table('tranche_facture')
        ->where('id_facture', $id_facture)
        ->max('id_tranche_facture');
    
    
       // Générer le nom de la tranche
       $trancheFacture->nom_genere = $this->genererNom($trancheFacture->nom_tranche, $trancheFacture->id_tranche_facture, $dernierIdTrancheFacture);
    




 // Récupérer les équipes associées à cet id_chantier avec les données de personnel
 $equipes = Equipe::with('listePersonnel')->where('id_chantier', $id_chantier)->first();

  
        $totals = $this->getTotalTrancheFacture($id);

     
        $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);

        $montant_honoraire = $trancheFacture->montant_honoraire;
        $montant_debours = $trancheFacture->montant_debours;
        $montant_imp = 0; 
        $taux_tva = 0;


        // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
    if ($trancheFacture->taux) {
        if ($trancheFacture->taux->types === 'IMP') {
            $pourcentageIMP = $trancheFacture->taux->pourcentage; // Par exemple 8%

            if($montant_honoraire != null) {
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            } else if($montant_honoraire == null){
                $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            }
            
        }

        $taux_tva = $trancheFacture->taux->pourcentage; // Si c'est TVA
    } else {
        $taux_tva = 0; // Ou une valeur par défaut
    }



         // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
         if ($trancheFacture->pourcentageDebours) {
            if ($trancheFacture->pourcentageDebours->types === 'IMP') {
                $pourcentageIMP = $trancheFacture->pourcentageDebours->pourcentage; // Par exemple 8%
    
                if($montant_honoraire != null) {
                    $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                } else if($montant_honoraire == null){
                    $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                }
                
            }
    
            $taux_tva_deb = $trancheFacture->pourcentageDebours->pourcentage; // Si c'est TVA
        } else {
            $taux_tva_deb = 0; // Ou une valeur par défaut
        }



        $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire,$taux_tva);

        $totalAvecTaxe = $montant_honoraire + $tva;

        $totalAvecTaxeDebours = $totalAvecTaxe + $montant_debours;

        $totahHonoraireAvecIMP = $montant_honoraire + $montant_imp;
        $totalGlobalAvecImp = $totahHonoraireAvecIMP + $montant_debours;


        $tva_debours = $this->calculerTvaDeboursParTranche($montant_debours,$taux_tva_deb);

        $totalAvecPourcentageDebours = $montant_debours + $tva_debours;
        $totalAvecPourcentageTaxeDebours = $totalAvecPourcentageDebours + $montant_honoraire;

        $totalDeboursAvecIMP = $montant_debours + $montant_imp;
        $totalGlobalDeboursAvecImp = $totalDeboursAvecIMP + $montant_honoraire;



        $societes = Societes::all();
       // Récupérer l'ID du pays du client
       $id_pays_client = $trancheFacture->facture->chantier->client->pays->id_pays ?? null;

       // Récupérer les chèques/bank pour le pays du client
       $chequesBanque = DB::table('cheque_banque')
           ->where('id_pays', $id_pays_client)
           ->get();


      // Si aucun chèque n'est trouvé, récupérer ceux avec id_pays = 1
    if ($chequesBanque->isEmpty()) {
        $chequesBanque = DB::table('cheque_banque')->where('id_pays', 1)->get();
    }


  // Créer une collection des types avec comptes associés
  $chequesAvecCompte = $chequesBanque->filter(function($cheque) {
    return !empty($cheque->compte); // Ne garder que les chèques avec un compte
});


$equipeGrade1 = Equipe::where('id_chantier', $id_chantier)
->where('id_grade', 1)
->get();




 // Calculer le total à payer
 $totalAPayer = 0;

 if ($trancheFacture->taux) {
     if ($trancheFacture->taux->types != 'IMP') {
         $totalAPayer = $totalAvecTaxeDebours;
     } else {
         $totalAPayer = $totalGlobalAvecImp;
     }
 } elseif ($trancheFacture->pourcentageDebours) {
     if ($trancheFacture->pourcentageDebours->types != 'IMP') {
         $totalAPayer = $totalAvecPourcentageTaxeDebours;
     } else {
         $totalAPayer = $totalGlobalDeboursAvecImp;
     }
 } else {
     $totalAPayer = $totalAvecPourcentageTaxeDebours;
 }

 // Enregistrer dans la table FactureAEncaisser
 FactureAEncaisser::create([
     'id_tranche_facture' => $id,
     'total_a_payer' => $totalAPayer,
     'date_encaissement' => $trancheFacture->date_prevision_facture, // Vous pouvez ajuster cette date si nécessaire
 ]);

 $banquesEtTranches = DB::table('choix_banque')
 ->join('banques', 'choix_banque.id_banque', '=', 'banques.id_banque')
 ->join('tranche_facture', 'choix_banque.id_facture', '=', 'tranche_facture.id_facture')
 ->select(
     'choix_banque.id_facture',
     'banques.nom_banque',
     'banques.compte',
     'banques.type',
     'tranche_facture.nom_tranche',
     'tranche_facture.taux_honoraire',
     'tranche_facture.montant_honoraire'
 )
 ->orderBy('choix_banque.id_facture')
 ->get();


        return view('Tranche_facture.detailsTrancheFacture', compact(
            'trancheFacture', 
            'totals',
            'societes',
            'totalsHonoraire',
            'tva',
            'tva_debours',
            'totalAvecTaxe',
            'totalAvecTaxeDebours',
            'totalAvecPourcentageTaxeDebours',
            'totalAvecPourcentageDebours',
            'equipes',
            'montant_honoraire', 
            'montant_imp',
            'totahHonoraireAvecIMP',
            'totalDeboursAvecIMP',
            'chequesBanque',
            'chequesAvecCompte',
            'totalGlobalAvecImp',
            'totalGlobalDeboursAvecImp',
            'equipeGrade1',
            'banquesEtTranches'
        
        ));

    }




    public function indexSansEncaissement($id){
        $trancheFacture = TrancheFacture::with([
                                                'taux',
                                                'facture.chantier',
                                                'facture.chantier.typeMission',
                                                'facture.chantier.sousTypeMission',
                                                'facture.chantier.client',
                                                'facture.chantier.client.pays',
                                                'facture.chantier.getDate',
                                                'facture.chantier.monnaie',

                                                ])
                                        ->findOrFail($id);



  // Vérifier si la facture a déjà un numéro attribué
  if (is_null($trancheFacture->numero_facture) || $trancheFacture->numero_facture == 0) {
    // Récupérer le dernier numéro de facture généré
    $dernierNumeroFacture = TrancheFacture::max('numero_facture') ?? null;

    // Incrémenter de 1 pour le nouveau numéro de facture
    $nouveauNumeroFacture = $dernierNumeroFacture + 1;

    // Attribuer le nouveau numéro de facture à la facture
    $trancheFacture->numero_facture = $nouveauNumeroFacture;
    $trancheFacture->save(); // Enregistrer le nouveau numéro dans la base de données

    // Log pour déboguer
    Log::info('Dernier numéro de facture: ' . $dernierNumeroFacture);
    Log::info('Nouveau numéro de facture: ' . $nouveauNumeroFacture);
}

        $id_chantier = $trancheFacture->facture->chantier->id_chantier;  // Assurez-vous que la relation existe

        $id_facture = $trancheFacture->facture->id_facture;


        // Récupérer le dernier id_tranche_facture pour ce chantier
        $dernierIdTrancheFacture = DB::table('tranche_facture')
        ->where('id_facture', $id_facture)
        ->max('id_tranche_facture');
    
    
       // Générer le nom de la tranche
       $trancheFacture->nom_genere = $this->genererNom($trancheFacture->nom_tranche, $trancheFacture->id_tranche_facture, $dernierIdTrancheFacture);
    




 // Récupérer les équipes associées à cet id_chantier avec les données de personnel
 $equipes = Equipe::with('listePersonnel')->where('id_chantier', $id_chantier)->first();

  
        $totals = $this->getTotalTrancheFacture($id);

     
        $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);

        $montant_honoraire = $trancheFacture->montant_honoraire;
        $montant_debours = $trancheFacture->montant_debours;
        $montant_imp = 0; 
        $taux_tva = 0;


        // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
    if ($trancheFacture->taux) {
        if ($trancheFacture->taux->types === 'IMP') {
            $pourcentageIMP = $trancheFacture->taux->pourcentage; // Par exemple 8%

            if($montant_honoraire != null) {
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            } else if($montant_honoraire == null){
                $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            }
            
        }

        $taux_tva = $trancheFacture->taux->pourcentage; // Si c'est TVA
    } else {
        $taux_tva = 0; // Ou une valeur par défaut
    }



         // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
         if ($trancheFacture->pourcentageDebours) {
            if ($trancheFacture->pourcentageDebours->types === 'IMP') {
                $pourcentageIMP = $trancheFacture->pourcentageDebours->pourcentage; // Par exemple 8%
    
                if($montant_honoraire != null) {
                    $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                } else if($montant_honoraire == null){
                    $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                    $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
                }
                
            }
    
            $taux_tva_deb = $trancheFacture->pourcentageDebours->pourcentage; // Si c'est TVA
        } else {
            $taux_tva_deb = 0; // Ou une valeur par défaut
        }



        $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire,$taux_tva);

        $totalAvecTaxe = $montant_honoraire + $tva;

        $totalAvecTaxeDebours = $totalAvecTaxe + $montant_debours;

        $totahHonoraireAvecIMP = $montant_honoraire + $montant_imp;
        $totalGlobalAvecImp = $totahHonoraireAvecIMP + $montant_debours;


        $tva_debours = $this->calculerTvaDeboursParTranche($montant_debours,$taux_tva_deb);

        $totalAvecPourcentageDebours = $montant_debours + $tva_debours;
        $totalAvecPourcentageTaxeDebours = $totalAvecPourcentageDebours + $montant_honoraire;

        $totalDeboursAvecIMP = $montant_debours + $montant_imp;
        $totalGlobalDeboursAvecImp = $totalDeboursAvecIMP + $montant_honoraire;



        $societes = Societes::all();
       // Récupérer l'ID du pays du client
       $id_pays_client = $trancheFacture->facture->chantier->client->pays->id_pays ?? null;

       // Récupérer les chèques/bank pour le pays du client
       $chequesBanque = DB::table('cheque_banque')
           ->where('id_pays', $id_pays_client)
           ->get();


      // Si aucun chèque n'est trouvé, récupérer ceux avec id_pays = 1
    if ($chequesBanque->isEmpty()) {
        $chequesBanque = DB::table('cheque_banque')->where('id_pays', 1)->get();
    }


  // Créer une collection des types avec comptes associés
  $chequesAvecCompte = $chequesBanque->filter(function($cheque) {
    return !empty($cheque->compte); // Ne garder que les chèques avec un compte
});


$equipeGrade1 = Equipe::where('id_chantier', $id_chantier)
->where('id_grade', 1)
->get();

$banquesEtTranches = DB::table('choix_banque')
        ->join('banques', 'choix_banque.id_banque', '=', 'banques.id_banque')
        ->join('tranche_facture', 'choix_banque.id_facture', '=', 'tranche_facture.id_facture')
        ->select(
            'choix_banque.id_facture',
            'banques.nom_banque',
            'banques.compte',
            'banques.type',
            'tranche_facture.nom_tranche',
            'tranche_facture.taux_honoraire',
            'tranche_facture.montant_honoraire'
        )
        ->orderBy('choix_banque.id_facture')
        ->get();

        return view('Tranche_facture.detailsTrancheFactureSansEncaissement', compact(
            'trancheFacture', 
            'totals',
            'societes',
            'totalsHonoraire',
            'tva',
            'tva_debours',
            'totalAvecTaxe',
            'totalAvecTaxeDebours',
            'totalAvecPourcentageTaxeDebours',
            'totalAvecPourcentageDebours',
            'equipes',
            'montant_honoraire', 
            'montant_imp',
            'totahHonoraireAvecIMP',
            'totalDeboursAvecIMP',
            'chequesBanque',
            'chequesAvecCompte',
            'totalGlobalAvecImp',
            'totalGlobalDeboursAvecImp',
            'equipeGrade1',
            'banquesEtTranches'
        
        ));

    }
    // Afficher le formulaire d'édition d'une tranche de facture existante
    public function edit($id_facture)
    {
        // Récupérer les données de la facture
        $facture = Facture::findOrFail($id_facture);
    
        // Récupérer les tranches existantes pour cette facture
        $tranches = TrancheFacture::where('id_facture', $id_facture)
                    ->whereDoesntHave('encaissements') // Exclure les tranches avec des encaissements
                    ->whereNull('date_reel_fac')
                    ->get();
    
                        // Trier les tranches par numéro de tranche en utilisant la méthode d'accès
    $tranches = $tranches->sortBy(function ($tranche) {
        return $tranche->tranche_number; // Utilise la méthode d'accès pour obtenir le numéro de tranche
    });

        // Récupérer les options pour les taux
        $tauxOptions = Taux::all();

            // Récupérer les tranches de la facture déjà encaissées
            $encaisseTranches = TrancheFacture::where('id_facture', $id_facture)
            ->where('etat', true) // Etat vrai si la tranche est encaissée
            ->get(['taux_honoraire', 'taux_debours', 'nom_tranche']);

    
        // Calculer les totaux nécessaires
       $totalDebours = $facture->debours_decaissable + $facture->debours_non_decaissable;

        $totalHonoraire = BudgetController::getTotalGlobalHonoraire($facture->id_chantier); 

         // Vérifier si la tranche est liée à un encaissement
    foreach ($tranches as $tranche) {
        $tranche->in_encaissement = Encaissement::where('id_tranche_facture', $tranche->id_tranche_facture)->exists();
    }



    $encaissements = Encaissement::where('id_tranche_facture', $tranche->id_tranche_facture)->get();

    // Calculer les taux d'honoraires et débours déjà encaissés
    $totalHonoraireEncaisse = $encaissements->sum('montant_honoraire');
    $totalDeboursEncaisse = $encaissements->sum('montant_debours');


    $tranchesss = TrancheFacture::where('id_facture', $id_facture)->get();

    // Filtrer les tranches avec etat = true
    $tranchesActives = $tranchesss->where('etat', true);
    
    // Calculer la somme des taux_honoraire
    $sommeTauxHonoraires = $tranchesActives->sum('taux_honoraire');
    
        return view('Tranche_facture.modifierTrancheFacture', compact('facture', 'tranches', 'tauxOptions', 'totalHonoraire', 'totalDebours','encaisseTranches','totalHonoraireEncaisse', 'totalDeboursEncaisse','sommeTauxHonoraires'));
    }

    public function update(Request $request)
    {
       
        $data = $request->validate([
            'id_facture' => 'required|integer',
            'tranches' => 'required|array',
            'tranches.*.taux_honoraire' => 'numeric|min:0|max:100',
            'tranches.*.montant_honoraire' => 'nullable|numeric',
            'tranches.*.taux_debours' => 'numeric|min:0|max:100',
            'tranches.*.montant_debours' => 'nullable|numeric',
            'tranches.*.id_taux' => 'nullable|integer',
            'tranches.*.id_pourcentage_debours' => 'nullable|integer',
            'tranches.*.date_prevision_facture' => 'required|date',
            'tranches.*.date_prevision_recouvrement' => 'required|date',
            'tranches.*.nom_tranche' => 'required|string'
        ],[
            'tranches.*.taux_honoraire.min' => 'Le taux honoraire doit être positif.',
            'tranches.*.taux_honoraire.max' => 'Le taux honoraire ne doit pas depasser 100%.',
            'tranches.*.montant_honoraire.min' => 'Le montant honoraire doit être positif.',
            'tranches.*.taux_debours.min' => 'Le taux debours doit être positif.',
            'tranches.*.taux_debours.max' => 'Le taux debours ne doit pas depasser 100%.',
            'tranches.*.montant_debours.min' => 'Le montant debours doit être positif.',
          
        ]);
    
        $factureId = $data['id_facture'];
        $tranches = $data['tranches'];
    
    
    
    // Trouver les tranches existantes pour la facture donnée
    $existingTranches = TrancheFacture::where('id_facture', $factureId)->get()->keyBy('id_tranche_facture');

     // Obtenir les tranches déjà encaissées
     $encaissements = TrancheFacture::where('id_facture', $factureId)
     ->whereHas('encaissement', function ($query) {
         $query->whereColumn('encaissement.id_tranche_facture', 'tranche_facture.id_tranche_facture');
     })
     ->get();



    // Calculer la somme des taux honoraires et débours des tranches encaissées
    $totalTauxHonoraireEncaisse = $encaissements->sum('taux_honoraire');
    $totalTauxDeboursEncaisse = $encaissements->sum('taux_debours');

    // Initialisation des nouveaux totaux avec les tranches encaissées uniquement
    $newTotalTauxHonoraire = $totalTauxHonoraireEncaisse;
    $newTotalTauxDebours = $totalTauxDeboursEncaisse;



        // Obtenir les IDs des tranches mises à jour (seulement celles qui ont déjà un ID)
        $updatedTrancheIds = collect($tranches)->filter(function ($tranche) {
            return isset($tranche['id_tranche_facture']);
        })->pluck('id_tranche_facture');

        $idTauxPremierTranche = null; // Initialiser la variable avant la boucle
        $idTauxPremierTrancheDebours = null;
        
        Log::info('Début de la méthode update', ['data' => $data]);
        foreach ($tranches as $index => $tranche) {

            Log::info('Traitement de la tranche', ['index' => $index, 'data' => $tranche]);

                    $existingTranche = null;

                        // Si l'ID de la tranche existe, récupérer la tranche correspondante
                        if (isset($tranche['id_tranche_facture'])) {
                            Log::info('Tranche existante trouvée', ['id_tranche_facture' => $tranche['id_tranche_facture']]);
                            $existingTranche = $existingTranches->where('id_tranche_facture', $tranche['id_tranche_facture'])->first();
                            
                                           // Sauvegarder les anciennes valeurs dans l'historique avant la modification
                                           if ($existingTranche) {
                                            try {
                                                DB::table('tranche_facture_historiques')->insert([
                                                    'id_tranche_facture' => 235,
                                                    'date_prevision_facture' => '2024-11-23',
                                                    'date_prevision_recouvrement' => '2024-11-25',
                                                    'date_reel_fac' => null,
                                                    'date_modification' => now(),
                                                    'created_at' => now(),
                                                    'updated_at' => now(),
                                                ]);
                                                
                                                Log::info('Données insérées dans tranche_facture_historiques pour la tranche : ' . $existingTranche->id_tranche_facture);
                                            } catch (\Exception $e) {
                                                Log::error('Erreur lors de l\'insertion dans tranche_facture_historiques : ' . $e->getMessage());
                                            }
                                        }
                                        
                
                    }

          
                            // Ajouter les taux des tranches non encaissées uniquement
                        if (!$existingTranche || !$existingTranche->encaissements()->exists()) {
                            $newTotalTauxHonoraire += $tranche['taux_honoraire'];
                            $newTotalTauxDebours += $tranche['taux_debours'];
                        }

                        // Vérification des valeurs négatives
                        if ($tranche['taux_honoraire'] < 0 || $tranche['taux_debours'] < 0) {
                            return redirect()->back()->withErrors([
                                'taux_honoraire' => 'Le taux honoraire et le taux de débours ne doivent pas être négatifs.',
                            ]);
                        }

                        // Si la tranche n'existe pas, créer une nouvelle
                        if (!$existingTranche) {
                            $existingTranche = new TrancheFacture();
                        }
    
                    
                        // Vérification des valeurs négatives
                        if ($tranche['taux_honoraire'] < 0 || $tranche['taux_debours'] < 0) {
                            return redirect()->back()->withErrors([
                                'taux_honoraire' => 'Le taux honoraire et le taux de débours ne doivent pas être négatifs.',
                            ]);
                        }

                            // Pour la première tranche (index 0), on récupère le taux s'il est défini
                            if ($index === 0 && isset($tranche['id_taux'])) {
                                $idTauxPremierTranche = $tranche['id_taux'];
                            }

                            if ($index === 0 && isset($tranche['id_pourcentage_debours'])) {
                                $idTauxPremierTrancheDebours = $tranche['id_pourcentage_debours'];
                            }
    
    
                            // Pour les tranches suivantes, on utilise leur propre taux s'il est défini, sinon, on utilise le taux de la première tranche
                            $idTaux = isset($tranche['id_taux']) ? $tranche['id_taux'] : $idTauxPremierTranche;

                            $idTauxPourcentageDebours = isset($tranche['id_pourcentage_debours']) ? $tranche['id_pourcentage_debours'] : $idTauxPremierTrancheDebours;
                            
     
            $existingTranche = $existingTranches[$index] ?? new TrancheFacture();
            $existingTranche->id_facture = $factureId;
            $existingTranche->taux_honoraire = $tranche['taux_honoraire'];
            $existingTranche->montant_honoraire = $tranche['montant_honoraire'];
            $existingTranche->taux_debours = $tranche['taux_debours'];
            $existingTranche->montant_debours = $tranche['montant_debours'];
            $existingTranche->date_prevision_facture = $tranche['date_prevision_facture'];
            $existingTranche->date_prevision_recouvrement = $tranche['date_prevision_recouvrement'];
            $existingTranche->nom_tranche = $tranche['nom_tranche'];
            $existingTranche->id_taux =  $idTaux;
            $existingTranche->id_pourcentage_debours =  $idTauxPourcentageDebours;
            $existingTranche->save();

     // Déterminer le type d'opération (création ou mise à jour)
    //  $operationType = isset($tranche['id_tranche_facture']) ? 'update' : 'create';

    //  // Appeler saveHistory sur l'instance de TrancheFacture après la sauvegarde
    //  $existingTranche->saveHistory($operationType);
     
        }


      // Supprimer les tranches non présentes dans la liste mise à jour
    $tranchesToDelete = $existingTranches->keys()->diff($updatedTrancheIds);

    foreach ($tranchesToDelete as $idTrancheFacture) {
        $tranche = TrancheFacture::find($idTrancheFacture);
        // Vérifier si la tranche est liée à un encaissement
        if (!$tranche->encaissements()->exists()) {
            $tranche->delete();
        }
    }
    

       // Validation finale après calcul des totaux
    if ($newTotalTauxHonoraire > 100) {
        return redirect()->back()->withErrors([
            'taux_honoraire' => 'La somme des taux honoraires ne doit pas dépasser 100 %. Actuellement : ' . $newTotalTauxHonoraire . '%.',
        ]);
    }

    if ($newTotalTauxDebours > 100) {
        return redirect()->back()->withErrors([
            'taux_debours' => 'La somme des taux de débours ne doit pas dépasser 100 %. Actuellement : ' . $newTotalTauxDebours . '%.',
        ]);
    }

    return redirect()->route('choix.create', ['id_facture' => $factureId])->with('success', 'Tranches de facture mises à jour avec succès');
   
    
    

}

// Méthode pour enregistrer l'historique d'une tranche
protected function saveTrancheHistory($existingTranche)
{
    
    TrancheFactureHistorique::create([
        'id_tranche_facture' => $existingTranche->id_tranche_facture,
        'date_prevision_facture' => $existingTranche->date_prevision_facture,
        'date_prevision_recouvrement' => $existingTranche->date_prevision_recouvrement,
        'date_reel_fac' => $existingTranche->date_reel_fac,
        'date_modification' => now(),
       
    ]);
}


public function showPrevisionSansFiltre()
{
  
 

 
                                // Si la session contient des résultats de recherche, les afficher
        if (session()->has('prev')) {
            $trancheFacture = session('prev');
            session()->forget('prev'); // Supprimer les données de la session après l'affichage
        } else {
           
          $trancheFacture = TrancheFacture::with(['facture','facture.budgets.chantier.client'])
          ->orderBy('date_prevision_facture', 'asc')
          ->get();
        }
        
  

    
    return view('Tranche_facture.prevision', compact('trancheFacture'));
}


public function showPrevision(Request $request)
{

 


    $query =   TrancheFacture::with(['facture','facture.budgets.chantier.client'])
    ->orderBy('date_prevision_facture', 'desc');



        // Filtrer par nom_client
   if ($request->filled('nom_client')) {
    $query->whereHas('facture.budgets.chantier.client', function($q) use ($request) {
        $q->where('nom_client', 'ilike', '%' . $request->nom_client . '%');
    });
}



// Filtrer par date prévision facture
if ($request->filled('date_debut') && $request->filled('date_fin')) {
    $query->whereBetween('date_prevision_recouvrement', [$request->date_debut, $request->date_fin]);
}


// Récupérer les résultats
$trancheFacture = $query->orderBy('created_at', 'desc')->get();

  
// Stocker les résultats dans la session
session()->put('prev', $trancheFacture);


// Rediriger vers la méthode 'index' pour afficher les résultats
return redirect()->route('previsions');
}









public function checkNotifications() {
    // Intervalle de 7 jours par défaut
    $now = Carbon::now()->startOfDay();
    $sevenDaysLater = $now->copy()->addDays(7);

    // Vérifier les factures à émettre dans les 7 jours
    $facturesAEmettre = TrancheFacture::where('etat', 'f')
        ->whereNull('date_reel_fac')
        ->whereBetween('date_prevision_facture', [$now, $sevenDaysLater])
        ->exists();

    // Vérifier les factures à recouvrer dans les 7 jours
    $facturesARecouvrer = TrancheFacture::where('etat', 'f')
         ->whereNull('date_reel_fac')
        ->whereBetween('date_prevision_recouvrement', [$now, $sevenDaysLater])
        ->exists();

         // Vérifier les factures échues (passées) à émettre
    $facturesEmisesPassees = TrancheFacture::where('etat', 'f')
    ->whereNull('date_reel_fac')
    ->where('date_prevision_facture', '<', $now) // Date déjà passée
    ->exists();

// Vérifier les factures échues (passées) à recouvrer
$facturesRecouvrementsPassees = TrancheFacture::where('etat', 'f')
    ->where('date_prevision_recouvrement', '<', $now) // Date déjà passée
    ->whereNull('date_reel_fac')
    ->exists();

    // Si des factures existent dans les 7 jours
    return response()->json([
        'hasNotification' => $facturesAEmettre || $facturesARecouvrer,
        'hasPassedInvoices' => $facturesEmisesPassees || $facturesRecouvrementsPassees // Nouveau flag pour les factures échues
    ]);
}






public function showNotifications(Request $request) {
    // Nombre de jours par défaut (7 jours)
    $days = (int) $request->input('days', 7); // Assure-toi que c'est un entier

    // Calculer la date limite
    $now = Carbon::now()->startOfDay();
    $limitDate = $now->copy()->addDays($days);

    // Récupérer les factures à émettre ou recouvrer
    $facturesAEmettre = TrancheFacture::where('etat', 'f')
    ->whereNull('date_reel_fac')
        ->whereBetween('date_prevision_facture', [$now, $limitDate])
        ->get();

    $facturesARecouvrer = TrancheFacture::where('etat', 'f')
    ->whereNull('date_reel_fac')
        ->whereBetween('date_prevision_recouvrement', [$now, $limitDate])
        ->get();

          // Récupérer les factures échues (celles dont la date est déjà passée)
    $facturesEchues = TrancheFacture::where('etat', 'f')
    ->whereNull('date_reel_fac')
    ->where('date_prevision_facture', '<', $now)
    ->get();

    $recouvrementsEchus = TrancheFacture::where('etat', 'f')
    ->whereNull('date_reel_fac')
        ->where('date_prevision_recouvrement', '<', $now)
        ->get();


// Ajouter le nombre de jours restants avant la date de prévision dans les factures à émettre
foreach ($facturesAEmettre as $facture) {
    $datePrevision = Carbon::parse($facture->date_prevision_facture)->startOfDay(); // Prendre en compte uniquement la date
    // Calculer le nombre de jours restants
    $joursRestants = $now->diffInDays($datePrevision); // Cela retournera un entier positif
    $facture->date_prevision_facture_formatted = Carbon::parse($facture->date_prevision_facture)->translatedFormat('d F Y'); // Affiche '02 octobre 2024'

    $facture->joursRestants = ($joursRestants >= 0) ? $joursRestants : 0; // Empêcher les valeurs négatives
}

// Ajouter le nombre de jours restants avant la date de prévision dans les prévisions de recouvrement
foreach ($facturesARecouvrer as $prevision) {
    $datePrevisionRecouvrement = Carbon::parse($prevision->date_prevision_recouvrement)->startOfDay(); // Prendre en compte uniquement la date
    // Calculer le nombre de jours restants
    $joursRestants = $now->diffInDays($datePrevisionRecouvrement); // Cela retournera un entier positif
    $prevision->date_prevision_recouvrement_formatted = Carbon::parse($prevision->date_prevision_recouvrement)->translatedFormat('d F Y'); // Affiche '02 octobre 2024'

    $prevision->joursRestants = ($joursRestants >= 0) ? $joursRestants : 0; // Empêcher les valeurs négatives
}

 
  // Gérer les factures échues
  foreach ($facturesEchues as $facture) {
    $datePrevisionFacture = Carbon::parse($facture->date_prevision_facture)->startOfDay();
    $now = Carbon::now()->startOfDay();
    
    // Calculer le nombre de jours passés depuis la date prévue
    if ($datePrevisionFacture->lessThan($now)) {
        $joursPasses = $datePrevisionFacture->diffInDays($now);
        $facture->joursRestants = $joursPasses . ' jours passés';
    } else {
        $facture->joursRestants = 'Passée'; // Juste au cas où pour garder cohérence
    }

    // Formater la date pour l'affichage
    $facture->date_prevision_facture_formatted = $datePrevisionFacture->translatedFormat('d F Y');
}

foreach ($recouvrementsEchus as $prevision) {
    $datePrevisionRecouvrement = Carbon::parse($prevision->date_prevision_recouvrement)->startOfDay();
    $now = Carbon::now()->startOfDay();
    
    // Calculer le nombre de jours passés depuis la date prévue
    if ($datePrevisionRecouvrement->lessThan($now)) {
        $joursPasses = $datePrevisionRecouvrement->diffInDays($now);
        $prevision->joursRestants = $joursPasses . ' jours passés';
    } else {
        $prevision->joursRestants = 'Passée'; // Juste au cas où pour garder cohérence
    }

    // Formater la date pour l'affichage
    $prevision->date_prevision_recouvrement_formatted = $datePrevisionRecouvrement->translatedFormat('d F Y');
}


    return view('notifications', compact('facturesAEmettre', 'facturesARecouvrer', 'days', 'facturesEchues', 'recouvrementsEchus'));
}











 public function genererNom($nomTranche, $idTrancheFacture, $dernierIdTrancheFacture) {
    // Le tableau associatif pour les noms des tranches
    $noms = [
        'Tranche 1' => 'premier',
        'Tranche 2' => 'deuxième',
        'Tranche 3' => 'troisième',
        'Tranche 4' => 'quatrième',
        'Tranche 5' => 'cinquième',
        'Tranche 6' => 'sixième',
        'Tranche 7' => 'septième',
        'Tranche 8' => 'huitième',
        'Tranche 9' => 'neuvième',
        'Tranche 10' => 'dixième',
        'Tranche 11' => 'onzième',
        'Tranche 12' => 'douzième',
        'Tranche 13' => 'treizième',
        'Tranche 14' => 'quatorzième',
        'Tranche 15' => 'quinzième',
        'Tranche 16' => 'seizième',
        'Tranche 17' => 'dix-septième',
        'Tranche 18' => 'dix-huitième',
        'Tranche 19' => 'dix-neuvième',
        'Tranche 20' => 'vingtième',
        'Tranche 21' => 'vingt et unième',
        'Tranche 22' => 'vingt-deuxième',
        'Tranche 23' => 'vingt-troisième',
        'Tranche 24' => 'vingt-quatrième',
        'Tranche 25' => 'vingt-cinquième',
        'Tranche 26' => 'vingt-sixième',
        'Tranche 27' => 'vingt-septième',
        'Tranche 28' => 'vingt-huitième',
        'Tranche 29' => 'vingt-neuvième',
        'Tranche 30' => 'trentième',
        'Tranche 31' => 'trente et unième',
        'Tranche 32' => 'trente-deuxième',
        'Tranche 33' => 'trente-troisième',
        'Tranche 34' => 'trente-quatrième',
        'Tranche 35' => 'trente-cinquième',
        'Tranche 36' => 'trente-sixième',
        'Tranche 37' => 'trente-septième',
        'Tranche 38' => 'trente-huitième',
        'Tranche 39' => 'trente-neuvième',
        'Tranche 40' => 'quarantième',
        'Tranche 41' => 'quarante et unième',
        'Tranche 42' => 'quarante-deuxième',
        'Tranche 43' => 'quarante-troisième',
        'Tranche 44' => 'quarante-quatrième',
        'Tranche 45' => 'quarante-cinquième',
        'Tranche 46' => 'quarante-sixième',
        'Tranche 47' => 'quarante-septième',
        'Tranche 48' => 'quarante-huitième',
        'Tranche 49' => 'quarante-neuvième',
        'Tranche 50' => 'cinquantième',
        'Tranche 51' => 'cinquante et unième',
        'Tranche 52' => 'cinquante-deuxième',
        'Tranche 53' => 'cinquante-troisième',
        'Tranche 54' => 'cinquante-quatrième',
        'Tranche 55' => 'cinquante-cinquième',
        'Tranche 56' => 'cinquante-sixième',
        'Tranche 57' => 'cinquante-septième',
        'Tranche 58' => 'cinquante-huitième',
        'Tranche 59' => 'cinquante-neuvième',
        'Tranche 60' => 'soixantième',
        'Tranche 61' => 'soixante et unième',
        'Tranche 62' => 'soixante-deuxième',
        'Tranche 63' => 'soixante-troisième',
        'Tranche 64' => 'soixante-quatrième',
        'Tranche 65' => 'soixante-cinquième',
        'Tranche 66' => 'soixante-sixième',
        'Tranche 67' => 'soixante-septième',
        'Tranche 68' => 'soixante-huitième',
        'Tranche 69' => 'soixante-neuvième',
        'Tranche 70' => 'septantième',
        'Tranche 71' => 'soixante et onzième',
        'Tranche 72' => 'soixante-douzième',
        'Tranche 73' => 'soixante-treizième',
        'Tranche 74' => 'soixante-quatorzième',
        'Tranche 75' => 'soixante-quinzième',
        'Tranche 76' => 'soixante-seizième',
        'Tranche 77' => 'soixante-dix-septième',
        'Tranche 78' => 'soixante-dix-huitième',
        'Tranche 79' => 'soixante-dix-neuvième',
        'Tranche 80' => 'quatre-vingtième',
        'Tranche 81' => 'quatre-vingt et unième',
        'Tranche 82' => 'quatre-vingt-deuxième',
        'Tranche 83' => 'quatre-vingt-troisième',
        'Tranche 84' => 'quatre-vingt-quatrième',
        'Tranche 85' => 'quatre-vingt-cinquième',
        'Tranche 86' => 'quatre-vingt-sixième',
        'Tranche 87' => 'quatre-vingt-septième',
        'Tranche 88' => 'quatre-vingt-huitième',
        'Tranche 89' => 'quatre-vingt-neuvième',
        'Tranche 90' => 'quatre-vingt-dixième',
        'Tranche 91' => 'quatre-vingt-onzième',
        'Tranche 92' => 'quatre-vingt-douzième',
        'Tranche 93' => 'quatre-vingt-treizième',
        'Tranche 94' => 'quatre-vingt-quatorzième',
        'Tranche 95' => 'quatre-vingt-quinzième',
        'Tranche 96' => 'quatre-vingt-seizième',
        'Tranche 97' => 'quatre-vingt-dix-septième',
        'Tranche 98' => 'quatre-vingt-dix-huitième',
        'Tranche 99' => 'quatre-vingt-dix-neuvième',
        'Tranche 100' => 'centième'
    ];

    // Extraire le numéro de la tranche
    preg_match('/\d+/', $nomTranche, $matches);
    $numero = isset($matches[0]) ? intval($matches[0]) : 0;



    // Vérifier si l'id_tranche_facture est le dernier
    if ($idTrancheFacture === $dernierIdTrancheFacture) {
        return 'dernier';
    }

    // Retourner le nom correspondant ou 'N/A' si le numéro est hors limites
    return $noms[$nomTranche] ?? 'N/A';
}





public function facturerTranche(Request $request, $id)
{
    // Validation de la date
    $request->validate([
        'date_reel_fac' => 'nullable|date',
        'numero_facture' => 'nullable|string',
    ]);


   

    DB::table('tranche_facture')
        ->where('id_tranche_facture', $id)
        ->update([
            'date_reel_fac' => $request->date_reel_fac,
            'numero_facture' => $request->numero_facture
        ]);

  
    // Redirection vers la page de détails de la tranche facturée
    return redirect()->route('tranche.details', ['id_tranche_facture' => $id])
                     ->with('success', 'Date facture et numéro de facture mis à jour avec succès.');
}

// Fonction pour obtenir le montant à payer pour une tranche donnée
public static function getTotalAEncaisser($id_tranche_facture)
{
    $facture = DB::table('facture_a_encaisser')
                 ->where('id_tranche_facture', $id_tranche_facture)
                 ->first();
    
    return $facture ? $facture->total_a_payer : 0;
}


public function liste_facture_emise()
{
    // Récupère les clients et les groupe par adresse_client
    $emises = TrancheFacture::whereNotNull('date_reel_fac')
                            ->whereNotIn('id_tranche_facture', function ($query) {
                                $query->select('id_tranche_facture')
                                    ->from('encaissement');
                            })
                            ->orderBy('date_reel_fac', 'asc')
                            ->get(); 



// Calculer les totaux pour chaque tranche
$totals = [];
foreach ($emises as $tranche) {
    $total = $this->getTotalAEncaisser($tranche->id_tranche_facture);
    $totals[$tranche->id_tranche_facture] = $total;
}


    return view('Tranche_facture.emises', compact('emises','totals'));
}


public function facturerTrancheAnnuler(Request $request, $id)
{
    // Validation de la date
    $request->validate([
        'date_facture_annule' => 'nullable|date',
        'numero_facture_annule' => 'nullable|string',
    ]);


   

    DB::table('tranche_facture')
        ->where('id_tranche_facture', $id)
        ->update([
            'date_facture_annule' => $request->date_facture_annule,
            'numero_facture_annule' => $request->numero_facture_annule
        ]);

  
    // Redirection vers la page de détails de la tranche facturée
    return redirect()->route('tranche.detailsAnnuler', ['id_tranche_facture' => $id])
                     ->with('success', 'Date facture et numéro de facture mis à jour avec succès.');
}


public function factureAnnuler($id){
    $trancheFacture = TrancheFacture::with([
                                            'taux',
                                            'facture.chantier',
                                            'facture.chantier.typeMission',
                                            'facture.chantier.sousTypeMission',
                                            'facture.chantier.client',
                                            'facture.chantier.client.pays',
                                            'facture.chantier.getDate',
                                            'facture.chantier.monnaie',

                                            ])
                                    ->findOrFail($id);



    $id_chantier = $trancheFacture->facture->chantier->id_chantier;  // Assurez-vous que la relation existe

    $id_facture = $trancheFacture->facture->id_facture;


    // Récupérer le dernier id_tranche_facture pour ce chantier
    $dernierIdTrancheFacture = DB::table('tranche_facture')
    ->where('id_facture', $id_facture)
    ->max('id_tranche_facture');


   // Générer le nom de la tranche
   $trancheFacture->nom_genere = $this->genererNom($trancheFacture->nom_tranche, $trancheFacture->id_tranche_facture, $dernierIdTrancheFacture);





// Récupérer les équipes associées à cet id_chantier avec les données de personnel
$equipes = Equipe::with('listePersonnel')->where('id_chantier', $id_chantier)->first();


    $totals = $this->getTotalTrancheFacture($id);

 
    $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);

    $montant_honoraire = $trancheFacture->montant_honoraire;
    $montant_debours = $trancheFacture->montant_debours;
    $montant_imp = 0; 
    $taux_tva = 0;


    // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
if ($trancheFacture->taux) {
    if ($trancheFacture->taux->types === 'IMP') {
        $pourcentageIMP = $trancheFacture->taux->pourcentage; // Par exemple 8%

        if($montant_honoraire != null) {
            $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
            $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
        } else if($montant_honoraire == null){
            $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
            $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
        }
        
    }

    $taux_tva = $trancheFacture->taux->pourcentage; // Si c'est TVA
} else {
    $taux_tva = 0; // Ou une valeur par défaut
}



     // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
     if ($trancheFacture->pourcentageDebours) {
        if ($trancheFacture->pourcentageDebours->types === 'IMP') {
            $pourcentageIMP = $trancheFacture->pourcentageDebours->pourcentage; // Par exemple 8%

            if($montant_honoraire != null) {
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            } else if($montant_honoraire == null){
                $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            }
            
        }

        $taux_tva_deb = $trancheFacture->pourcentageDebours->pourcentage; // Si c'est TVA
    } else {
        $taux_tva_deb = 0; // Ou une valeur par défaut
    }



    $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire,$taux_tva);

    $totalAvecTaxe = $montant_honoraire + $tva;

    $totalAvecTaxeDebours = $totalAvecTaxe + $montant_debours;

    $totahHonoraireAvecIMP = $montant_honoraire + $montant_imp;
    $totalGlobalAvecImp = $totahHonoraireAvecIMP + $montant_debours;


    $tva_debours = $this->calculerTvaDeboursParTranche($montant_debours,$taux_tva_deb);

    $totalAvecPourcentageDebours = $montant_debours + $tva_debours;
    $totalAvecPourcentageTaxeDebours = $totalAvecPourcentageDebours + $montant_honoraire;

    $totalDeboursAvecIMP = $montant_debours + $montant_imp;
    $totalGlobalDeboursAvecImp = $totalDeboursAvecIMP + $montant_honoraire;



    $societes = Societes::all();
   // Récupérer l'ID du pays du client
   $id_pays_client = $trancheFacture->facture->chantier->client->pays->id_pays ?? null;

   // Récupérer les chèques/bank pour le pays du client
   $chequesBanque = DB::table('cheque_banque')
       ->where('id_pays', $id_pays_client)
       ->get();


  // Si aucun chèque n'est trouvé, récupérer ceux avec id_pays = 1
if ($chequesBanque->isEmpty()) {
    $chequesBanque = DB::table('cheque_banque')->where('id_pays', 1)->get();
}


// Créer une collection des types avec comptes associés
$chequesAvecCompte = $chequesBanque->filter(function($cheque) {
return !empty($cheque->compte); // Ne garder que les chèques avec un compte
});


$equipeGrade1 = Equipe::where('id_chantier', $id_chantier)
->where('id_grade', 1)
->get();

$banquesEtTranches = DB::table('choix_banque')
        ->join('banques', 'choix_banque.id_banque', '=', 'banques.id_banque')
        ->join('tranche_facture', 'choix_banque.id_facture', '=', 'tranche_facture.id_facture')
        ->select(
            'choix_banque.id_facture',
            'banques.nom_banque',
            'banques.compte',
            'banques.type',
            'tranche_facture.nom_tranche',
            'tranche_facture.taux_honoraire',
            'tranche_facture.montant_honoraire'
        )
        ->orderBy('choix_banque.id_facture')
        ->get();


    return view('Tranche_facture.detailsTrancheFactureAnnuler', compact(
        'trancheFacture', 
        'totals',
        'societes',
        'totalsHonoraire',
        'tva',
        'tva_debours',
        'totalAvecTaxe',
        'totalAvecTaxeDebours',
        'totalAvecPourcentageTaxeDebours',
        'totalAvecPourcentageDebours',
        'equipes',
        'montant_honoraire', 
        'montant_imp',
        'totahHonoraireAvecIMP',
        'totalDeboursAvecIMP',
        'chequesBanque',
        'chequesAvecCompte',
        'totalGlobalAvecImp',
        'totalGlobalDeboursAvecImp',
        'equipeGrade1',
        'banquesEtTranches'
    
    ));

}



public function indexSansEncaissementAnnuler($id){
    $trancheFacture = TrancheFacture::with([
                                            'taux',
                                            'facture.chantier',
                                            'facture.chantier.typeMission',
                                            'facture.chantier.sousTypeMission',
                                            'facture.chantier.client',
                                            'facture.chantier.client.pays',
                                            'facture.chantier.getDate',
                                            'facture.chantier.monnaie',

                                            ])
                                    ->findOrFail($id);




    $id_chantier = $trancheFacture->facture->chantier->id_chantier;  // Assurez-vous que la relation existe

    $id_facture = $trancheFacture->facture->id_facture;


    // Récupérer le dernier id_tranche_facture pour ce chantier
    $dernierIdTrancheFacture = DB::table('tranche_facture')
    ->where('id_facture', $id_facture)
    ->max('id_tranche_facture');


   // Générer le nom de la tranche
   $trancheFacture->nom_genere = $this->genererNom($trancheFacture->nom_tranche, $trancheFacture->id_tranche_facture, $dernierIdTrancheFacture);





// Récupérer les équipes associées à cet id_chantier avec les données de personnel
$equipes = Equipe::with('listePersonnel')->where('id_chantier', $id_chantier)->first();


    $totals = $this->getTotalTrancheFacture($id);

 
    $totalsHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);

    $montant_honoraire = $trancheFacture->montant_honoraire;
    $montant_debours = $trancheFacture->montant_debours;
    $montant_imp = 0; 
    $taux_tva = 0;


    // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
if ($trancheFacture->taux) {
    if ($trancheFacture->taux->types === 'IMP') {
        $pourcentageIMP = $trancheFacture->taux->pourcentage; // Par exemple 8%

        if($montant_honoraire != null) {
            $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
            $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
        } else if($montant_honoraire == null){
            $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
            $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
        }
        
    }

    $taux_tva = $trancheFacture->taux->pourcentage; // Si c'est TVA
} else {
    $taux_tva = 0; // Ou une valeur par défaut
}



     // Vérifier si le taux est "IMP" et ajuster le montant_honoraire
     if ($trancheFacture->pourcentageDebours) {
        if ($trancheFacture->pourcentageDebours->types === 'IMP') {
            $pourcentageIMP = $trancheFacture->pourcentageDebours->pourcentage; // Par exemple 8%

            if($montant_honoraire != null) {
                $montant_imp = $montant_honoraire * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_honoraire *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            } else if($montant_honoraire == null){
                $montant_imp = $montant_debours * ($pourcentageIMP / 100); // Calcul du montant IMP
                $montant_debours *= (1 - ($pourcentageIMP / 100)); // Réduire le montant_honoraire
            }
            
        }

        $taux_tva_deb = $trancheFacture->pourcentageDebours->pourcentage; // Si c'est TVA
    } else {
        $taux_tva_deb = 0; // Ou une valeur par défaut
    }



    $tva = $this->calculerTvaHonoraireParTranche($montant_honoraire,$taux_tva);

    $totalAvecTaxe = $montant_honoraire + $tva;

    $totalAvecTaxeDebours = $totalAvecTaxe + $montant_debours;

    $totahHonoraireAvecIMP = $montant_honoraire + $montant_imp;
    $totalGlobalAvecImp = $totahHonoraireAvecIMP + $montant_debours;


    $tva_debours = $this->calculerTvaDeboursParTranche($montant_debours,$taux_tva_deb);

    $totalAvecPourcentageDebours = $montant_debours + $tva_debours;
    $totalAvecPourcentageTaxeDebours = $totalAvecPourcentageDebours + $montant_honoraire;

    $totalDeboursAvecIMP = $montant_debours + $montant_imp;
    $totalGlobalDeboursAvecImp = $totalDeboursAvecIMP + $montant_honoraire;



    $societes = Societes::all();
   // Récupérer l'ID du pays du client
   $id_pays_client = $trancheFacture->facture->chantier->client->pays->id_pays ?? null;

   // Récupérer les chèques/bank pour le pays du client
   $chequesBanque = DB::table('cheque_banque')
       ->where('id_pays', $id_pays_client)
       ->get();


  // Si aucun chèque n'est trouvé, récupérer ceux avec id_pays = 1
if ($chequesBanque->isEmpty()) {
    $chequesBanque = DB::table('cheque_banque')->where('id_pays', 1)->get();
}


// Créer une collection des types avec comptes associés
$chequesAvecCompte = $chequesBanque->filter(function($cheque) {
return !empty($cheque->compte); // Ne garder que les chèques avec un compte
});


$equipeGrade1 = Equipe::where('id_chantier', $id_chantier)
->where('id_grade', 1)
->get();

$banquesEtTranches = DB::table('choix_banque')
        ->join('banques', 'choix_banque.id_banque', '=', 'banques.id_banque')
        ->join('tranche_facture', 'choix_banque.id_facture', '=', 'tranche_facture.id_facture')
        ->select(
            'choix_banque.id_facture',
            'banques.nom_banque',
            'banques.compte',
            'banques.type',
            'tranche_facture.nom_tranche',
            'tranche_facture.taux_honoraire',
            'tranche_facture.montant_honoraire'
        )
        ->orderBy('choix_banque.id_facture')
        ->get();


    return view('Tranche_facture.detailsTrancheFactureSansEncaissementAnnuler', compact(
        'trancheFacture', 
        'totals',
        'societes',
        'totalsHonoraire',
        'tva',
        'tva_debours',
        'totalAvecTaxe',
        'totalAvecTaxeDebours',
        'totalAvecPourcentageTaxeDebours',
        'totalAvecPourcentageDebours',
        'equipes',
        'montant_honoraire', 
        'montant_imp',
        'totahHonoraireAvecIMP',
        'totalDeboursAvecIMP',
        'chequesBanque',
        'chequesAvecCompte',
        'totalGlobalAvecImp',
        'totalGlobalDeboursAvecImp',
        'equipeGrade1',
        'banquesEtTranches'
    
    ));

}



}