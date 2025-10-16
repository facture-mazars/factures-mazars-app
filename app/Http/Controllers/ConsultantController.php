<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;
use App\Models\Client;
use GuzzleHttp\Client as GuzzleClient;

use App\Models\FormeJuridique;
use App\Models\Pays;
use Illuminate\Support\Facades\Log; 
use App\Models\SecteurActivite;
use App\Models\TypeMission;
use GuzzleHttp\Exception\RequestException;
use App\Imports\ClientImport;
use App\Models\Encaissement;
use App\Models\TrancheFacture;
use Maatwebsite\Excel\Facades\Excel;


class ConsultantController extends Controller
{
    
    public function show()
    {
        $clients = Client::with(['pays'])->orderBy('code_client')->get();
        return view('consultant.listeClient', compact('clients'));
    }

    public function rechercheNomClient(Request $request)
    {
          // Validez la requête si nécessaire
          $query = Client::query();

          if ($request->has('nom_client')) {
              $nomClient = $request->input('nom_client');
              Log::info('Searching for: ' . $nomClient);
              $query->where('nom_client', 'ilike', '%' . $nomClient . '%');
          }
      
          $clients = $query->get();
        return view('client.listClients', ['clients' => $clients]);
    }



  
    public function showFactureSansFiltre(Request $request)
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
                            ->orderBy('created_at', 'desc')
                            ->orderByRaw('CAST(REGEXP_REPLACE(nom_tranche, \'^Tranche \', \'\', \'g\') AS INTEGER)')
                            ->get();
}




    // Calculer les totaux pour chaque tranche
    $totals = [];
    foreach ($trancheFacture as $tranche) {
        $total = TrancheFactureController::getTotalTrancheFacture($tranche->id_tranche_facture);
        $totals[$tranche->id_tranche_facture] = $total;
    }

    return view('Consultant.listeTrancheFacture', compact('trancheFacture', 'totals'));

}



    public function showFacture(Request $request)
{
    $encaissements = Encaissement::pluck('id_tranche_facture')->toArray();


    // Créer une requête de base
    $query = TrancheFacture::with(['facture.budgets.chantier.client'])
                            ->whereNotIn('id_tranche_facture', $encaissements)
                            ->whereNull('date_reel_fac')
                            ->orderBy('created_at', 'desc')
                            ->orderByRaw('CAST(REGEXP_REPLACE(nom_tranche, \'^Tranche \', \'\', \'g\') AS INTEGER)');

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
    $total = TrancheFactureController::getTotalTrancheFacture($tranche->id_tranche_facture);
    $totals[$tranche->id_tranche_facture] = $total;
}

// Stocker les résultats dans la session
session()->put('trancheFacture', $trancheFacture);

// Rediriger vers la méthode 'index' pour afficher les résultats
return redirect()->route('tranchelistes.consultant');
  
}










}

