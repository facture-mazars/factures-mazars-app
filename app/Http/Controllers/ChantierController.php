<?php

namespace App\Http\Controllers;

use App\Charts\ChantiersChart;
use App\Models\Chantier;
use Illuminate\Http\Request;

use App\Models\Client;

use App\Models\Monnaie;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Pays;

use App\Models\SousTypeMission;
use App\Models\TypeMission;
use Illuminate\Support\Facades\DB; 
use App\Imports\ChantierImport;
use App\Models\GetDate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log; 

class ChantierController extends Controller
{
      public function create()
    {
        // Récupérer le client associé à l'id_clients
        $pays = Pays::all();
        $clients = Client::all();
        $monnaie = Monnaie::orderBy('nom_monnaie', 'asc')->get();
        $types = TypeMission::all();
     
        // Retourner la vue avec le formulaire de création de contrat
        return view('chantier.insertChantier', compact('clients','monnaie','types','pays'));
    }

    // Méthode pour enregistrer le contrat dans la base de données
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_client' => 'required|exists:client,id_client',
             'id_type_mission' => 'required|exists:type_mission,id_type_mission',
             'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
             'objet' => 'required|string',
             'debut_exercice' => 'nullable|date',
             'fin_exercice' => 'nullable|date',
             'exercice_clos' => 'nullable|date',
             'est_recurrent' => 'nullable|boolean',
             'est_refere' => 'nullable|boolean',
             'numero_lp_contrat' => 'nullable|string|max:50',
             'date_lp_contrat' => 'nullable|date',
             'bailleur' => 'nullable|string|max:100',
             'lp_contrat' => 'nullable|in:LP,Contrat',
             'ref_lp_contrat' => 'nullable|string|max:250',
             'referant' => 'nullable|string|max:250',
             'origine_contrat' => 'nullable|string|max:150',
             'engagement_with_individuel' => 'nullable|boolean',
             'details_engagement_with_individuel' => 'nullable|string',
             'engagement_with_other_mazars_entity' => 'nullable|boolean',
             'details_engagement_with_other_mazars_entity' => 'nullable|string',
             'framework_agreement' => 'nullable|boolean',
             'details_framework_agreement' => 'nullable|string',
             
             
             
             
             'dom_export' => 'nullable|in:Domestique,Export',
             'new_country_intervention' => 'nullable|string|max:255',
             'new_monnaie' => 'nullable|string|max:255',
            
         ]);


      // Vérifier si la monnaie est nouvelle
    if ($request->input('id_monnaie') === 'add_new_monnaie') {
        $newMonnaie = $request->input('new_monnaie');

        // S'assurer que new_monnaie n'est pas vide
        if (!empty($newMonnaie)) {
            // Vérifier si la monnaie existe déjà
            $monnaie = Monnaie::where('nom_monnaie', $newMonnaie)->first();

            if (!$monnaie) {
                // Si elle n'existe pas, créer une nouvelle entrée
                $monnaie = new Monnaie();
                $monnaie->nom_monnaie = $newMonnaie;
                $monnaie->save();
            }

            $id_monnaie = $monnaie->id_monnaie;
        } else {
            return back()->withErrors(['new_monnaie' => 'Le champ "Nouvelle monnaie" ne peut pas être vide.']);
        }
    } else {
        $validatedData = $request->validate([
            'id_client' => 'required|exists:client,id_client',
            'id_type_mission' => 'required|exists:type_mission,id_type_mission',
            'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
            'objet' => 'required|string',
            'debut_exercice' => 'nullable|date',
            'fin_exercice' => 'nullable|date',
            'exercice_clos' => 'nullable|date',
            'est_recurrent' => 'nullable|boolean',
            'est_refere' => 'nullable|boolean',
            'numero_lp_contrat' => 'nullable|string|max:50',
            'date_lp_contrat' => 'nullable|date',
            'bailleur' => 'nullable|string|max:100',
            'lp_contrat' => 'nullable|in:LP,Contrat',
            'ref_lp_contrat' => 'nullable|string|max:250',
            'referant' => 'nullable|string|max:250',
            'origine_contrat' => 'nullable|string|max:150',
            'engagement_with_individuel' => 'nullable|boolean',
            'details_engagement_with_individuel' => 'nullable|string',
            'engagement_with_other_mazars_entity' => 'nullable|boolean',
            'details_engagement_with_other_mazars_entity' => 'nullable|string',
            'framework_agreement' => 'nullable|boolean',
            'details_framework_agreement' => 'nullable|string',
            
            
            
            
            'dom_export' => 'nullable|in:Domestique,Export',
            'id_monnaie' => 'nullable|exists:monnaie,id_monnaie',
        ]);

        $id_monnaie = $request->input('id_monnaie');
    }


 
  
     // Si l'utilisateur a choisi d'ajouter un nouveau pays
     if ($request->id_pays_intervention === 'add_new_country') {
        // Valider le nouveau pays
        $validatedData = $request->validate([
            'id_client' => 'required|exists:client,id_client',
            'id_type_mission' => 'required|exists:type_mission,id_type_mission',
            'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
            'objet' => 'required|string',
            'debut_exercice' => 'nullable|date',
            'fin_exercice' => 'nullable|date',
            'exercice_clos' => 'nullable|date',
            'est_recurrent' => 'nullable|boolean',
            'est_refere' => 'nullable|boolean',
            'numero_lp_contrat' => 'nullable|string|max:50',
            'date_lp_contrat' => 'nullable|date',
            'bailleur' => 'nullable|string|max:100',
            'lp_contrat' => 'nullable|in:LP,Contrat',
            'ref_lp_contrat' => 'nullable|string|max:250',
            'referant' => 'nullable|string|max:250',
            'origine_contrat' => 'nullable|string|max:150',
            'engagement_with_individuel' => 'nullable|boolean',
            'details_engagement_with_individuel' => 'nullable|string',
            'engagement_with_other_mazars_entity' => 'nullable|boolean',
            'details_engagement_with_other_mazars_entity' => 'nullable|string',
            'framework_agreement' => 'nullable|boolean',
            'details_framework_agreement' => 'nullable|string',
            
            
            
            
            'dom_export' => 'nullable|in:Domestique,Export',

            'new_country_intervention' => 'required|string|max:255',
        ]);

        // Créer un nouveau pays
        $pays = new Pays();
        $pays->nom_pays = $request->new_country_intervention;
        $pays->save();

        // Utiliser l'ID du nouveau pays pour l'intervention
        $id_pays_intervention = $pays->id_pays;
    } else {
        // Utiliser l'ID du pays existant
        $id_pays_intervention = $request->id_pays_intervention;
    }

    // Valider et sauvegarder les autres champs
    $validatedData = $request->validate([
        'id_client' => 'required|exists:client,id_client',
         'id_type_mission' => 'required|exists:type_mission,id_type_mission',
         'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
         'objet' => 'required|string',
         'debut_exercice' => 'nullable|date',
         'fin_exercice' => 'nullable|date',
         'exercice_clos' => 'nullable|date',
         'est_recurrent' => 'nullable|boolean',
         'est_refere' => 'nullable|boolean',
         'numero_lp_contrat' => 'nullable|string|max:50',
         'date_lp_contrat' => 'nullable|date',
         'bailleur' => 'nullable|string|max:100',
         'lp_contrat' => 'nullable|in:LP,Contrat',
         'ref_lp_contrat' => 'nullable|string|max:250',
         'referant' => 'nullable|string|max:250',
         'origine_contrat' => 'nullable|string|max:150',
         'engagement_with_individuel' => 'nullable|boolean',
         'details_engagement_with_individuel' => 'nullable|string',
         'engagement_with_other_mazars_entity' => 'nullable|boolean',
         'details_engagement_with_other_mazars_entity' => 'nullable|string',
         'framework_agreement' => 'nullable|boolean',
         'details_framework_agreement' => 'nullable|string',
         
         
         
         
         'dom_export' => 'nullable|in:Domestique,Export',
       
        
     ]);
    
    $chantier = new Chantier();
    $chantier->id_client = $validatedData['id_client'];
    $chantier->id_monnaie = $id_monnaie;
    $chantier->id_type_mission = $validatedData['id_type_mission'];
    $chantier->id_sous_type_mission = $validatedData['id_sous_type_mission'];
    $chantier->objet = $validatedData['objet'];
    $chantier->debut_exercice = $validatedData['debut_exercice'];
    $chantier->fin_exercice = $validatedData['fin_exercice'];
    $chantier->exercice_clos = $validatedData['exercice_clos'];
    $chantier->est_recurrent = $validatedData['est_recurrent'];
    $chantier->est_refere = $validatedData['est_refere'];
    $chantier->numero_lp_contrat = $validatedData['numero_lp_contrat'];
    $chantier->date_lp_contrat = $validatedData['date_lp_contrat'];
    $chantier->bailleur = $validatedData['bailleur'];
    $chantier->lp_contrat = $validatedData['lp_contrat'];
    $chantier->id_pays_intervention =  $id_pays_intervention;
    $chantier->referant = $validatedData['referant'];
    $chantier->origine_contrat = $validatedData['origine_contrat'];
    $chantier->engagement_with_individuel = $validatedData['engagement_with_individuel'];
    $chantier->details_engagement_with_individuel = $validatedData['details_engagement_with_individuel'];
    $chantier->engagement_with_other_mazars_entity = $validatedData['engagement_with_other_mazars_entity'];
    $chantier->details_engagement_with_other_mazars_entity = $validatedData['details_engagement_with_other_mazars_entity'];
    $chantier->framework_agreement = $validatedData['framework_agreement'];
    $chantier->details_framework_agreement = $validatedData['details_framework_agreement'];
    $chantier->dom_export = $validatedData['dom_export'];


    $chantier->save();

        return redirect()->route('getdate.create', ['id_chantier' => $chantier->id_chantier])->with('success', 'Chantier créé avec succès.');
    }




    public function edit($id)
    {
        $chantier = Chantier::findOrFail($id);
        $clients = Client::all();
        $type_missions = TypeMission::all();
        $sous_type_missions = SousTypeMission::all();
        $monnaies = Monnaie::all();
        $pays = pays::all();

        return view('chantier.edit', compact('chantier', 'clients', 'type_missions','sous_type_missions','monnaies','pays'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_client' => 'required|exists:client,id_client',
            'id_type_mission' => 'required|exists:type_mission,id_type_mission',
            'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
            'objet' => 'required|string',
            'debut_exercice' => 'nullable|date',
            'fin_exercice' => 'nullable|date',
            'exercice_clos' => 'nullable|date',
            'est_recurrent' => 'nullable|boolean',
            'est_refere' => 'nullable|boolean',
            'numero_lp_contrat' => 'nullable|string|max:50',
            'date_lp_contrat' => 'nullable|date',
            'bailleur' => 'nullable|string|max:100',
            'lp_contrat' => 'nullable|in:LP,Contrat',
            'ref_lp_contrat' => 'nullable|string|max:250',
            'id_pays_intervention' => 'nullable|integer|exists:pays,id_pays',
            'referant' => 'nullable|string|max:250',
            'origine_contrat' => 'nullable|string|max:150',
            'engagement_with_individuel' => 'nullable|boolean',
            'details_engagement_with_individuel' => 'nullable|string',
            'engagement_with_other_mazars_entity' => 'nullable|boolean',
            'details_engagement_with_other_mazars_entity' => 'nullable|string',
            'framework_agreement' => 'nullable|boolean',
            'details_framework_agreement' => 'nullable|string',
            'dom_export' => 'nullable|in:Domestique,Export',
            'id_monnaie' => 'nullable|exists:monnaie,id_monnaie',
        ]);

        $chantier = Chantier::findOrFail($id);
        $chantier->update($request->all());

        return redirect()->route('getdate.create', ['id_chantier' => $chantier->id_chantier])
                         ->with('success', 'Chantier modifié avec succès');
    }

    public function getSousTypes($id_type_mission)
    {
        $sousTypes = SousTypeMission::where('id_type_mission', $id_type_mission)->pluck('types', 'id_sous_type_mission');
        return response()->json($sousTypes);
    }
  

    public function show()
    {
        $con = Chantier::with(['sousTypeMission', 'getDate','client'])
        ->join('client', 'chantier.id_client', '=', 'client.id_client') // Ajustez cette jointure selon votre schéma
        ->orderBy('client.code_client') 
        ->get();

        return view('chantier.listeChantier', compact('con'));
    }




    public function afficherClientsParLigneMetier()
{
    // Récupère les clients avec leur secteur d'activité
    $clientsParLigneMetier =  Chantier::join('type_mission', 'chantier.id_type_mission', '=', 'type_mission.id_type_mission')
    ->with('typeMission') // Charge les relations
    ->orderBy('type_mission.code_mission', 'asc') // Trie par code_mission dans type_mission
    ->get()
    ->groupBy(function($chantier) {
        return $chantier->typeMission->code_mission . '|' . $chantier->typeMission->types;
    });
    

    return view('chantier.clients_par_ligne_metier', compact('clientsParLigneMetier'));
}





  // Affiche la vue d'insertion
  public function showInsertForm()
  {
      return view('import.ChantierImport');
  }

  // Gère l'importation du fichier Excel
  public function importExcelChantier(Request $request)
  {
      // Validation du fichier
      $request->validate([
          'file' => 'required|mimes:xlsx,csv,xls',
      ]);

        // Log pour suivre l'importation du fichier
    Log::info('Import de fichier Excel commencé', ['file' => $request->file('file')->getClientOriginalName()]);

      try {
          // Utilise le fichier importé avec le modèle d'importation ChantierImport
          Excel::import(new ChantierImport, $request->file('file'));
          Log::info('Import réussi');
          // Redirection avec un message de succès
          return redirect()->back()->with('success', 'Le fichier a été importé avec succès !');
      } catch (\Exception $e) {
        Log::error('Erreur lors de l\'importation', ['error' => $e->getMessage()]);
     
          // Capture les erreurs et retourne un message d'erreur
          return redirect()->back()->with('error', 'Erreur lors de l\'importation du fichier : ' . $e->getMessage());
      }
  }



  public function index($id_chantier){
    $chantier = Chantier::findOrFail($id_chantier);
    $clients = $chantier->client;
     // Récupère les informations de get_date pour ce chantier
     $getDate = GetDate::where('id_chantier', $id_chantier)->first();
       return view('chantier.details', compact('chantier','clients','getDate'));

}




