<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_barometre AS
            SELECT
                chantier.id_chantier,
                get_date.reference_chantier,
                get_date.date_initialisation,
                client.nom_client,
                sous_type_mission.types AS sous_type_mission,
                total_budget.total_jour_homme,
                total_budget.total_global,
                total_budget.taux_moyen,
                TO_CHAR(
                    COALESCE(tranche_facture.date_reel_fac, tranche_facture.date_prevision_facture),
                    'Mon YY'
                ) AS mois_annee_facture,
                SUM(
                    tranche_facture.montant_honoraire + tranche_facture.montant_debours +
                    CASE
                        WHEN tranche_facture.id_taux IS NOT NULL THEN (tranche_facture.montant_honoraire * taux.pourcentage / 100)
                        ELSE 0
                    END
                ) AS total_facture
            FROM
                chantier
            JOIN
                get_date ON chantier.id_chantier = get_date.id_chantier
            JOIN
                client ON chantier.id_client = client.id_client
            JOIN
                sous_type_mission ON chantier.id_sous_type_mission = sous_type_mission.id_sous_type_mission
            LEFT JOIN
                total_budget ON chantier.id_chantier = total_budget.id_chantier
            LEFT JOIN
                facture ON chantier.id_chantier = facture.id_chantier
            LEFT JOIN
                tranche_facture ON facture.id_facture = tranche_facture.id_facture
            LEFT JOIN
                taux ON tranche_facture.id_taux = taux.id_taux
            WHERE total_budget.total_global IS NOT NULL
            GROUP BY
                chantier.id_chantier,
                get_date.reference_chantier,
                get_date.date_initialisation,
                client.nom_client,
                sous_type_mission.types,
                total_budget.total_jour_homme,
                total_budget.total_global,
                total_budget.taux_moyen,
                mois_annee_facture
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_barometre");
    }
};
