<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\GetDate;
use App\Models\SousTypeMission;
use App\Models\TypeMission;


class GetDateController extends Controller
{
    /**
     * Afficher la liste des encaissements.
     *
     * @return \Illuminate\View\View
     */
    public function index($id_chantier)
    {
     

        $chantier = Chantier::with('typeMission.sousTypes')->findOrFail($id_chantier); // Récupérez le chantier pour confirmation ou affichage

         // Récupérer les codes client et mission
    $client = Client::find($chantier->id_client);
    $typeMission = TypeMission::find($chantier->id_type_mission);
    
    $sousTypeMission = SousTypeMission::find($chantier->id_sous_type_mission);



    // Générer la référence chantier
    $codeClient = $client->code_client;
    $codeMission = $typeMission->code_mission;
 
        $codeSousMission = $sousTypeMission->code_sous_mission;
   

 $referenceChantier = $codeClient . $codeSousMission;


        return view('getdate.insertDate', compact('chantier','client','referenceChantier'));
    }


    /**
     * Afficher le formulaire de création d'un nouvel encaissement.
     *
     * @return \Illuminate\View\View
     */
  
    /**
     * Stocker un nouvel encaissement dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_chantier' => 'required|exists:chantier,id_chantier',
            'reference_chantier' => 'nullable|string|max:225',
            'date_initialisation' => 'nullable|date',
             'date_debut_intervention' => 'nullable|date',
             'date_fin_intervention' => 'nullable|date',
             'reference_date' => 'nullable|string|max:225',
           
        ]);

     

        $chantier = GetDate::create($request->all());

        return redirect()->route('equipe.create', ['id_chantier' => $chantier->id_chantier])->with('success', 'Date ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'un encaissement spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */


    
     public function edit($id_chantier)
     {

         // Récupérer le chantier en fonction de l'ID
         $chantier = Chantier::with('client')->findOrFail($id_chantier);
    
        // Récupérer tous les budgets associés à ce chantier
   $getdates = GetDate::where('id_chantier', $id_chantier)->get();

   $client = Client::find($chantier->id_client);
       
         
       return view('getdate.edit', compact('getdates','chantier','client'));
     }
 
     public function update(Request $request, $id)
     {
         $request->validate([
            'id_chantier' => 'required|exists:chantier,id_chantier',
            'reference_chantier' => 'nullable|string',
            'date_initialisation' => 'nullable|date',
             'date_debut_intervention' => 'nullable|date',
             'date_fin_intervention' => 'nullable|date',
             'reference_date' => 'nullable|string',
           
         ]);
 
             // Supprimer les anciennes entrées de l'équipe pour ce chantier
    GetDate::where('id_chantier', $id)->delete();

    GetDate::create([
        'id_chantier' => $request->id_chantier,
        'reference_chantier' => $request->reference_chantier,
        'date_initialisation' => $request->date_initialisation,
        'date_debut_intervention' => $request->date_debut_intervention,
        'date_fin_intervention' => $request->date_fin_intervention,
        'reference_date' => $request->reference_date,
    ]);
        
         return redirect()->route('equipe.create', ['id_chantier' => $id])
                          ->with('success', 'Date modifié avec succès.');
     }
 
 
 

   
}
