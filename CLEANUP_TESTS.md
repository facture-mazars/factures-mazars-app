# Nettoyage des données de TEST uniquement

## ⚠️ IMPORTANT : NE PAS supprimer les données existantes !

Ce fichier permet de supprimer UNIQUEMENT les données créées pendant les tests, PAS les données qui existaient déjà.

## ÉTAPE 1 : Vérifier les données AVANT les tests

Avant de commencer vos tests, notez combien de données existent déjà :

### Connexion à la base de données en production

Dans votre terminal, exécutez cette commande :

```bash
PGPASSWORD='C97uavXT2ipv6Nq14Kw9pehfriq9PJxE' psql -h dpg-d3oetr3ipnbc73fumk10-a.oregon-postgres.render.com -U factures_mazars_user -d factures_mazars
```

Une fois connecté, vous pouvez exécuter les commandes SQL ci-dessous.

### Compter les données existantes

```sql
-- Vérifier le nombre d'enregistrements AVANT les tests
SELECT 'users' as table_name, COUNT(*) as count FROM users
UNION ALL
SELECT 'client', COUNT(*) FROM client
UNION ALL
SELECT 'chantier', COUNT(*) FROM chantier
UNION ALL
SELECT 'facture', COUNT(*) FROM facture
UNION ALL
SELECT 'tranche_facture', COUNT(*) FROM tranche_facture
UNION ALL
SELECT 'encaissement', COUNT(*) FROM encaissement
UNION ALL
SELECT 'budget', COUNT(*) FROM budget
UNION ALL
SELECT 'equipe', COUNT(*) FROM equipe
UNION ALL
SELECT 'type_mission', COUNT(*) FROM type_mission
UNION ALL
SELECT 'sous_type_mission', COUNT(*) FROM sous_type_mission
UNION ALL
SELECT 'societe', COUNT(*) FROM societe
UNION ALL
SELECT 'liste_personnel', COUNT(*) FROM liste_personnel;
```

**✅ Données AVANT les tests (DATE: 2025-01-17 20:30) :**
- client: **0**
- chantier: **0**
- facture: **0**
- tranche_facture: **0**
- encaissement: **0**
- budget: **0**
- equipe: **0**
- get_date: **0**
- type_mission: **5**
- sous_type_mission: **74**
- societe: **1**
- liste_personnel: **71**
- taux: **3**
- banques: **7** (données permanentes - NE PAS SUPPRIMER)

## ÉTAPE 2 : Débuter les tests

**Date et heure de début des tests : 2025-01-17 20:30:00 UTC**

Notez bien cette date/heure, on va supprimer tout ce qui a été créé APRÈS.

🚀 **VOUS POUVEZ MAINTENANT COMMENCER VOS TESTS !**

## ÉTAPE 3 : Après les tests, supprimer UNIQUEMENT les nouvelles données

**Copier-coller ces commandes dans psql ou pgAdmin :**

```sql
-- 1. Supprimer les encaissements créés pendant les tests
    DELETE FROM encaissement WHERE created_at >= '2025-01-17 20:30:00';

  -- 2. Supprimer facture_a_encaisser
  DELETE FROM facture_a_encaisser WHERE created_at >= '2025-01-17 20:30:00';

  -- 3. Supprimer les tranches de facture
  DELETE FROM tranche_facture WHERE created_at >= '2025-01-17 20:30:00';

  -- 4. Supprimer la table pivot facture_budget
  DELETE FROM facture_budget WHERE id_facture IN (
      SELECT id_facture FROM facture WHERE created_at >= '2025-01-17 20:30:00'
  );

  -- 5. Supprimer les factures
  DELETE FROM facture WHERE created_at >= '2025-01-17 20:30:00';

  -- 6. Supprimer les budgets
  DELETE FROM budget WHERE created_at >= '2025-01-17 20:30:00';

  -- 7. Supprimer total_budget (IMPORTANT : référence chantier)
  DELETE FROM total_budget WHERE created_at >= '2025-01-17 20:30:00';

  -- 8. Supprimer les équipes
  DELETE FROM equipe WHERE created_at >= '2025-01-17 20:30:00';

  -- 9. Supprimer les get_date
  DELETE FROM get_date WHERE created_at >= '2025-01-17 20:30:00';

  -- 10. Supprimer les choix de banque
  DELETE FROM choix_banque WHERE created_at >= '2025-01-17 20:30:00';

  -- 11. Supprimer les chantiers
  DELETE FROM chantier WHERE created_at >= '2025-01-17 20:30:00';

  -- 12. Supprimer les clients
  DELETE FROM client WHERE created_at >= '2025-01-17 20:30:00';



-- 11. NE PAS toucher aux configurations (type_mission, sous_type_mission, societe, liste_personnel, taux, banques)
-- Ces données existaient déjà et doivent être conservées
-- IMPORTANT : La table banques contient 7 banques permanentes à NE PAS supprimer
```

## Vérification après nettoyage

```sql
-- Vérifier combien de données il reste (devrait être identique à l'ÉTAPE 1)
SELECT 'budget' as table_name, COUNT(*) as count FROM budget
UNION ALL SELECT 'chantier', COUNT(*) FROM chantier
UNION ALL SELECT 'client', COUNT(*) FROM client
UNION ALL SELECT 'encaissement', COUNT(*) FROM encaissement
UNION ALL SELECT 'equipe', COUNT(*) FROM equipe
UNION ALL SELECT 'facture', COUNT(*) FROM facture
UNION ALL SELECT 'get_date', COUNT(*) FROM get_date
UNION ALL SELECT 'liste_personnel', COUNT(*) FROM liste_personnel
UNION ALL SELECT 'societe', COUNT(*) FROM societe
UNION ALL SELECT 'sous_type_mission', COUNT(*) FROM sous_type_mission
UNION ALL SELECT 'taux', COUNT(*) FROM taux
UNION ALL SELECT 'tranche_facture', COUNT(*) FROM tranche_facture
UNION ALL SELECT 'type_mission', COUNT(*) FROM type_mission
UNION ALL SELECT 'users', COUNT(*) FROM users
ORDER BY table_name;
```

**Résultats attendus (identiques à l'ÉTAPE 1) :**
- users: **3**
- client: **0**
- chantier: **0**
- facture: **0**
- tranche_facture: **0**
- encaissement: **0**
- budget: **0**
- equipe: **0**
- get_date: **0**
- type_mission: **5**
- sous_type_mission: **74**
- societe: **1**
- liste_personnel: **71**
- taux: **3**
- banques: **7**

---

**Dernière mise à jour**: 2025-01-17
