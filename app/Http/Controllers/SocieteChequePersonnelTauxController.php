<?php

namespace App\Http\Controllers;

use App\Models\ChequeBanque;
use App\Models\Grade;
use App\Models\ListePersonnel;
use App\Models\ModeEncaissement;
use App\Models\Societes;
use App\Models\Taux;
use Illuminate\Http\Request;

class SocieteChequePersonnelTauxController extends Controller
{
    public function create()
    {
        // Récupère les modes d'encaissement
        $modeEncaissements = ModeEncaissement::all();
        $grades = Grade::all();
        $societes = Societes::all();

        return view('ad.ad', [
            'societe' => new Societes,
            'cheque_banque' => new ChequeBanque,
            'liste_personnel' => new ListePersonnel,
            'taux' => new Taux,
            'modeEncaissements' => $modeEncaissements,
            'grades' => $grades,
            'societes' => $societes,
            // Passe les données à la vue
        ]);
    }

    public function storeSociete(Request $request)
    {
        $validated = $request->validate([
            'nom_societe' => 'required|string|max:255',
            'rue' => 'required|string|max:255',
            'addresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        Societes::create($validated);

        return redirect()->back()->with('success', 'Société enregistrée avec succès.');
    }

    public function storeCheque(Request $request)
    {
        $validated = $request->validate([
            'types' => 'required|string|max:255',
            'compte' => 'nullable|string|max:255',
            'id_mode_encaissement' => 'required|integer|exists:mode_encaissement,id_mode_encaissement',

        ]);

        ChequeBanque::create($validated);

        return redirect()->back()->with('success', 'Chèque Banque enregistré avec succès.');
    }

    public function storePersonnel(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_grade' => 'required|integer',
            'matricule' => 'required|string|max:255',

        ]);

        $validated['actif'] = true;

        ListePersonnel::create($validated);

        return redirect()->back()->with('success', 'Personnel enregistré avec succès.');
    }

    public function storeTaux(Request $request)
    {
        $validated = $request->validate([
            'types' => 'required|string|max:255',
            'pourcentage' => 'required|numeric',
        ]);

        Taux::create($validated);

        return redirect()->back()->with('success', 'Taux enregistré avec succès.');
    }

    public function index()
    {
        $cheques = ChequeBanque::all(); // Récupère tous les chèques bancaires

        return view('ad.liste_cheque', compact('cheques')); // Passe les données à la vue
    }

    public function editCheque($id)
    {
        $cheque = ChequeBanque::findOrFail($id);
        $modeEncaissements = ModeEncaissement::all();  // Pour le sélecteur de mode d'encaissement

        return view('ad.edit_cheque', compact('cheque', 'modeEncaissements'));
    }

    public function updateCheque(Request $request, $id)
    {
        $request->validate([
            'types' => 'required|string',
            'compte' => 'nullable|string',
            'id_mode_encaissement' => 'required|integer',
        ]);

        $cheque = ChequeBanque::findOrFail($id);
        $cheque->update($request->all());

        return redirect()->route('cheque.index')->with('success', 'Chèque modifié avec succès.');
    }

    public function indexPersonnel()
    {
        $personnels = ListePersonnel::where('actif', true)
            ->orderBy('id_liste_personnel', 'asc')
            ->get();

        return view('ad.liste_perso', compact('personnels'));
    }

    public function editPers($id)
    {
        $liste_personnel = ListePersonnel::findOrFail($id);
        $grades = Grade::all();  // Pour le sélecteur de mode d'encaissement

        return view('ad.edit_personnel', compact('liste_personnel', 'grades'));
    }

    public function updatePersonnel(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_grade' => 'required',
            'matricule' => 'required|string|max:255',

        ]);

        $personnel = ListePersonnel::findOrFail($id);
        $personnel->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'id_grade' => $request->id_grade,
            'matricule' => $request->matricule,

        ]);

        return redirect()->route('personnel.index')->with('success', 'Personnel mis à jour avec succès');
    }

    public function indexTaux()
    {
        // Récupérer tous les taux
        $taux = Taux::all();

        // Retourner la vue avec les données
        return view('ad.liste_taux', compact('taux'));
    }

    // Afficher le formulaire de modification
    public function editTaux($id)
    {
        // Récupérer le taux par son ID
        $taux = Taux::findOrFail($id);

        // Retourner la vue avec le taux à modifier
        return view('ad.edit_taux', compact('taux'));
    }

    // Mettre à jour un taux
    public function updateTaux(Request $request, $id)
    {
        // Valider les données entrantes
        $request->validate([
            'types' => 'required|string|max:255',
            'pourcentage' => 'required|numeric',
        ]);

        // Récupérer le taux par son ID
        $taux = Taux::findOrFail($id);

        // Mettre à jour les données du taux
        $taux->update([
            'types' => $request->input('types'),
            'pourcentage' => $request->input('pourcentage'),
        ]);

        // Rediriger vers la liste des taux avec un message de succès
        return redirect()->route('taux.index')->with('success', 'Taux mis à jour avec succès');
    }

    // Afficher le formulaire de modification
    public function editSociete($id)
    {
        // Récupérer la société par son ID
        $societe = Societes::findOrFail($id);

        // Retourner la vue avec les informations de la société
        return view('ad.edit_societe', compact('societe'));
    }

    // Mettre à jour les informations de la société
    public function updateSociete(Request $request, $id)
    {
        // Valider les données entrantes
        $request->validate([
            'nom_societe' => 'required|string|max:255',
            'rue' => 'required|string|max:255',
            'addresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'raison_sociale' => 'required|string|max:255',
            'n_is' => 'required|string|max:255',
            'n_if' => 'required|string|max:255',
            'n_cif' => 'required|string|max:255',
        ]);

        // Récupérer la société par son ID
        $societe = Societes::findOrFail($id);

        // Mettre à jour les données de la société
        $societe->update([
            'nom_societe' => $request->input('nom_societe'),
            'rue' => $request->input('rue'),
            'addresse' => $request->input('addresse'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'raison_sociale' => $request->input('raison_sociale'),
            'n_is' => $request->input('n_is'),
            'n_if' => $request->input('n_if'),
            'n_cif' => $request->input('n_cif'),
        ]);

        // Rediriger vers la liste des sociétés avec un message de succès
        return redirect()->route('enregistrement.create')->with('success', 'Société mise à jour avec succès');
    }

    public function deactivate($id)
    {
        // Récupérer le personnel à désactiver
        $personnel = ListePersonnel::findOrFail($id);

        // Désactiver le personnel
        $personnel->update(['actif' => false]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Personnel désactivé avec succès.');
    }

    // Afficher la liste des sociétés

}
