<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use App\Models\ChequeBanque;
use App\Models\Cheques;
use App\Models\Encaissement;
use App\Models\Facture;
use App\Models\FactureAEncaisser;
use App\Models\TrancheFacture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncaissementController extends Controller
{
    /**
     * Afficher la liste des encaissements.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $trancheFacture = TrancheFacture::with(['facture', 'facture.budget.chantier.mission.client'])->get();

        return view('encaissement.encaissement', compact('trancheFacture'));
    }

    /**
     * Afficher le formulaire de création d'un nouvel encaissement.
     *
     * @return \Illuminate\View\View
     */
    public function create($id_tranche_facture)
    {
        $tranche_facture = TrancheFacture::findOrFail($id_tranche_facture);

        $banques = Banque::all();
        $cheques = Cheques::all();

        $total_a_payer = FactureAEncaisser::where('id_tranche_facture', $id_tranche_facture)->first()->total_a_payer;

        return view('encaissement.insertEncaissement', compact('tranche_facture', 'banques', 'cheques', 'total_a_payer'));
    }

    /**
     * Stocker un nouvel encaissement dans la base de données.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // Supprimer les séparateurs de milliers (virgules) et autres caractères non numériques
        if ($request->has('reste_a_payer')) {
            // Nettoyer la valeur (enlever les virgules, espaces et autres caractères non numériques)
            $reste_a_payer = preg_replace('/[^0-9.]/', '', $request->input('reste_a_payer'));

            // S'assurer que la valeur est un nombre valide
            $request->merge([
                'reste_a_payer' => (float) $reste_a_payer,
            ]);
        }

        // Convertir les chaînes vides en null pour id_banque et id_cheque
        $request->merge([
            'id_banque' => $request->input('id_banque') === '' ? null : $request->input('id_banque'),
            'id_cheque' => $request->input('id_cheque') === '' ? null : $request->input('id_cheque'),
        ]);

        $request->validate([
            'id_tranche_facture' => 'required|exists:tranche_facture,id_tranche_facture',
            'datereel_encaissement' => 'nullable|date',
            'id_banque' => 'required_without:id_cheque|nullable|exists:banques,id_banque',
            'id_cheque' => 'required_without:id_banque|nullable|exists:cheque,id_cheque',
            'montant_a_encaisse' => 'nullable|numeric|min:0',
            'reste_a_payer' => 'nullable|numeric|min:0',
        ], [
            'id_banque.required_without' => 'Vous devez sélectionner soit un virement, soit un chèque.',
            'id_cheque.required_without' => 'Vous devez sélectionner soit un virement, soit un chèque.',
        ]);

        // Récupérer le dernier ID d'encaissement
        $lastEncaissement = Encaissement::orderBy('id_encaissement', 'desc')->first();

        // Si des enregistrements existent, incrémentez l'ID du dernier encaissement
        $newId = $lastEncaissement ? $lastEncaissement->id_encaissement + 1 : 1;

        // Récupérer la tranche de facture associée
        $trancheFacture = TrancheFacture::findOrFail($request->input('id_tranche_facture'));

        // Vérifier si la tranche est déjà encaissée ou non
        if (! $trancheFacture->etat) {
            // Mettre à jour l'état de la tranche de facture à vrai (true)
            $trancheFacture->etat = true;
            $trancheFacture->save();
        }

        // Récupérer la facture liée à la tranche de facture
        $facture = $trancheFacture->facture; // Assurez-vous que vous avez défini la relation dans votre modèle

        if (! $facture) {
            return redirect()->back()->withErrors(['error' => 'Facture non trouvée.']);
        }

        // Si la facture est trouvée, procédez à la mise à jour de son état
        $facture->updateFactureStatus($facture->id_facture); // Passez l'ID de la facture ici

        $encaissement = new Encaissement([
            'id_encaissement' => $newId,
            'id_tranche_facture' => $request->id_tranche_facture,
            'datereel_encaissement' => $request->datereel_encaissement,
            'id_banque' => $request->id_banque,
            'id_cheque' => $request->id_cheque,
            'montant_a_encaisse' => $request->montant_a_encaisse,
            'reste_a_payer' => $request->reste_a_payer,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $encaissement->save();

        return redirect()->route('listesEncaissement')->with('success', 'Encaissement ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un encaissement spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showSansFiltre()
    {

        // Si la session contient des résultats de recherche, les afficher
        if (session()->has('encaiss')) {
            $encaissement = session('encaiss');
            session()->forget('encaiss'); // Supprimer les données de la session après l'affichage
        } else {

            $encaissement = Encaissement::with([
                'trancheFacture',
                'trancheFacture.facture.chantier.client',
                'trancheFacture', 'trancheFacture.facture.chantier.getDate',
            ])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        // Calculer les montants à payer pour chaque encaissement
        $totals = [];
        foreach ($encaissement as $e) {
            $total = $this->getTotalAEncaisser($e->trancheFacture->id_tranche_facture);
            $totals[$e->trancheFacture->id_tranche_facture] = $total;
        }

        return view('encaissement.ListeEncaissement', compact('encaissement', 'totals'));
    }

    private function getTotalAEncaisser($id_tranche_facture)
    {

        // Récupère la facture à encaisser pour cette tranche
        $facture = DB::table('facture_a_encaisser')
            ->where('id_tranche_facture', $id_tranche_facture)
            ->first();

        return $facture ? $facture->total_a_payer : 0;
    }

    public function show(Request $request)
    {
        $query = Encaissement::with([
            'modeEncaissement',
            'chequeBanque',
            'trancheFacture',
            'trancheFacture.facture.chantier.client',
            'trancheFacture', 'trancheFacture.facture.chantier.getDate',
        ])
            ->orderBy('created_at', 'DESC');

        // Filtrer par nom_client
        if ($request->filled('nom_client')) {
            $query->whereHas('trancheFacture.facture.chantier.client', function ($q) use ($request) {
                $q->where('nom_client', 'ilike', '%'.$request->nom_client.'%');
            });
        }

        // Filtrer par date prévision facture
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('datereel_encaissement', [$request->date_debut, $request->date_fin]);
        }

        // Récupérer les résultats
        $encaissement = $query->orderBy('created_at', 'desc')->get();

        // Stocker les résultats dans la session
        session()->put('encaiss', $encaissement);

        // Rediriger vers la méthode 'index' pour afficher les résultats
        return redirect()->route('listesEncaissement');

    }

    public function getChequeBanque($id_mode_encaissement)
    {
        // Récupérer les enregistrements cheque_banque qui correspondent à id_mode_encaissement
        $chequesbanques = ChequeBanque::where('id_mode_encaissement', $id_mode_encaissement)
            ->pluck('types', 'id_cheque_banque'); // Tu peux aussi inclure 'compte' si tu veux l'afficher

        // Vérifie s'il y a des résultats
        if ($chequesbanques->isEmpty()) {
            return response()->json(['error' => 'Aucun chèque trouvé pour ce mode d\'encaissement'], 404);
        }

        // Retourne les résultats en JSON
        return response()->json($chequesbanques);
    }
}
