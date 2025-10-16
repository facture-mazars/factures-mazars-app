<?php
namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Chantier;
use App\Models\Equipe;
use App\Models\Monnaie;
use App\Models\Responsable;
use App\Models\TotalBudget;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{


    // Méthode pour calculer le total des jours hommes
    public static function getTotalJourHomme($id_chantier)
    {
        return Budget::where('id_chantier', $id_chantier)->sum('nb_jour_homme');
    }

    // Méthode pour calculer le total global
    public static function getTotalGlobalHonoraire($id_chantier)
    {
        return Budget::where('id_chantier', $id_chantier)->sum(DB::raw('nb_jour_homme * taux'));
    }

    public static function getTauxMoyen($id_chantier)
{
    // Obtenir le total des jours-hommes
    $totalJourHomme = self::getTotalJourHomme($id_chantier);
    
    // Obtenir le total global des honoraires
    $totalGlobalHonoraire = self::getTotalGlobalHonoraire($id_chantier);
    
    // Calculer le taux moyen, en évitant la division par zéro
    return $totalJourHomme > 0 ? $totalGlobalHonoraire / $totalJourHomme : 0;
}


 


    public function create($id_chantier)
    {
        $chantiers = Chantier::with(['monnaie'])->findOrFail($id_chantier);
        $monnaie = Monnaie::all();
        $equipes = Equipe::where('id_chantier', $id_chantier)->get();

        return view('budget.insertBudget', compact('equipes', 'chantiers'));
    }

  
    public function store(Request $request)
{

   // Validation des données pour interdire les valeurs négatives
   $request->validate([
    'budget.*.nb_jour_homme' => 'required|numeric|min:0', // nb_jour_homme doit être un nombre positif
    'budget.*.taux' => 'required|numeric|min:0', // taux doit être un nombre positif
], [
    'budget.*.nb_jour_homme.min' => 'Le nombre de jours-homme doit être positif.',
    'budget.*.taux.min' => 'Le taux doit être positif.',
]);


    $data = $request->input('budget');
    
    $id_chantier = $request->id_chantier; // Obtenez id_chantier depuis le request

    foreach ($data as $id_equipe => $budgetData) {
        Budget::create([
            'id_equipe' => $id_equipe,
            'nb_jour_homme' => $budgetData['nb_jour_homme'],
            'taux' => $budgetData['taux'],
            'id_chantier' => $id_chantier,
        ]);
    }

      // Calculer total_jour_homme et total_global pour ce chantier
      // Utilisation des fonctions pour obtenir les totaux
        $totalJourHomme = $this->getTotalJourHomme($request->id_chantier);
        $totalGlobal = $this->getTotalGlobalHonoraire($request->id_chantier);

        

        // Calcul du taux moyen
        $tauxMoyen = $totalJourHomme > 0 ? $totalGlobal / $totalJourHomme : 0;

      // Calculer taux_moyen
      $tauxMoyen = $totalJourHomme > 0 ? $totalGlobal / $totalJourHomme : 0;

    // Mettre à jour ou insérer dans la table total_budget
    TotalBudget::updateOrCreate(
        [
            'id_chantier' => $request->id_chantier
        ],
        [
            'total_jour_homme' => $totalJourHomme,
            'total_global' => $totalGlobal,
            'taux_moyen' => $tauxMoyen
        ]
    );

    return redirect()->route('facture.create', ['id_chantier' => $request->id_chantier])
                    ->with('success', 'Budgets ajoutés avec succès.');
}






    public function show()
    {
        $budget = Budget::with(['chantier', 'responsable', 'chantier.client'])->get();
        return view('budget.listeBudget', compact('budget'));
    }


    public function getTotalParEquipe($id_chantier)
    {
        // Récupérer les équipes et leurs budgets associés au chantier
        $equipes = Equipe::whereHas('budget', function ($query) use ($id_chantier) {
            $query->where('id_chantier', $id_chantier);
        })->with(['budget' => function ($query) use ($id_chantier) {
            $query->where('id_chantier', $id_chantier);
        }])->get();
    
        // Calculer le total pour chaque équipe
        foreach ($equipes as $equipe) {
            $budget = $equipe->budget->firstWhere('id_equipe', $equipe->id_equipe);
            
            // Calculer les valeurs de nbJourHomme, taux et total pour chaque équipe
            $equipe->nbJourHomme = $budget ? $budget->nb_jour_homme : 0;
            $equipe->taux = $budget ? $budget->taux : 0;
            $equipe->total = $equipe->nbJourHomme * $equipe->taux;
        }
    
        // Retourner les équipes avec leurs informations calculées
        return $equipes;
    }
    

    public function edit($id_chantier)
    {
        
   // Récupérer tous les budgets associés à ce chantier
   $budgets = Budget::where('id_chantier', $id_chantier)->get();


    // Récupérer d'autres données nécessaires
    $chantier = Chantier::findOrFail($id_chantier);

   // Récupérer les équipes et leurs budgets associés au chantier
    $equipes = $this->getTotalParEquipe($id_chantier);

    $totalHonoraire = $this->getTotalGlobalHonoraire($id_chantier);

    $totalJourHomme = $this->getTotalJourHomme($id_chantier);

    $honoraire = $this->getTotalParEquipe($id_chantier);

    $tauxMoyen = $this->getTauxMoyen($id_chantier);


        return view('budget.editBudget', compact('budgets', 'chantier', 'equipes','totalHonoraire','totalJourHomme','honoraire','tauxMoyen'));
    }

    public function update(Request $request, $id_chantier)
    {
        // Validation des données
        $request->validate([
            'id_chantier' => 'required|exists:chantier,id_chantier', // Rendu obligatoire pour l'existence d'un chantier
            'budget.*.nb_jour_homme' => 'nullable|numeric|min:0',
            'budget.*.taux' => 'nullable|numeric|min:0',
        ], [
            'budget.*.nb_jour_homme.min' => 'Le nombre de jours-homme doit être positif.',
            'budget.*.taux.min' => 'Le taux doit être positif.',
        ]);
    
        // Boucle sur chaque équipe pour mettre à jour le budget correspondant
        foreach ($request->budget as $id_equipe => $budgetData) {
            $budget = Budget::where('id_chantier', $id_chantier)
                            ->where('id_equipe', $id_equipe)
                            ->first();
    
            if ($budget) {
                $budget->nb_jour_homme = $budgetData['nb_jour_homme'];
                $budget->taux = $budgetData['taux'];
                $budget->save();
            }
        }
    
        // Recalculer les totaux après la mise à jour
        $totalJourHomme = $this->getTotalJourHomme($id_chantier);
        $totalGlobal = $this->getTotalGlobalHonoraire($id_chantier);
    
        // Calculer le taux moyen
        $tauxMoyen = $totalJourHomme > 0 ? $totalGlobal / $totalJourHomme : 0;
    
        // Mettre à jour ou insérer dans la table total_budget
        TotalBudget::updateOrCreate(
            [
                'id_chantier' => $id_chantier
            ],
            [
                'total_jour_homme' => $totalJourHomme,
                'total_global' => $totalGlobal,
                'taux_moyen' => $tauxMoyen
            ]
        );
    
        return redirect()->route('facture.create', ['id_chantier' => $id_chantier])
                         ->with('success', 'Budgets mis à jour avec succès !');
    }
    
    

    public function calculeJourHommeParPeriode(Request $request)
    {
        $periode = $request->input('periode');
    $joursHommeParPeriode = [];

    if ($periode == 'semaine') {
        $joursHommeParPeriode = DB::table('budget as b')
            ->select(
                DB::raw("TO_CHAR(DATE_TRUNC('week', gd.date_debut_intervention), 'YYYY-MM-DD') AS periode"),
                         DB::raw('SUM(b.nb_jour_homme) AS total_jour_homme'),
                         DB::raw('SUM(b.nb_jour_homme * b.taux) / SUM(b.nb_jour_homme) AS taux_moyen') // Calcul du taux moyen
           
            )
            ->join('get_date as gd', 'b.id_chantier', '=', 'gd.id_chantier')
            ->whereNotNull('gd.date_debut_intervention')
            ->groupBy('periode')
            ->orderBy('periode')
            ->get();
    } elseif ($periode == 'mois') {
        $joursHommeParPeriode = DB::table('budget as b')
            ->select(
                DB::raw("TO_CHAR(DATE_TRUNC('month', gd.date_debut_intervention), 'YYYY-MM-DD') AS periode"),
                DB::raw('SUM(b.nb_jour_homme) AS total_jour_homme'),
                DB::raw('SUM(b.nb_jour_homme * b.taux) / SUM(b.nb_jour_homme) AS taux_moyen')
        
            )
            ->join('get_date as gd', 'b.id_chantier', '=', 'gd.id_chantier')
            ->whereNotNull('gd.date_debut_intervention')
            ->groupBy('periode')
            ->orderBy('periode')
            ->get();
    } elseif ($periode == 'annee') {
        $joursHommeParPeriode = DB::table('budget as b')
            ->select(
                DB::raw("TO_CHAR(DATE_TRUNC('year', gd.date_debut_intervention), 'YYYY-MM-DD') AS periode"),
                DB::raw('SUM(b.nb_jour_homme) AS total_jour_homme'),
                DB::raw('SUM(b.nb_jour_homme * b.taux) / SUM(b.nb_jour_homme) AS taux_moyen')
       
            )
            ->join('get_date as gd', 'b.id_chantier', '=', 'gd.id_chantier')
            ->whereNotNull('gd.date_debut_intervention')
            ->groupBy('periode')
            ->orderBy('periode')
            ->get();
    }

      // Renvoyer les données à la vue
    return view('budget.jour_homme_par_periode', [
      'jours_homme_par_periode' => $joursHommeParPeriode,
    ]);
    }
    
  
}
