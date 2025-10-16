<?php

namespace App\Imports;


use App\Models\GetDate;
use App\Models\Client;
use App\Models\SousTypeMission;
use App\Models\Monnaie;
use Illuminate\Support\Facades\Log; 
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\chantier;
use Maatwebsite\Excel\Concerns\ToModel;

class ChantierImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $sous;

    public function __construct()
    {
        // Préchargement des sous-types de mission pour correspondance
        $this->sous = SousTypeMission::all()->pluck('id_sous_type_mission', 'types')->toArray();
    }
    
    public function model(array $row)
    {
        try {
            Log::info('Traitement de la ligne Excel', ['row' => $row]);
    
            $id_sous_mission = !empty($row['types']) ? ($this->sous[$row['types']] ?? null) : null;
            Log::info('Sous-type de mission trouvé', ['sous_type_mission' => $id_sous_mission ?: 'Non trouvé']);
    
            $clientId = $this->getClientIdByCode($row['code_client'] ?? null);
            Log::info('Code client', ['code_client' => $row['code_client'] ?? null]);
    
            if (!$clientId) {
                Log::warning('Client introuvable', ['code_client' => $row['code_client']]);
                return null; // Ignorer l'insertion pour cette ligne si le client est introuvable
            }

          
            $etat = isset($row['etat']) ? (bool)$row['etat'] : false; // Assurez-vous que c'est un booléen
             // Ajuster la valeur de dom_export
        $domExportValue = ($row['dom_export'] ?? null) === 'O' ? 'Domestique' : 'Export';

        $typeMissionId = null;
        if ($id_sous_mission) {
            $typeMissionId = SousTypeMission::where('id_sous_type_mission', $id_sous_mission)->value('id_type_mission');
        }



    // Si le type ou sous-type est introuvable, ajouter dans ancien_mission
    $ancienMission = null;
    if (!$typeMissionId && !$id_sous_mission) {
        $ancienMission = $row['types'];
        Log::info('Type de mission et sous-type introuvables, ajout dans ancien_mission', ['ancien_mission' => $ancienMission]);
    }

    
            $chantier = new Chantier([
                'id_client' => $clientId,
                'id_sous_type_mission' => $id_sous_mission,
                'id_type_mission' => $typeMissionId,
                'debut_exercice' => $this->parseDate($row['debut_exercice'] ?? null),
                'fin_exercice' => $this->parseDate($row['fin_exercice'] ?? null),
                'est_recurrent' => $this->parseBoolean($row['est_recurrent'] ?? null),
                'dom_export' => $domExportValue,
                'referant' => $row['referant'] ?? null,
                'est_refere' => $this->parseBoolean($row['est_refere'] ?? null),
                'lp_contrat' => $row['lp_contrat'] ?? null,
                'numero_lp_contrat' => $row['numero_lp_contrat'] ?? null,
                'date_lp_contrat' => $this->parseDate($row['date_lp_contrat'] ?? null),
                'bailleur' => $row['bailleur'] ?? null,
                'id_monnaie' => $this->getMonnaieId($row['id_monnaie'] ?? null),
                'origine_contrat' => $row['origine_contrat'] ?? null,
                'engagement_with_individuel' => $this->parseBoolean($row['engagement_with_individuel'] ?? null),
                'details_engagement_with_individuel' => $row['details_engagement_with_individuel'] ?? null,
                'engagement_with_other_mazars_entity' => $this->parseBoolean($row['engagement_with_other_mazars_entity'] ?? null),
                'details_engagement_with_other_mazars_entity' => $row['details_engagement_with_other_mazars_entity'] ?? null,
                'framework_agreement' => $this->parseBoolean($row['framework_agreement'] ?? null),
                'details_framework_agreement' => $row['details_framework_agreement'] ?? null,
                'etat' => $etat,
                'ancien_mission' => $ancienMission,
                'objet' => $row['objet'] ?? null,
                'date_cloture' => $this->parseDate($row['date_cloture'] ?? null),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            if (!$chantier->save()) {
                Log::error('Erreur lors de la sauvegarde du chantier', ['chantier' => $chantier->toArray()]);
            }
    
            // Insertion dans la table 'get_date'
            $getDate = new GetDate([
                'id_chantier' => $chantier->id_chantier,
                'reference_chantier' => $row['reference_chantier'] ?? null,
                'date_debut_intervention' => $this->parseDate($row['date_debut_intervention'] ?? null),
                'date_fin_intervention' => $this->parseDate($row['date_fin_intervention'] ?? null),
                'date_initialisation' => $this->parseDate($row['date_initialisation'] ?? null),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            if (!$getDate->save()) {
                Log::error('Erreur lors de la sauvegarde des dates du chantier', ['get_date' => $getDate->toArray()]);
            }
    
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'importation de la ligne', [
                'error' => $e->getMessage(),
                'row' => $row,
                'ligne' => $e->getLine(),
                'fichier' => $e->getFile(),
            ]);
        }
    }
    
    
    // Fonction pour convertir une chaîne de date en format date SQL ou retourner NULL
// Ajoutez cette méthode dans votre classe pour gérer la normalisation des dates
protected function parseDate($dateValue) {
    if (is_numeric($dateValue)) {
        // Conversion du nombre Excel en timestamp PHP
        return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue)->format('Y-m-d H:i:s');
    }

    // Pour les dates au format texte
    return $dateValue ? \Carbon\Carbon::createFromFormat('d/m/Y', $dateValue)->format('Y-m-d H:i:s') : null;

}
    
    private function parseDateDebutExercice($date)
{
    return !empty($date) ? \Carbon\Carbon::createFromFormat('d-M-y', $date)->format('Y-m-d') : null;
}

    // Fonction pour convertir un champ 'O'/'N' en booléen ou retourner NULL
    private function parseBoolean($value)
    {
        if (is_null($value)) {
            return null; // ou une valeur par défaut
        }
        return strtolower($value) === 'o' || $value === true;
    }
    
    // Récupérer l'ID du client via son code client ou retourner NULL
    private function getClientIdByCode($code_client)
    {
        if (empty($code_client)) {
            return null;
        }
        $client = Client::where('code_client', $code_client)->first();
        return $client ? $client->id_client : null;
    }
    
    // Récupérer l'ID du type de mission via son nom ou retourner NULL
    private function getMissionTypeId($type_mission)
    {
        if (empty($type_mission)) {
            return null;
        }
        $missionType = SousTypeMission::where('nom_type_mission', $type_mission)->first();
        return $missionType ? $missionType->id_type_mission : null;
    }
    
    // Récupérer l'ID d'une monnaie par défaut ou retourner NULL
    private function getMonnaieId($monnaie)
    {
        if (empty($monnaie)) {
            return null;
        }
        $monnaie = Monnaie::where('nom_monnaie', $monnaie)->first();
        return $monnaie ? $monnaie->id_monnaie : null;
    }


    private function getIdByField($model, $field, $value)
{
    if (empty($value)) {
        return null;
    }
    $record = $model::where($field, $value)->first();
    return $record ? $record->id : null;
}

    
}