public function edit2($id)
{
    $chantier = Chantier::findOrFail($id);
    $clients = Client::all();
    $type_missions = TypeMission::all();
    $sous_type_missions = SousTypeMission::all();
    $monnaies = Monnaie::all();
    $pays = pays::all();

    return view('chantier.modifier', compact('chantier', 'clients', 'type_missions','sous_type_missions','monnaies','pays'));
}

public function update2(Request $request, $id)
{
    $request->validate([
        'id_client' => 'required|exists:client,id_client',
        'id_type_mission' => 'required|exists:type_mission,id_type_mission',
        'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
        'objet' => 'required|string',
        'debut_exercice' => 'nullable|date',
        'fin_exercice' => 'nullable|date',
        'exercice_clos' => 'nullable|date',
        'est_recurrent' => 'nullable|boolean',
        'est_refere' => 'nullable|boolean',
        'numero_lp_contrat' => 'nullable|string|max:50',
        'date_lp_contrat' => 'nullable|date',
        'bailleur' => 'nullable|string|max:100',
        'lp_contrat' => 'nullable|in:LP,Contrat',
        'ref_lp_contrat' => 'nullable|string|max:250',
        'id_pays_intervention' => 'nullable|integer|exists:pays,id_pays',
        'referant' => 'nullable|string|max:250',
        'origine_contrat' => 'nullable|string|max:150',
        'engagement_with_individuel' => 'nullable|boolean',
        'details_engagement_with_individuel' => 'nullable|string',
        'engagement_with_other_mazars_entity' => 'nullable|boolean',
        'details_engagement_with_other_mazars_entity' => 'nullable|string',
        'framework_agreement' => 'nullable|boolean',
        'details_framework_agreement' => 'nullable|string',
        'dom_export' => 'nullable|in:Domestique,Export',
        'id_monnaie' => 'nullable|exists:monnaie,id_monnaie',
    ]);

    $chantier = Chantier::findOrFail($id);
    $chantier->update($request->all());

    return redirect()->route('chantier.show')
                     ->with('success', 'Chantier modifié avec succès');
}



public function destroy($id)
{
    Log::info("Tentative de suppression du chantier ID: {$id}");

try {
    $chantier =Chantier::findOrFail($id);
    
    if ($chantier->getDate()->count() > 0) {
        Log::info("Suppression échouée : chantier ID {$id} lié à des missions.");
        return response()->json(['success' => false, 'message' => 'chantier lié à des missions.']);
    }

    $chantier->delete();
    Log::info("chantier ID {$id} supprimé avec succès.");
    return response()->json(['success' => true, 'message' => 'chantier supprimé avec succès.']);
} catch (\Exception $e) {
    Log::error("Erreur lors de la suppression du chantier ID {$id}: {$e->getMessage()}");
    return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression.']);
}
}

}
