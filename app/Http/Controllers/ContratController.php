<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrat;
use App\Models\Client;
use App\Models\Monnaie;
use App\Models\Partner;



class ContratController extends Controller
{
      public function create()
    {
        // Récupérer le client associé à l'id_clients
        $clients = Client::all();
        $monnaie = Monnaie::all();
        $partners1 = Partner::all(); 
        $partners2 = Partner::all(); 
     
        // Retourner la vue avec le formulaire de création de contrat
        return view('contrat.insertContrat', compact('clients','monnaie','partners1','partners2'));
    }

    // Méthode pour enregistrer le contrat dans la base de données
    public function store(Request $request)
    {
        // dd($request->all());
       $request->validate([
            'id_client' => 'required|exists:client,id_client',
            'id_monnaie' => 'required|exists:monnaie,id_monnaie',
            'lp_contrat' => 'nullable|in:LP,Contrat',
            'exercice_clos' => 'required|date',
            'debut_mandat' => 'required|date',
            'fin_mandat' => 'required|date',
            'date_lp_contrat' => 'required|date',
            'numero_lp_contrat' => 'required|string|max:255',
            'id_partner_1' => 'required|exists:partner,id_partner',
            'id_partner_2' => 'required|exists:partner,id_partner',
            'client_refere' => 'nullable|in:Référé,Non référé',
            'mission_recurente' => 'nullable|in:Récurrente,Ponctuelle',
            'restrictions_specifiques' => 'required|boolean',
            'client_domestique' => 'nullable|in:Domestique,Export',
            'engagement_with_individuel' => 'required|boolean',
            'details_engagement_with_individuel' => 'nullable|string',
            'engagement_with_mazars_entity' => 'required|boolean',
            'details_engagement_with_mazars_entity' => 'nullable|string',
            'framework_agreement' => 'required|boolean',
            'details_framework_agreement' => 'nullable|string',
            'reviseur_independant' => 'required|string|max:255',
            'ref_ic_we_check' => 'required|string|max:255',
            'project_code' => 'required|string|max:255',
            'nombre_annee' => 'required|integer|min:0',
            'evaluation_horaire' => 'required|string|max:255',
            'bureau_mazars' => 'required|string|max:255',
        ]);

        Contrat::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Contrat créé avec succès.');
    }


    public function show()
    {
        $con = Contrat::get();
        return view('contrat.listeContrat', compact('con'));
    }


}
