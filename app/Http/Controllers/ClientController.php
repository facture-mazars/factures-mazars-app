<?php

namespace App\Http\Controllers;

use App\Imports\ClientImport;
use App\Models\Client;
use App\Models\FormeJuridique;
use App\Models\Pays;
use App\Models\SecteurActivite;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    //

    public function create()
    {
        $pays = Pays::all();
        $secteurActivites = SecteurActivite::all();
        $formeJuridiques = FormeJuridique::all();

        return view('client.insertClient', compact('pays', 'secteurActivites', 'formeJuridiques'));
    }

    public function generateCode(Request $request)
    {
        $prefix = strtoupper($request->query('prefix', ''));
        $lastClient = Client::where('code_client', 'like', $prefix.'%')
            ->orderBy('code_client', 'desc')
            ->first();

        $newNumber = 1;
        if ($lastClient) {
            $lastNumber = intval(substr($lastClient->code_client, 1));
            $newNumber = $lastNumber + 1;
        }

        return response()->json([
            'newNumber' => str_pad($newNumber, 5, '0', STR_PAD_LEFT),
        ]);
    }

    public function store(Request $request)
    {

        if ($request->input('id_pays') === 'add_new_country') {

            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'type' => 'nullable|in:PIE,OMB',
                'n_rcs' => 'nullable|string|max:50',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                'new_country' => 'nullable|string|max:255',
            ]);

            // Vérifier l'existence d'un pays avec une insensibilité à la casse
            $pays = Pays::whereRaw('LOWER(nom_pays) = ?', [strtolower($request->input('new_country'))])->first();

            if ($pays) {
                // Si le pays existe déjà, utiliser l'ID existant
                $id_pays = $pays->id_pays;
            } else {
                // Sinon, ajouter un nouveau pays
                $pays = new Pays;
                $pays->nom_pays = ucfirst(strtolower($request->input('new_country'))); // Mettre en forme le nom
                $pays->save();

                $id_pays = $pays->id_pays;
            }

            // Utiliser l'ID du nouveau pays pour l'insertion
            $id_pays = $pays->id_pays;

        } else {
            // Sinon, valider et utiliser l'ID du pays existant
            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'n_rcs' => 'nullable|string|max:50',
                'type' => 'nullable|in:PIE,OMB',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'id_pays' => 'nullable|exists:pays,id_pays',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                // autres validations
            ]);

            $id_pays = $request->input('id_pays');
        }

        // Gérer l'ajout d'un nouveau pays pour id_pays_groupe
        if ($request->input('id_pays_groupe') === 'add_new_country_groupe') {
            // Valider le champ new_country_groupe
            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'n_rcs' => 'nullable|string|max:50',
                'type' => 'nullable|in:PIE,OMB',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                'new_country_groupe' => 'nullable|string|max:255',

            ]);

            // Vérifier l'existence d'un pays pour le groupe (insensible à la casse)
            $paysGroupe = Pays::whereRaw('LOWER(nom_pays) = ?', [strtolower($request->input('new_country_groupe'))])->first();

            if ($paysGroupe) {
                // Si le pays existe déjà, utiliser l'ID existant
                $id_pays_groupe = $paysGroupe->id_pays;
            } else {
                // Sinon, ajouter un nouveau pays pour le groupe
                $paysGroupe = new Pays;
                $paysGroupe->nom_pays = ucfirst(strtolower($request->input('new_country_groupe'))); // Mettre en forme le nom
                $paysGroupe->save();

                $id_pays_groupe = $paysGroupe->id_pays;
            }

            // Utiliser l'ID du nouveau pays pour id_pays_groupe
            $id_pays_groupe = $paysGroupe->id_pays;

        } else {
            // Valider et utiliser l'ID du pays existant pour le groupe
            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'n_rcs' => 'nullable|string|max:50',
                'type' => 'nullable|in:PIE,OMB',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                'id_pays_groupe' => 'nullable|exists:pays,id_pays',

            ]);

            $id_pays_groupe = $request->input('id_pays_groupe');
        }

        // Gérer l'ajout d'une nouvelle forme juridique pour id_forme_juridique
        if ($request->input('id_forme_juridique') === 'add_new_forme_juridique') {
            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'n_rcs' => 'nullable|string|max:50',
                'type' => 'nullable|in:PIE,OMB',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                'new_forme_juridique' => 'nullable|string|max:255',
            ]);

            // Vérifier si la forme juridique existe déjà
            $formeJuridique = FormeJuridique::where('types', $request->input('new_forme_juridique'))->first();

            if (! $formeJuridique) {
                // Si elle n'existe pas, créer une nouvelle entrée
                $formeJuridique = new FormeJuridique;
                $formeJuridique->types = $request->input('new_forme_juridique');
                $formeJuridique->save();
            }

            $id_forme_juridique = $formeJuridique->id_forme_juridique;

        } else {
            $validatedData = $request->validate([
                'code_client' => 'nullable|string|max:255',
                'nom_client' => 'required|string|max:255',
                'sigle_client' => 'required|string|max:255',
                'n_rcs' => 'nullable|string|max:50',
                'type' => 'nullable|in:PIE,OMB',
                'telephone_societe' => 'nullable|string|max:255',
                'email_societe' => 'nullable|string|max:250',
                'n_stat' => 'nullable|string|max:50',
                'n_nif' => 'nullable|string|max:50',
                'n_cif' => 'nullable|string|max:50',
                'adresse_client' => 'required|string|max:255',
                'ville_siege' => 'nullable|string|max:255',
                'zone_geographique' => 'nullable|string|max:255',
                'contact_aupres_client' => 'nullable|string|max:255',
                'fonction_contact' => 'nullable|string|max:255',
                'tel_contact' => 'nullable|string|max:255',
                'mail_contact' => 'nullable|string|max:255',
                'nom_groupe' => 'nullable|string|max:255',
                'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
                'bvdid' => 'nullable|string|max:255',
                'restrictions' => 'nullable|string|max:255',
                'dg' => 'nullable|string|max:255',
                'daf' => 'nullable|string|max:255',
                'directeur_juridique' => 'nullable|string|max:255',
                'controle_interne' => 'nullable|string|max:255',
                'dsi' => 'nullable|string|max:255',
                'ca' => 'nullable|string|max:255',
                'id_forme_juridique' => 'nullable|exists:forme_juridique,id_forme_juridique',
            ]);

            $id_forme_juridique = $request->input('id_forme_juridique');
        }

        // Créer un nouveau client
        $client = new Client;
        $client->code_client = $validatedData['code_client'];
        $client->nom_client = $validatedData['nom_client'];
        $client->sigle_client = $validatedData['sigle_client'];
        $client->n_rcs = $validatedData['n_rcs'];
        $client->telephone_societe = $validatedData['telephone_societe'];
        $client->email_societe = $validatedData['email_societe'];
        $client->n_stat = $validatedData['n_stat'];
        $client->n_nif = $validatedData['n_nif'];
        $client->n_cif = $validatedData['n_cif'];
        $client->adresse_client = $validatedData['adresse_client'];
        $client->id_pays = $id_pays;
        $client->ville_siege = $validatedData['ville_siege'];
        $client->zone_geographique = $validatedData['zone_geographique'];
        $client->contact_aupres_client = $validatedData['contact_aupres_client'];
        $client->fonction_contact = $validatedData['fonction_contact'];
        $client->tel_contact = $validatedData['tel_contact'];
        $client->mail_contact = $validatedData['mail_contact'];
        $client->nom_groupe = $validatedData['nom_groupe'];
        $client->id_pays_groupe = $id_pays_groupe;
        $client->id_secteur_activite = $validatedData['id_secteur_activite'];
        $client->bvdid = $validatedData['bvdid'];
        $client->restrictions = $validatedData['restrictions'];
        $client->id_forme_juridique = $id_forme_juridique;
        $client->dg = $validatedData['dg'];
        $client->daf = $validatedData['daf'];
        $client->directeur_juridique = $validatedData['directeur_juridique'];
        $client->controle_interne = $validatedData['controle_interne'];
        $client->dsi = $validatedData['dsi'];
        $client->ca = $validatedData['ca'];
        $client->save();

        return redirect()->route('listesClients')->with('success', 'Client créé avec succès');
    }

    public function show()
    {
        $clients = Client::with(['pays'])->orderBy('code_client')->get();

        return view('client.listClients', compact('clients'));
    }

    public function rechercheNomClient(Request $request)
    {
        // Validez la requête si nécessaire
        $query = Client::query();

        if ($request->has('nom_client')) {
            $nomClient = $request->input('nom_client');
            Log::info('Searching for: '.$nomClient);
            $query->where('nom_client', 'ilike', '%'.$nomClient.'%');
        }

        $clients = $query->get();

        return view('client.listClients', ['clients' => $clients]);
    }

    public function index($id_client)
    {
        $clients = Client::findOrFail($id_client);

        return view('client.detailsClient', compact('clients'));

    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        $pays = pays::all();
        $secteur = secteurActivite::all();
        $forme = formeJuridique::all();

        return view('client.editClient', compact('client', 'pays', 'secteur', 'forme'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code_client' => 'nullable|string|max:255',
            'nom_client' => 'required|string|max:255',
            'sigle_client' => 'required|string|max:255',
            'n_rcs' => 'nullable|string|max:50',
            'type' => 'nullable|in:PIE,OMB',
            'telephone_societe' => 'nullable|string|max:255',
            'email_societe' => 'nullable|string|max:250',
            'n_stat' => 'nullable|string|max:50',
            'n_nif' => 'nullable|string|max:50',
            'n_cif' => 'nullable|string|max:50',
            'adresse_client' => 'required|string|max:255',
            'ville_siege' => 'nullable|string|max:255',
            'zone_geographique' => 'nullable|string|max:255',
            'contact_aupres_client' => 'nullable|string|max:255',
            'fonction_contact' => 'nullable|string|max:255',
            'tel_contact' => 'nullable|string|max:255',
            'mail_contact' => 'nullable|string|max:255',
            'nom_groupe' => 'nullable|string|max:255',
            'id_secteur_activite' => 'nullable|integer|exists:secteur_activite,id_secteur_activite',
            'bvdid' => 'nullable|string|max:255',
            'restrictions' => 'nullable|string|max:255',
            'dg' => 'nullable|string|max:255',
            'daf' => 'nullable|string|max:255',
            'directeur_juridique' => 'nullable|string|max:255',
            'controle_interne' => 'nullable|string|max:255',
            'dsi' => 'nullable|string|max:255',
            'ca' => 'nullable|string|max:255',
            'id_pays' => 'nullable|integer|exists:pays,id_pays',
            'id_pays_groupe' => 'nullable|integer|exists:pays,id_pays',
            'id_forme_juridique' => 'nullable|integer|exists:forme_juridique,id_forme_juridique',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('listesClients', ['id_client' => $client->id_client])
            ->with('success', 'client modifié avec succès');
    }

    public function destroy($id)
    {
        Log::info("Tentative de suppression du client ID: {$id}");

        try {
            $client = Client::findOrFail($id);

            if ($client->chantiers()->count() > 0) {
                Log::info("Suppression échouée : Client ID {$id} lié à des chantiers.");

                return response()->json(['success' => false, 'message' => 'Client lié à des chantiers.']);
            }

            $client->delete();
            Log::info("Client ID {$id} supprimé avec succès.");

            return response()->json(['success' => true, 'message' => 'Client supprimé avec succès.']);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression du client ID {$id}: {$e->getMessage()}");

            return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression.']);
        }
    }

    public function afficherClientsParSecteur()
    {
        $clientsParSecteur = SecteurActivite::with(['clients' => function ($query) {
            $query->with(['montantHonoraireParChantier'])
                ->orderByRaw('LOWER(nom_client) ASC'); // Trie les clients par nom, en ignorant la casse
        }])
            ->has('clients')
            ->orderBy('code_secteur', 'asc') // Trie les secteurs par code_secteur
            ->get();

        return view('client.clients_par_secteur', compact('clientsParSecteur'));
    }

    public function geocode($address)
    {
        $client = new GuzzleClient;

        try {
            $response = $client->get('https://nominatim.openstreetmap.org/search', [
                'query' => [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (count($data) > 0) {
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon'],
                ];
            }
        } catch (\Exception $e) {
            // Log or handle the error
            return null;
        }

        return null;
    }

    public function afficherClientsParZoneGeographique()
    {
        // Récupère les clients et les groupe par adresse_client
        $clientsParZone = Client::select('zone_geographique', 'nom_client')
            ->whereNotNull('zone_geographique')
            ->orderBy('zone_geographique') // Trie par zone_geographique
            ->get()
            ->groupBy('zone_geographique'); // Regroupe par adresse_client

        // Géocodage des adresses

        // Géocodage des adresses

        return view('client.clients_par_zone', compact('clientsParZone'));
    }

    public function createImport()
    {

        return view('import.clientImport');
    }

    public function importExcel(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Importation du fichier
        Excel::import(new ClientImport, $request->file('file'));

        return back()->with('success', 'Les données ont été importées avec succès.');
    }
}
