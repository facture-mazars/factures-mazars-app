<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use App\Models\ChoixBanque;
use App\Models\Cheques;
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
        $id_facture = $banque->choixBanques->facture->id_facture 
        
        return view('choix_banque.edit', compact('banque','id_facture'));
    }

    // Enregistrer les modifications
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_banque' => 'required|string|max:255',
            'compte' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $banque = Banque::findOrFail($id);
        $banque->nom_banque = $request->nom_banque;
        $banque->compte = $request->compte;
        $banque->type = $request->type;
        $banque->save();

        return redirect()->route('choix.create')->with('success', 'Banque mise à jour avec succès.');
    }
}
