<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Chantier;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\GetDate;
use App\Models\Monnaie;

use App\Models\FactureBudget;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class FactureController extends Controller
{
    /**
     * Affiche une liste de toutes les factures.
     *
     * @return \Illuminate\View\View
     */


  
    public function create($id_chantier)
    {
        $chantier = Chantier::findOrFail($id_chantier);
        $client = Client::all();
        $monnaie = Monnaie::all();
        $getdates = GetDate::where('id_chantier', $id_chantier)->first(); 

    // Récupérer les factures associées au chantier
    $factures = Facture::where('id_chantier', $id_chantier)->get();
    
    // Trouver tous les budgets associés aux factures du chantier à partir de `facture_budget`
    $facture_ids = $factures->pluck('id_facture'); // Obtenir les ID des factures
    
    // Récupérer les budgets liés à ce chantier
    $budgets = Budget::where('id_chantier', $chantier->id_chantier)->get();
    
    Log::info('budget: ' . $budgets);

         
         $totalHonoraire = BudgetController::getTotalGlobalHonoraire($id_chantier);
       
        
        return view('facture.insertFacture', compact('budgets','chantier','totalHonoraire','client','monnaie','getdates'));
       
    }

    
  
    public function store(Request $request)
    {
      // Validation des données
      $validated = $request->validate([
        'id_chantier' => 'required|integer|exists:chantier,id_chantier',
        'debours_decaissable' => 'nullable|numeric|min:0',
        'debours_non_decaissable' => 'nullable|numeric|min:0',
        'nb_tranche_facture' => 'required|integer|min:0',
    
    ], [
        'debours_decaissable.min' => 'Le debours decaissable doit être positif.',
        'debours_non_decaissable.min' => 'Le debours non decaissable doit être positif.',
        'nb_tranche_facture.min' => 'Le nombre de tranche de facture doit être positif.',
    ]);



    // Création de la facture
    $facture = Facture::create([
        'id_chantier' => $validated['id_chantier'],
        'debours_decaissable' => $validated['debours_decaissable'],
        'debours_non_decaissable' => $validated['debours_non_decaissable'],
        'nb_tranche_facture' => $validated['nb_tranche_facture'],
    
    ]);

          // Récupérer tous les budgets pour l'id_chantier donné
          $budgets = Budget::where('id_chantier', $validated['id_chantier'])->get();

          // Attacher les budgets à la facture
          $facture->budgets()->attach($budgets->pluck('id_budget'));

        return redirect()->route('tranche.create', ['id_facture' => $facture->id_facture])
                         ->with('success', 'Facture créée avec succès.');
    }


    public function show()
    {
        $facture = Facture::with(['tvaImpExonere','budget.chantier.mission.client'])->get();
        return view('facture.listeFacture', compact('facture'));
    }


    public function edit($id)
{
    
    // Récupérer la facture avec l'ID correspondant
    $facture = Facture::with('chantier', 'budgets')->findOrFail($id);
    Log::info('Aizaaaaaaaaaaaaaaaaaaaa facture: ' . $facture);

    // Récupérer le chantier lié à la facture
    $chantier = Chantier::with('budgets')->findOrFail($facture->id_chantier);
    Log::info('Aizaaaaaaaaaaaaaaaaaaaa chantier: ' . $chantier);

    $client = Client::all();
    $monnaie = Monnaie::all();
    
    $getdates = GetDate::where('id_chantier', $facture->id_chantier)->first(); 


       // Récupérer les budgets liés à ce chantier
       $budgets = Budget::where('id_chantier', $facture->id_chantier)->get();

    $totalHonoraire = BudgetController::getTotalGlobalHonoraire($facture->id_chantier);

   
    Log::info('Aizaaaaaaaaaaaaaaaaaaaa budget: ' . $budgets);
  
   

    return view('facture.editFacture', compact('facture', 'chantier', 'budgets','client','monnaie','getdates','totalHonoraire'));
}

  
  


    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'id_chantier' => 'required|integer|exists:chantier,id_chantier',
        'debours_decaissable' => 'nullable|numeric|min:0',
        'debours_non_decaissable' => 'nullable|numeric|min:0',
        'nb_tranche_facture' => 'required|integer|min:0',
    
    ], [
        'debours_decaissable.min' => 'Le debours decaissable doit être positif.',
        'debours_non_decaissable.min' => 'Le debours non decaissable doit être positif.',
        'nb_tranche_facture.min' => 'Le nombre de tranche de facture doit être positif.',
    ]);
    
        // Trouver la facture à mettre à jour
        $facture = Facture::findOrFail($id);
    
        // Mise à jour des propriétés de la facture
        $facture->id_chantier = $validated['id_chantier'];
        $facture->debours_decaissable = $validated['debours_decaissable'];
        $facture->debours_non_decaissable = $validated['debours_non_decaissable'];
        $facture->nb_tranche_facture = $validated['nb_tranche_facture'];
    
        // Enregistrement des modifications
        $facture->save();
    
        // Mettre à jour l'attachement des budgets si nécessaire
        $budgets = Budget::where('id_chantier', $validated['id_chantier'])->get();
        $facture->budgets()->sync($budgets->pluck('id_budget'));
    
        return redirect()->route('tranche.create', ['id_facture' => $facture->id_facture])
                         ->with('success', 'Facture mise à jour avec succès.');
    }
    



    
    public static function getTotalGlobalDebours($id_chantier)
    {
        return Facture::where('id_chantier', $id_chantier)->sum(DB::raw('debours_decaissable + debours_non_decaissable'));
    }

 
    // public function destroy(Facture $totalFacture)
    // {
    //     $totalFacture->delete();

    //     return redirect()->route('facture.index')
    //                      ->with('success', 'Facture supprimée avec succès.');
    // }
}
