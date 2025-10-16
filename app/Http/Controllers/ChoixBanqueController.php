<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use App\Models\ChoixBanque;
use App\Models\Cheques;
use App\Models\Cheque;
use App\Models\FactureAEncaisser;
use Illuminate\Http\Request;
use App\Models\Encaissement;
use App\Models\TrancheFacture;
use App\Models\Facture;
use App\Models\ModeEncaissement;
use Illuminate\Support\Facades\DB;

class ChoixBanqueController extends Controller
{
    /**
     * Afficher la liste des encaissements.
     *
     * @return \Illuminate\View\View
     */
    public function index($id_facture)
    {
        $banques = Banque::all();
        return view('choix_banque.choix', compact('banques','id_facture'));
    }


    public function store(Request $request,$id_facture)
    {
        $validated = $request->validate([
            'banques' => 'required|array',
        ]);

        foreach ($validated['banques'] as $id_banque) {
            ChoixBanque::create([
                'id_facture' => $id_facture,
                'id_banque' => $id_banque,
            ]);
        }

        // Marquer le chantier comme complet (dernière étape du processus)
        $facture = \App\Models\Facture::find($id_facture);
        if ($facture && $facture->chantier) {
            $facture->chantier->marquerComplet();
        }

        return redirect()->route('tranchelistes')->with('success', 'Choix des banques enregistré avec succès.');
    }


    /**
     * Afficher le formulaire de création d'un nouvel encaissement.
     *
     * @return \Illuminate\View\View
     */
    // public function create($id_tranche_facture)
    // {
    //     $tranche_facture = TrancheFacture::findOrFail($id_tranche_facture);
   

    //     $banques = Banque::all();
    //     $cheques = Cheques::all();


    //     $total_a_payer = FactureAEncaisser::where('id_tranche_facture', $id_tranche_facture)->first()->total_a_payer;

    //     return view('encaissement.insertEncaissement', compact('tranche_facture', 'banques','cheques','total_a_payer'));
    // 
    // }
    // return redirect()->route('tranchelistes')
    // ->with('success', 'Les tranches de la facture ont été ajoutées avec succès.');


    /**
     * Stocker un nouvel encaissement dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */


        // Afficher le formulaire de modification
    public function edit($id)
    {
        $banque = Banque::findOrFail($id);
        $id_facture = request()->query('id_facture');
        
        return view('choix_banque.edit', compact('banque','id_facture'));
    }

    // Enregistrer les modifications
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_banque' => 'required|string|max:255',
            'compte' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);
    
        $banque = Banque::findOrFail($id);
        $banque->nom_banque = $request->nom_banque;
        $banque->compte = $request->compte;
        $banque->type = $request->type;
        $banque->save();
        
    
      

        // Redirection avec id_facture passé en paramètre
        return redirect()->route('liste.banque')
                         ->with('success', 'Banque mise à jour avec succès.');
    }



    public function listebanque()
{
    // Récupérer toutes les banques
    $banques = Banque::all();

    // Passer les banques à la vue
    return view('choix_banque.liste', compact('banques'));
}


public function indexCheque()
{
    // Récupérer le chèque unique (ou le créer s'il n'existe pas)
    $cheque = Cheque::first();
    if (!$cheque) {
        $cheque = Cheque::create([
            'nom' => 'Au nom du Cabinet Mazars Fivoarana',
        ]);
    }

    // Passer le chèque à la vue
    return view('cheque.index', compact('cheque'));
}



public function createbanque()
{
    // Afficher le formulaire de création
    return view('choix_banque.create');
}


public function storebanque(Request $request)
{
    // Validation des données
    $request->validate([
        'nom_banque' => 'required|string|max:255',
        'compte' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
    ]);

    // Création d'une nouvelle banque
    $banque = new Banque();
    $banque->nom_banque = $request->nom_banque;
    $banque->compte = $request->compte;
    $banque->type = $request->type;
    $banque->save();

    // Redirection avec un message de succès
    return redirect()->route('liste.banque')->with('success', 'Banque créée avec succès!');
}


public function updateCheque(Request $request)
{
    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
    ]);

    // Récupérer le chèque unique
    $cheque = Cheque::first();

    if ($cheque) {
        $cheque->nom = $request->nom;
        $cheque->save();
    }

    // Redirection avec un message de succès
    return redirect()->route('liste.banque')->with('success', 'Nom du chèque mis à jour avec succès!');
}


}
