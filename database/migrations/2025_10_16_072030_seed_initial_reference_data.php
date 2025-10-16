<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pays
        DB::table('pays')->insertOrIgnore([
            ['nom_pays' => 'Madagascar'],
            ['nom_pays' => 'Maurice'],
            ['nom_pays' => 'Comores'],
        ]);

        // Secteurs d'activité
        $secteurs = [
            ['1.01', 'Asset management', 'Asset management'],
            ['1.02', 'Banking & capital markets', 'Banking'],
            ['1.03', 'Insurance', 'Insurance'],
            ['1.04', 'Real estate (Financial services)', 'Real estate'],
            ['2.01', 'Aerospace & defence', 'Mobility'],
            ['2.02', 'Automotive', 'Mobility'],
            ['2.03', 'Transport & logistics', 'Mobility'],
            ['3.01', 'Media', 'Technology, media & telecommunications'],
            ['3.02', 'Technology', 'Technology, media & telecommunications'],
            ['3.03', 'Telecommunications', 'Technology, media & telecommunications'],
            ['4.01', 'Consumer goods', 'Consumer'],
            ['4.02', 'Food & beverage', 'Consumer'],
            ['4.03', 'Hospitality & leisure (Consumer)', 'Consumer'],
            ['4.04', 'Luxury', 'Consumer'],
            ['4.05', 'Retail', 'Consumer'],
            ['5.01', 'Infrastructure & capital projects', 'Energy, infrastructure & environment'],
            ['5.02', 'Oil, gas & natural resources', 'Energy, infrastructure & environment'],
            ['5.03', 'Power & utilities', 'Energy, infrastructure & environment'],
            ['5.04', 'Renewable energy', 'Energy, infrastructure & environment'],
            ['5.05', 'Water & waste', 'Energy, infrastructure & environment'],
            ['6.01', 'Professional Services', 'Industry & services (others)'],
            ['6.02', 'Agribusiness', 'Industry & services (others)'],
            ['6.03', 'Chemicals & materials', 'Industry & services (others)'],
            ['6.04', 'Manufacturing', 'Industry & services (others)'],
            ['6.05', 'Healthcare', 'Industry & services (others)'],
            ['6.06', 'Pharmaceuticals & life science', 'Industry & services (others)'],
            ['7.01', 'Government', 'Public sector'],
            ['7.02', 'Not for profit', 'Public sector'],
            ['8.01', 'Construction', 'Real estate'],
            ['8.02', 'Hospitality & leisure (Real estate)', 'Real estate'],
            ['8.03', 'Property owners & users', 'Real estate'],
            ['8.04', 'Real estate funds & investment management', 'Real estate'],
            ['8.05', 'Social housing', 'Real estate'],
            ['9.01', 'Project', 'Project'],
            ['10.01', 'Other', 'Other'],
        ];

        foreach ($secteurs as $secteur) {
            DB::table('secteur_activite')->insertOrIgnore([
                'code_secteur' => $secteur[0],
                'nom_secteur_activite' => $secteur[1],
                'secteur_mazars' => $secteur[2],
            ]);
        }

        // Formes juridiques
        DB::table('forme_juridique')->insertOrIgnore([
            ['types' => 'SA'],
            ['types' => 'SARL'],
        ]);

        // Types de mission
        $typesMission = [
            ['code_mission' => 'A', 'types' => 'Audit'],
            ['code_mission' => 'B', 'types' => 'Conseil'],
            ['code_mission' => 'C', 'types' => 'Financial advisory'],
            ['code_mission' => 'D', 'types' => 'Fiscalité et juridique'],
            ['code_mission' => 'E', 'types' => 'AOS : Conseil comptable'],
        ];

        foreach ($typesMission as $tm) {
            DB::table('type_mission')->insertOrIgnore($tm);
        }

        // Sous-types de mission
        $sousTypesMission = [
            ['A01', 'Commissariat aux comptes', 1],
            ['A02', 'Audit', 1],
            ['A03', 'Audit technique', 1],
            ['A04', 'Audit RSE', 1],
            ['A05', 'Audit des fournisseurs', 1],
            ['A06', 'Audit des obligations vertes (Green Bonds)', 1],
            ['A07', 'Audit des obligations sociales (Social Bond)', 1],
            ['A08', 'Cartographie des systèmes d\'information', 1],
            ['A09', 'Cartographie des risques IT', 1],
            ['A10', 'Évaluation du contrôle interne IT', 1],
            ['A11', 'Due diligence IT', 1],
            ['A12', 'Data analytics / Process analytics', 1],
            ['A13', 'Revue / audit de projet IT', 1],
            ['A14', 'Accompagnement dans la mise en œuvre des référentiels et déploiement nouveaux principes comptables', 1],
            ['A15', 'Veille réglementaire personnalisée', 1],
            ['A16', 'Analyse des nouveaux textes et de leurs impacts', 1],
            ['A17', 'Formations (pratiques)', 1],
            ['B01', 'Management Consulting', 2],
            ['B02', 'Risk Consulting', 2],
            ['B03', 'Numérique Responsable', 2],
            ['B04', 'Conseil en analyse de données', 2],
            ['B05', 'Transformation des solutions d\'entreprise', 2],
            ['B06', 'Automatisation des processus', 2],
            ['B07', 'Conseil en stratégie et gouvernance des SI', 2],
            ['B08', 'Cybersécurité et protection des données', 2],
            ['C01', 'Cession d\'actifs', 3],
            ['C02', 'Conseil en matière de fusion acquisition', 3],
            ['C03', 'Due diligence', 3],
            ['C04', 'Evaluation d\'entreprise', 3],
            ['C05', 'Evaluation financière du projet', 3],
            ['C06', 'Marché des capitaux', 3],
            ['C07', 'Levée de fonds', 3],
            ['C08', 'Forensic investigations', 3],
            ['C09', 'Contentieux et Arbitrages', 3],
            ['C10', 'Restructuration et insolvabilité', 3],
            ['C11', 'Revue indépendante de l\'entreprise', 3],
            ['C12', 'Évaluations', 3],
            ['C13', 'Due diligence de tiers', 3],
            ['C14', 'Anti-corruption', 3],
            ['D01', 'Constitution/liquidation d\'une société', 4],
            ['D02', 'Elaboration de contrat commercial', 4],
            ['D03', 'Conformité juridique et règlementaire', 4],
            ['D04', 'Résolution de litiges', 4],
            ['D05', 'État des lieux international', 4],
            ['D06', 'Intégration d\'entités nationales ou étrangères', 4],
            ['D07', 'Procédures d\'enregistrement', 4],
            ['D08', 'Procès-verbaux', 4],
            ['D09', 'Tenue des registres légaux', 4],
            ['D10', 'Liquidation de structures', 4],
            ['D11', 'Conseil en secrétariat général', 4],
            ['D12', 'Prix de transfert', 4],
            ['D13', 'Conseils fiscaux', 4],
            ['D14', 'Conformité fiscale', 4],
            ['E01', 'Création d\'entreprise', 5],
            ['E02', 'Tenue de comptabilité et expertise comptable', 5],
            ['E03', 'Migration et la conversion des comptes', 5],
            ['E04', 'Externalisation des processus métier', 5],
            ['E05', 'Préparation des états financiers et autres services associés', 5],
            ['E06', 'Conversion de plan comptable', 5],
            ['E07', 'Rédaction des rapports de gestion', 5],
            ['E08', 'Consolidation des comptes pour les groupes', 5],
            ['E09', 'Comptabilité analytique et gestion de la performance', 5],
            ['E10', 'Conformité aux obligations de TVA et de fiscalité indirecte', 5],
            ['E11', 'Impôt sur les sociétés', 5],
            ['E12', 'Prix de transfert', 5],
            ['E13', 'Fiscalité patrimoniale', 5],
            ['E14', 'Accompagnement en cas de contrôles des autorités fiscales', 5],
            ['E15', 'Conseil en stratégie de conformité', 5],
            ['E16', 'Assistance comptable', 5],
            ['E17', 'Assistance à l\'élaboration de Reporting financier', 5],
            ['E18', 'Conformité réglementaire et fiscale', 5],
            ['E19', 'Audit interne et contrôle de gestion', 5],
            ['E20', 'Ressources humaines et recrutement', 5],
            ['E21', 'Paie', 5],
        ];

        foreach ($sousTypesMission as $stm) {
            DB::table('sous_type_mission')->insertOrIgnore([
                'code_sous_mission' => $stm[0],
                'types' => $stm[1],
                'id_type_mission' => $stm[2],
            ]);
        }

        // Monnaies
        DB::table('monnaie')->insertOrIgnore([
            ['nom_monnaie' => 'MGA'],
            ['nom_monnaie' => 'EURO'],
            ['nom_monnaie' => 'DOLLARS'],
        ]);

        // Grades
        $grades = ['Partner 1', 'Partner 2', 'Director', 'Senior Manager', 'Manager', 'Senior', 'Junior'];
        foreach ($grades as $grade) {
            DB::table('grade')->insertOrIgnore(['types' => $grade]);
        }

        // Personnel
        $personnel = [
            // Partners 1
            ['RABENORO', 'David', 1, '223', 'DVR'],
            ['RANDRIANARISOA', 'Frederic', 1, '225', 'FRE'],
            ['RAKOTOARIVONY', 'Mamilolona', 1, '187', 'MLR'],
            ['ANDRIANARIVELO', 'Faliniaina', 1, '280', 'ARF'],
            ['RAZAFINDRAMANANA', 'Domohina', 1, '279', 'DMR'],
            // Partners 2
            ['RABENORO', 'David', 2, '223', 'DVR'],
            ['RANDRIANARISOA', 'Frederic', 2, '225', 'FRE'],
            ['RAKOTOARIVONY', 'Mamilolona', 2, '187', 'MLR'],
            ['ANDRIANARIVELO', 'Faliniaina', 2, '280', 'ARF'],
            ['RAZAFINDRAMANANA', 'Domohina', 2, '279', 'DMR'],
            // Directors
            ['HAJARIVONY', 'Lora Elmiora', 3, '309', null],
            ['RANAIVOSON', 'Willy Parfait', 3, '290', null],
            ['RABEMANANTSOA', 'Eric', 3, '311', null],
            // Senior Managers
            ['RAMIAKAMANANA', 'Voahirana', 4, '206', null],
            ['ANDRIANARINOSY', 'Robiarivelo Mamy', 4, '257', null],
            ['RASOLOARISON', 'Andry Tojoniaina', 4, '382', null],
            ['RAVELOSON', 'Judith', 4, '337', null],
            ['RAMANGALAHY', 'Josiane', 4, '256', null],
            ['RANAIVOARINDAZA', 'Willy Geosther', 4, '322', null],
            ['RABEHARISOA', 'Hasimamy Radaniela', 4, '418', null],
            // Managers
            ['RAHARIJAONA', 'Patricia', 5, '262', null],
            ['RABEMANANJARA', 'Heriniaina Fanoharana', 5, '393', null],
            ['RAMINOSOA', 'Filamatra', 5, '403', null],
            ['RANOROHANITRA', 'Isabelle', 5, '400', null],
            ['RAKOTONINDRINA', 'Lazasoa Avotra', 5, '417', null],
            ['ANDRIANARIMIADASON', 'Kiady', 5, '428', null],
            ['RAZAFIARISOA', 'Beby Harisoa', 5, '433', null],
            ['RATAHIRINTSOA', 'Sitraka Herilalaina', 5, '391', null],
            ['RANAIVOARIVELO', 'Maminirina', 5, '423', null],
            // Seniors
            ['RAZAFIARIVELONORO', 'Eleonore', 6, '188', null],
            ['RASOLOFONJATOVO', 'Hariliva', 6, '321', null],
            ['RANDRANTOMANANTSOA', 'Andriamifidy', 6, '378', null],
            ['RANDRIANARISON', 'Hasina Tanteliniaina', 6, '424', null],
            ['ANDONIAINA', 'Najoro Germaine', 6, '466', null],
            ['ANDRIANAJA', 'Iska Persy', 6, '457', null],
            ['RASOLOFOANDRIAMPANANA', 'Felana Miarisoa', 6, '471', null],
            ['RANDRIAMAHEFA', 'Tefialivelo', 6, '462', null],
            ['RAZAFIMAHEFA', 'Henintsoa Jocelyn', 6, '461', null],
            ['TSARAZAKA', 'Roddy', 6, '484', null],
            ['FANOMEZANIAINA', 'Fanirintsoa Sarobidy', 6, '488', null],
            ['ANDRIANARIJAONA', 'Anna', 6, '498', null],
            // Juniors
            ['ANDRIANIAINA', 'Barthelemy', 7, '465', null],
            ['RAKOTONIMARO', 'Manampy Tiana Michelle', 7, '472', null],
            ['ANDONJARAMANANA', 'Nambinintsoa Anita Sidaunie', 7, '469', null],
            ['RAKOTOMALALA', 'Nano Naina', 7, '499', null],
            ['RAKOTONIAINA', 'Fiderana Nirina', 7, '600', null],
            ['ANDRIANIRINA', 'Iaina Fanomezantsoa', 7, '610', null],
            ['ANDRIANTSIRESY RATSIMBA', 'Daniel Remi', 7, '611', null],
            ['RAKOTOARIJAONA', 'Tantely Hobiniana', 7, '612', null],
            ['VOLAMANGANIRINA', 'Julia Sandrah', 7, '614', null],
            ['MIARINAMBININA', 'Mendrika Fanantenana', 7, '617', null],
            ['RAKOTONIAINA', 'Sonia Tiana Daniella', 7, '622', null],
            ['MBOLATIANA', 'Famenontsoa Mampianina', 7, '624', null],
            ['RAZAFINDRAHAGA', 'Faniry Sarobidy', 7, '629', null],
            ['RANDRIARINIAINA', 'Kanto Tiantsoa Valeria', 7, '631', null],
            ['RAMILIARIJAONA', 'Mika Heritovo', 7, '632', null],
            ['RANDRIANARISOA', 'Jean Delphin', 7, '633', null],
            ['MAHAVITA', 'Ranaivoharimanga Sanda', 7, '634', null],
            ['ANDRIAMAHEFA', 'Natolotra Sarobidy', 7, '636', null],
            ['ANDRIANANTENAINA', 'Zo Hasina', 7, '637', null],
            ['RANDRIANARIVONY', 'Lovatiana Herisoa', 7, '640', null],
            ['RANDRIAMANANTENA', 'Tolotriniaina', 7, '641', null],
            ['RATOVOARIMANANA', 'Ranto Fortensky', 7, '642', null],
            ['RAZANAKOLONA', 'Miora Henintsoa', 7, '643', null],
            ['BEVIAVY', 'Yonah', 7, '645', null],
            ['SOLOFOARIJAONA', 'Tanjomaharavo Christian', 7, '646', null],
            ['RAFANOMEZANTSOA', 'Maminirina Tojosoa', 7, '647', null],
            ['RAKOTONDRAZAFY', 'Miaina Fitia Lucas', 7, '648', null],
            ['ILOTSIVERIHASINAMANDRAIVONONA', 'Safidy Andrianofy', 7, '649', null],
            ['ANDRIAMIALY', 'Avotra Sandro', 7, '651', null],
            ['RAMANANTSITOHAINA', 'Njakarinoro Rodstilere', 7, '652', null],
        ];

        foreach ($personnel as $p) {
            DB::table('liste_personnel')->insertOrIgnore([
                'nom' => $p[0],
                'prenom' => $p[1],
                'id_grade' => $p[2],
                'matricule' => $p[3],
                'actif' => true,
                'trigramme' => $p[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Taux
        DB::table('taux')->insertOrIgnore([
            ['types' => 'TVA', 'pourcentage' => 20],
            ['types' => 'IMP', 'pourcentage' => 8],
            ['types' => 'TRE', 'pourcentage' => 10],
        ]);

        // Société
        DB::table('societe')->insertOrIgnore([
            'nom_societe' => 'Forvis Mazars',
            'rue' => '13 Rue Patrice Lumumba',
            'addresse' => 'Tsaralalàna 101 Antananarivo',
            'email' => 'cabfiv@moov.mg',
            'raison_sociale' => 'Cabinet Mazars Fivoarana',
            'n_is' => '69202 11 1976 0 10005',
            'n_if' => '4000000992',
            'n_cif' => '0241662 / DGI - L',
            'telephone' => '+261 20 76 219 25 / 261 20 76 661 61',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ne rien faire dans le down pour préserver les données de référence
        // ou supprimer les données si nécessaire
    }
};
