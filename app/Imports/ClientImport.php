<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\SecteurActivite;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log; 

class ClientImport implements ToModel, WithHeadingRow
{
    protected $secteurs;

    public function __construct()
    {
        // Préchargement des secteurs d'activité pour faciliter la correspondance
        $this->secteurs = SecteurActivite::all()->pluck('id_secteur_activite', 'nom_secteur_activite')->toArray();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    
    public function model(array $row)
    {
        

        // Valider que c_client n'est pas vide
        if (empty($row['c_client'])) {
           
            return null; // Ignore cette ligne si c_client est vide
        }

        // Générer le code_client à partir de c_client
        $code_client = substr($row['c_client'], 0, 1) . '000' . substr($row['c_client'], -2);

                // Vérifie si le code_client et nom_client existent déjà
            $existingClient = Client::where('code_client', $code_client)
            ->where('nom_client', $row['nom_client'])
            ->first();

        if ($existingClient) {
          
        // Gérer le cas où le client existe déjà (ignorer ou mettre à jour)
        return null; // Ignore cette ligne si le client existe déjà
        }



         // Cherche l'id du secteur à partir du nom_secteur_activite, mais gère le cas vide
    $id_secteur_activite = !empty($row['nom_secteur_activite']) ? 
    ($this->secteurs[$row['nom_secteur_activite']] ?? null) : null;

       // Récupérer le type, ou NULL par défaut
    $type = !empty($row['type']) ? $row['type'] : null; // Par défaut NULL

    // Vérifie que le type est valide, sinon l'ignore
    if ($type !== null && !in_array($type, ['PIE', 'OMB'])) {
        return null; // Ignore cette ligne si le type est invalide
    }

        return new Client([
            'code_client'         => $code_client,
            'nom_client'          => $row['nom_client'],
            'id_secteur_activite' => $id_secteur_activite,
            'sigle_client'        => $row['sigle_client'] ?? null,
            'n_rcs'               => $row['n_rcs'] ?? null,
            'n_stat'              => $row['n_stat'] ?? null,
            'n_nif'               => $row['n_nif'] ?? null,
            'n_cif'               => $row['n_cif'] ?? null,
            'adresse_client'      => $row['adresse_client'] ?? null,
            'id_pays'             => $row['id_pays'] ?? null,
            'ville_siege'         => $row['ville_siege'] ?? null,
            'zone_geographique'   => $row['zone_geographique'] ?? null,
            'contact_aupres_client'=> $row['contact_aupres_client'] ?? null,
            'fonction_contact'    => $row['fonction_contact'] ?? null,
            'tel_contact'         => $row['tel_contact'] ?? null,
            'mail_contact'        => $row['mail_contact'] ?? null,
            'nom_groupe'          => $row['nom_groupe'] ?? null,
            'id_pays_groupe'      => $row['id_pays_groupe'] ?? null,
            'bvdid'               => $row['bvdid'] ?? null,
            'restrictions'        => $row['restrictions'] ?? null,
            'id_forme_juridique'  => $row['id_forme_juridique'] ?? null,
            'dg'                  => $row['dg'] ?? null,
            'daf'                 => $row['daf'] ?? null,
            'directeur_juridique' => $row['directeur_juridique'] ?? null,
            'controle_interne'    => $row['controle_interne'] ?? null,
            'dsi'                 => $row['dsi'] ?? null,
            'ca'                  => $row['ca'] ?? null,
            'telephone_societe'   => $row['telephone_societe'] ?? null,
            'email_societe'       => $row['email_societe'] ?? null,
            'type'                => $type,
        ]);
    }
}
