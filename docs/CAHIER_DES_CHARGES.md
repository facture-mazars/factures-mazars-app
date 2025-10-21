# CAHIER DES CHARGES
## Application de Gestion de Factures

---

- **Document** - Détails : Cahier des Charges Fonctionnel et Technique
- **Projet** - Détails : Application de Gestion de Factures Mazars
- **Client** - Détails : Cabinet Mazars (Conseil et Audit)
- **Version** - Détails : 2.0
- **Date de publication** - Détails : Janvier 2025
- **Statut** - Détails : ✅ Production
- **Plateforme** - Détails : https://factures-mazars-app.onrender.com/
- **Chef de projet** - Détails : Gershom Ny Aina Fitia
- **Propriété intellectuelle** - Détails : Cabinet Mazars - Reproduction interdite sans autorisation


---

## TABLE DES MATIÈRES

1. [INTRODUCTION](#1-introduction)
   - 1.1 [Objet du document](#11-objet-du-document)
   - 1.2 [Périmètre du projet](#12-périmètre-du-projet)
   - 1.3 [Définitions et acronymes](#13-définitions-et-acronymes)

2. [PRÉSENTATION GÉNÉRALE](#2-présentation-générale)
   - 2.1 [Contexte du projet](#21-contexte-du-projet)
   - 2.2 [Objectifs stratégiques](#22-objectifs-stratégiques)
   - 2.3 [Utilisateurs cibles](#23-utilisateurs-cibles)
   - 2.4 [Bénéfices attendus](#24-bénéfices-attendus)

3. [PROCESSUS MÉTIER](#3-processus-métier)
   - 3.1 [Workflow global](#31-workflow-global)
   - 3.2 [Description détaillée des étapes](#32-description-détaillée-des-étapes)
   - 3.3 [Règles de gestion](#33-règles-de-gestion)

4. [EXIGENCES FONCTIONNELLES](#4-exigences-fonctionnelles)
   - 4.1 [Module Gestion des Clients](#41-module-gestion-des-clients)
   - 4.2 [Module Gestion des Chantiers](#42-module-gestion-des-chantiers)
   - 4.3 [Module Facturation](#43-module-facturation)
   - 4.4 [Module Tranches de Facture](#44-module-tranches-de-facture)
   - 4.5 [Module Encaissement](#45-module-encaissement)
   - 4.6 [Module Reporting et Tableaux de Bord](#46-module-reporting-et-tableaux-de-bord)
   - 4.7 [Module Paramètres et Configuration](#47-module-paramètres-et-configuration)
   - 4.8 [Module Import/Export](#48-module-importexport)
   - 4.9 [Module Authentification et Sécurité](#49-module-authentification-et-sécurité)

5. [AUTOMATISATIONS ET VALIDATIONS](#5-automatisations-et-validations)
   - 5.1 [Automatisations métier](#51-automatisations-métier)
   - 5.2 [Validations et contrôles](#52-validations-et-contrôles)
   - 5.3 [Alertes et notifications](#53-alertes-et-notifications)

6. [ARCHITECTURE TECHNIQUE](#6-architecture-technique)
   - 6.1 [Stack technologique](#61-stack-technologique)
   - 6.2 [Architecture applicative](#62-architecture-applicative)
   - 6.3 [Modèle de données](#63-modèle-de-données)
   - 6.4 [Conventions et standards](#64-conventions-et-standards)

7. [EXIGENCES NON FONCTIONNELLES](#7-exigences-non-fonctionnelles)
   - 7.1 [Performance](#71-performance)
   - 7.2 [Scalabilité](#72-scalabilité)
   - 7.3 [Disponibilité et continuité](#73-disponibilité-et-continuité)
   - 7.4 [Compatibilité](#74-compatibilité)
   - 7.5 [Ergonomie et expérience utilisateur](#75-ergonomie-et-expérience-utilisateur)

8. [SÉCURITÉ ET CONFORMITÉ](#8-sécurité-et-conformité)
   - 8.1 [Authentification et autorisation](#81-authentification-et-autorisation)
   - 8.2 [Protection des données](#82-protection-des-données)
   - 8.3 [Sécurisation des communications](#83-sécurisation-des-communications)
   - 8.4 [Conformité réglementaire](#84-conformité-réglementaire)

9. [DÉPLOIEMENT ET INFRASTRUCTURE](#9-déploiement-et-infrastructure)
   - 9.1 [Environnement de production](#91-environnement-de-production)
   - 9.2 [Configuration et paramétrage](#92-configuration-et-paramétrage)
   - 9.3 [Sauvegarde et restauration](#93-sauvegarde-et-restauration)
   - 9.4 [Monitoring et supervision](#94-monitoring-et-supervision)

10. [MAINTENANCE ET ÉVOLUTION](#10-maintenance-et-évolution)
    - 10.1 [Maintenance préventive](#101-maintenance-préventive)
    - 10.2 [Procédures d'urgence](#102-procédures-durgence)
    - 10.3 [Évolutions planifiées](#103-évolutions-planifiées)
    - 10.4 [Roadmap](#104-roadmap)

11. [VALIDATION ET RECETTE](#11-validation-et-recette)
    - 11.1 [Critères de validation technique](#111-critères-de-validation-technique)
    - 11.2 [Critères de validation fonctionnelle](#112-critères-de-validation-fonctionnelle)
    - 11.3 [Tests et métriques](#113-tests-et-métriques)

12. [DOCUMENTATION ET SUPPORT](#12-documentation-et-support)
    - 12.1 [Documentation fournie](#121-documentation-fournie)
    - 12.2 [Support et contacts](#122-support-et-contacts)

13. [ANNEXES](#13-annexes)
    - 13.1 [Glossaire métier](#131-glossaire-métier)
    - 13.2 [Périmètre exclu](#132-périmètre-exclu)

---

## 1. INTRODUCTION

### 1.1 Objet du document

Ce cahier des charges définit l'ensemble des spécifications fonctionnelles et techniques de l'**Application de Gestion de Factures** développée pour le Cabinet Mazars. Il constitue le document de référence pour :

- La compréhension du périmètre et des objectifs du projet
- L'exploitation et la maintenance de l'application en production
- Les évolutions et améliorations futures
- La formation des utilisateurs et administrateurs

### 1.2 Périmètre du projet

L'application couvre l'intégralité du cycle de facturation, depuis la création d'un client jusqu'à la clôture automatique des missions après encaissement complet. Elle comprend :

- **Gestion commerciale** - Périmètre inclus : Clients, missions (chantiers), types de missions
- **Gestion de projet** - Périmètre inclus : Équipes, budgets, planning, suivi d'avancement
- **Facturation** - Périmètre inclus : Création factures, tranches de paiement, débours
- **Encaissement** - Périmètre inclus : Paiements (chèque, virement, espèces, carte), banques
- **Reporting** - Périmètre inclus : Dashboard, baromètre annuel, analyses sectorielles
- **Administration** - Périmètre inclus : Paramètres, import Excel, utilisateurs, sécurité


### 1.3 Définitions et acronymes

- **Chantier** - Définition : Synonyme de Mission - Projet réalisé pour un client
- **Débours** - Définition : Frais engagés pour la mission (décaissables ou non décaissables)
- **Encaissement** - Définition : Paiement reçu pour une tranche de facture
- **Recouvrement** - Définition : Action de recevoir le paiement d'une facture
- **Tranche** - Définition : Division d'une facture en plusieurs paiements échelonnés
- **Honoraires** - Définition : Rémunération du cabinet pour la prestation
- **Jours/homme** - Définition : Nombre de jours de travail d'une personne sur une mission
- **Taux journalier** - Définition : Tarif facturé par jour et par personne
- **Baromètre** - Définition : Tableau de bord récapitulatif annuel de la facturation
- **Code client** - Définition : Identifiant unique généré automatiquement (ex: U00001)
- **Référence chantier** - Définition : Identifiant unique d'une mission (ex: O00002A131025)
- **Statut** - Définition : État d'avancement (0=En cours/Non payé, 1=Partiel, 2=Terminé/Payé)
- **Eager Loading** - Définition : Chargement optimisé des relations (évite le problème N+1)
- **Soft Delete** - Définition : Suppression logique (marquer `actif = false` au lieu de DELETE)
- **CRUD** - Définition : Create, Read, Update, Delete (opérations de base)
- **ORM** - Définition : Object-Relational Mapping (Eloquent pour Laravel)
- **MVC** - Définition : Model-View-Controller (pattern architectural)
- **CSRF** - Définition : Cross-Site Request Forgery (attaque de sécurité)
- **XSS** - Définition : Cross-Site Scripting (attaque de sécurité)
- **SSL** - Définition : Secure Sockets Layer (chiffrement HTTPS)


---

## 2. PRÉSENTATION GÉNÉRALE

### 2.1 Contexte du projet

Le Cabinet Mazars, acteur majeur du conseil et de l'audit, gérait précédemment ses factures de manière manuelle ou avec des outils bureautiques dispersés (Excel, Word). Cette approche présentait plusieurs limites :

- **Problématique** : Saisie manuelle répétitive - Impact : Temps administratif élevé, risques d'erreurs de calcul
- **Problématique** : Données dispersées - Impact : Difficulté de consolidation, pas de vision globale
- **Problématique** : Calculs manuels - Impact : Erreurs fréquentes sur les taux, totaux, taxes
- **Problématique** : Pas de traçabilité - Impact : Difficulté à auditer, à suivre l'historique
- **Problématique** : Reporting limité - Impact : Tableaux Excel statiques, pas d'analyses avancées
- **Problématique** : Suivi des paiements complexe - Impact : Relances manuelles, retards de recouvrement


L'application a été conçue pour répondre à ces problématiques en automatisant l'ensemble du processus de facturation et en centralisant toutes les données dans une solution web moderne.

### 2.2 Objectifs stratégiques

- **1. Automatiser** - Description : Éliminer les tâches manuelles répétitives - Indicateur de réussite : Réduction de 70% du temps administratif
- **2. Fiabiliser** - Description : Supprimer les erreurs de calcul humaines - Indicateur de réussite : 0 erreur de calcul sur factures émises
- **3. Centraliser** - Description : Regrouper toutes les données dans un système unique - Indicateur de réussite : 100% des données accessibles en un clic
- **4. Tracer** - Description : Historiser toutes les opérations pour audit - Indicateur de réussite : Logs complets sur toutes les actions sensibles
- **5. Alerter** - Description : Notifier proactivement sur échéances importantes - Indicateur de réussite : Alertes 7 jours avant dates critiques
- **6. Analyser** - Description : Fournir des rapports et statistiques avancés - Indicateur de réussite : Dashboard temps réel + baromètre annuel
- **7. Optimiser** - Description : Améliorer l'efficacité opérationnelle globale - Indicateur de réussite : ROI positif dès 6 mois d'utilisation


### 2.3 Utilisateurs cibles

L'application distingue deux profils utilisateurs avec des droits différenciés :

#### 2.3.1 Administrateurs (Utilisateurs Standard)

- **Profil** - Détails : Personnel administratif, comptables, responsables facturation
- **Accès** - Détails : Complet sur toutes les fonctionnalités
- **Droits** - Détails : Création, modification, suppression (CRUD complet)
- **Fonctions exclusives** - Détails : Accès aux paramètres, imports Excel, génération rapports complets
- **Nombre estimé** - Détails : 5 à 10 utilisateurs
- **Création de compte** - Détails : Manuelle par administrateur existant


#### 2.3.2 Consultants

- **Profil** - Détails : Consultants métier, auditeurs en mission
- **Accès** - Détails : Lecture seule (consultation uniquement)
- **Droits** - Détails : Aucune modification, suppression ou création
- **Fonctions accessibles** - Détails : Dashboard limité, consultation clients/chantiers/factures
- **Fonctions exclues** - Détails : Paramètres, imports, modifications
- **Nombre estimé** - Détails : 20 à 50 utilisateurs
- **Création de compte** - Détails : Auto-inscription (devient automatiquement Consultant)


**Règle importante** : Toute nouvelle inscription crée automatiquement un compte Consultant. Seul un administrateur existant peut promouvoir un utilisateur au rôle Administrateur.

### 2.4 Bénéfices attendus

- **Productivité** - Bénéfice : Réduction de 70% du temps de traitement des factures
- **Qualité** - Bénéfice : Élimination des erreurs de calcul (0 erreur)
- **Visibilité** - Bénéfice : Accès temps réel aux indicateurs clés (CA, recouvrement)
- **Conformité** - Bénéfice : Traçabilité complète pour audits internes/externes
- **Recouvrement** - Bénéfice : Réduction du délai moyen d'encaissement de 15 jours
- **Satisfaction client** - Bénéfice : Factures professionnelles, émission plus rapide


---

## 3. PROCESSUS MÉTIER

### 3.1 Workflow global

Le processus de facturation se décompose en **10 étapes séquentielles** obligatoires :

```
┌─────────────────────────────────────────────────────────────┐
│                    PROCESSUS DE FACTURATION                 │
└─────────────────────────────────────────────────────────────┘

ÉTAPE 1 : CRÉATION CLIENT
   │  → Saisie informations client (nom, forme juridique, secteur, zone)
   │  → Génération automatique code client (U00001, V00001, etc.)
   ▼
ÉTAPE 2 : CRÉATION CHANTIER (Mission)
   │  → Sélection client existant
   │  → Définition type et sous-type de mission
   │  → Génération automatique référence chantier (O00002A131025)
   ▼
ÉTAPE 3 : DÉFINITION DES DATES
   │  → Date d'initialisation du chantier
   │  → Date de fin prévue
   │  → Stockage dans table `get_date`
   ▼
ÉTAPE 4 : AFFECTATION DE L'ÉQUIPE
   │  → Sélection du personnel (par trigramme)
   │  → Attribution des grades (Associé, Manager, Senior, etc.)
   │  → Création des enregistrements dans table `equipe`
   ▼
ÉTAPE 5 : BUDGÉTISATION
   │  → Saisie nombre de jours/homme par membre d'équipe
   │  → Saisie du taux journalier
   │  → Calcul automatique : Honoraires = Jours × Taux
   │  → Stockage dans table `budget` et agrégation dans `total_budget`
   ▼
ÉTAPE 6 : CRÉATION FACTURE
   │  → Sélection du chantier
   │  → Saisie débours décaissables et non décaissables
   │  → Association aux budgets concernés (table pivot `facture_budget`)
   │  → Génération automatique numéro facture (FACT-2025-00001)
   ▼
ÉTAPE 7 : CRÉATION TRANCHES DE PAIEMENT
   │  → Définition du nombre de tranches (1 à N)
   │  → Répartition des taux (honoraires et débours)
   │  → VALIDATION : Somme des taux = 100% OBLIGATOIRE
   │  → Calcul automatique des montants par tranche
   │  → Saisie dates prévisionnelles (émission, recouvrement)
   ▼
ÉTAPE 8 : CHOIX DE LA BANQUE
   │  → Sélection de la banque émettrice
   │  → Association à la facture (table `choix_banque`)
   ▼
ÉTAPE 9 : ENCAISSEMENT DES PAIEMENTS
   │  → Sélection de la tranche concernée
   │  → Saisie mode de paiement (chèque, virement, espèces, carte)
   │  → Si chèque : numéro, type, banque
   │  → Dates d'encaissement (probable et réel)
   │  → Enregistrement dans table `encaissement`
   │  → MISE À JOUR AUTOMATIQUE : Statut tranche → Statut facture
   ▼
ÉTAPE 10 : CLÔTURE AUTOMATIQUE
   │  → Si toutes les tranches d'une facture sont payées :
   │     ✓ Facture.etat = 2 (Totalement payé)
   │  → Si toutes les factures d'un chantier sont payées :
   │     ✓ Chantier.statut_completion = 'complet'
   │     ✓ Chantier.etat = false (Terminé)
   └──────────────────────────────────────────────────────────┘
```

### 3.2 Description détaillée des étapes

#### ÉTAPE 1 : Création Client

- **Qui** - Détails : Administrateur
- **Formulaire** - Détails : `/clients/create`
- **Données requises** - Détails : Nom, forme juridique, secteur activité, pays, zone géographique
- **Données optionnelles** - Détails : Adresse, téléphone, email, notes
- **Automatisme** - Détails : Génération code client basé sur première lettre du nom + incrémentation
- **Exemple** - Détails : Client "Unilever" → Code "U00001"
- **Validation** - Détails : Code client unique (contrainte base de données)


#### ÉTAPE 2 : Création Chantier

- **Qui** - Détails : Administrateur
- **Formulaire** - Détails : `/chantiers/create` (processus guidé en 8 sous-étapes)
- **Données requises** - Détails : Client, type mission, sous-type mission, monnaie
- **Automatisme** - Détails : Génération référence chantier (format : O + numéro + code trigramme + date)
- **Exemple** - Détails : Chantier #2 par consultant OKA le 13/10/2025 → "O00002A131025"
- **Statut initial** - Détails : `statut_completion = 'en_cours'`, `etat = true` (actif)


#### ÉTAPE 3 : Définition des Dates

- **Qui** - Détails : Administrateur (intégré dans création chantier)
- **Données requises** - Détails : Date d'initialisation, date de fin prévue
- **Stockage** - Détails : Table `get_date` (relation 1:1 avec chantier)
- **Validation** - Détails : Date fin > Date initialisation


#### ÉTAPE 4 : Affectation Équipe

- **Qui** - Détails : Administrateur
- **Sélection personnel** - Détails : Via trigramme (3 lettres majuscules, ex: OKA, MAR)
- **Attribution grade** - Détails : Associé, Manager, Senior, Junior, Consultant, Stagiaire
- **Multi-personnel** - Détails : Possibilité d'affecter plusieurs personnes au même chantier
- **Stockage** - Détails : Table `equipe` (relation N:N entre chantier et personnel)


#### ÉTAPE 5 : Budgétisation

- **Qui** - Détails : Administrateur
- **Saisie par membre** - Détails : Nombre de jours/homme + taux journalier
- **Calcul automatique** - Détails : `Total = nb_jour_homme × taux`
- **Support décimal** - Détails : Saisie avec virgule (ex: 2,5 jours) automatiquement converti en point
- **Agrégation** - Détails : Table `total_budget` cumule tous les budgets du chantier
- **Stockage** - Détails : Table `budget` (un enregistrement par membre d'équipe)


#### ÉTAPE 6 : Création Facture

- **Qui** - Détails : Administrateur
- **Formulaire** - Détails : `/factures/create`
- **Données requises** - Détails : Chantier, débours décaissables, débours non décaissables
- **Données optionnelles** - Détails : Notes, observations
- **Automatisme** - Détails : Génération numéro facture (FACT-YYYY-NNNNN)
- **Exemple** - Détails : Première facture 2025 → "FACT-2025-00001"
- **Statut initial** - Détails : `etat = 0` (Non payé), `nb_tranche_facture = 0` (mis à jour après création tranches)
- **Association budgets** - Détails : Liaison via table pivot `facture_budget`


#### ÉTAPE 7 : Création Tranches de Paiement

- **Qui** - Détails : Administrateur
- **Nombre de tranches** - Détails : Défini lors de la création (1 à N tranches)
- **Saisie par tranche** - Détails : - Nom de la tranche (ex: "Acompte 1", "Solde")<br>- Taux honoraire (%)<br>- Taux débours (%)<br>- Date prévision facture<br>- Date prévision recouvrement
- **Calculs automatiques** - Détails : - `montant_honoraire = (taux_honoraire × total_budget) / 100`<br>- `montant_debours = (taux_debours × débours_total) / 100`
- **Validation stricte** - Détails : **OBLIGATOIRE** : `Σ(taux_honoraire) = 100%` ET `Σ(taux_debours) = 100%`
- **Assistance saisie** - Détails : Dernière tranche calculée automatiquement pour atteindre 100%
- **Statut initial** - Détails : `etat = false` (Non payé)
- **Validation JavaScript** - Détails : Contrôle temps réel de la somme des taux (bloque soumission si ≠ 100%)


**Exemple de répartition :**
```
Facture de 10 000 € HT + 2 000 € de débours
Répartition en 3 tranches :

Tranche 1 "Acompte 30%" :
  - Taux honoraire : 30% → Montant : 3 000 €
  - Taux débours : 0% → Montant : 0 €

Tranche 2 "Acompte 40%" :
  - Taux honoraire : 40% → Montant : 4 000 €
  - Taux débours : 50% → Montant : 1 000 €

Tranche 3 "Solde" :
  - Taux honoraire : 30% → Montant : 3 000 €
  - Taux débours : 50% → Montant : 1 000 €

TOTAL : 100% + 100% ✓
```

#### ÉTAPE 8 : Choix de la Banque

- **Qui** - Détails : Administrateur
- **Formulaire** - Détails : `/factures/{id}/banque`
- **Sélection** - Détails : Banque émettrice de la facture (liste paramétrée)
- **Stockage** - Détails : Table `choix_banque` (relation 1:1 avec facture)
- **Utilisation** - Détails : Apparaît sur PDF de facture généré


#### ÉTAPE 9 : Encaissement des Paiements

- **Qui** - Détails : Administrateur
- **Formulaire** - Détails : `/encaissements/create`
- **Sélection tranche** - Détails : Choix de la tranche à encaisser
- **Mode de paiement** - Détails : Chèque, Virement, Espèces, Carte bancaire
- **Si mode = Chèque** - Détails : - Numéro de chèque<br>- Type de chèque (liste paramétrée)<br>- Banque du chèque
- **Dates** - Détails : - Date encaissement probable<br>- Date encaissement réel
- **Automatisme critique** - Détails : **Méthode `Facture::updateFactureStatus()`** déclenchée :<br><br>1. Compte les tranches payées de la facture<br>2. Si 0 tranches payées → `Facture.etat = 0`<br>3. Si toutes tranches payées → `Facture.etat = 2`<br>4. Sinon → `Facture.etat = 1` (Partiel)<br>5. Si toutes factures du chantier payées → Clôture chantier
- **Traçabilité** - Détails : Chaque encaissement enregistré avec horodatage (created_at)


**Code de la méthode critique (extrait) :**
```php
public function updateFactureStatus()
{
    $tranches = $this->tranches;
    $totalTranches = $tranches->count();
    $tranchesPayees = $tranches->where('etat', true)->count();

    if ($tranchesPayees == 0) {
        $this->etat = 0;  // Non payé
    } elseif ($tranchesPayees == $totalTranches) {
        $this->etat = 2;  // Totalement payé

        // Vérifier si toutes les factures du chantier sont payées
        $chantier = $this->chantier;
        $toutesFacturesPayees = $chantier->factures->every(function($facture) {
            return $facture->etat == 2;
        });

        if ($toutesFacturesPayees) {
            $chantier->statut_completion = 'complet';
            $chantier->etat = false;
            $chantier->save();
        }
    } else {
        $this->etat = 1;  // Partiellement payé
    }

    $this->save();
}
```

#### ÉTAPE 10 : Clôture Automatique

Cette étape est entièrement automatique et déclenchée par `updateFactureStatus()` :

- **Condition** : Toutes tranches d'une facture payées - Action automatique : `Facture.etat = 2` (Totalement payé)
- **Condition** : Toutes factures d'un chantier payées - Action automatique : `Chantier.statut_completion = 'complet'`<br>`Chantier.etat = false` (Terminé)
- **Condition** : Aucune intervention manuelle - Action automatique : Garantit la cohérence des statuts en temps réel


### 3.3 Règles de gestion

#### Règles de validation

- **RG-001** - Description : Le code client doit être unique - Niveau de blocage : BLOQUANT (contrainte BDD)
- **RG-002** - Description : La référence chantier doit être unique - Niveau de blocage : BLOQUANT (contrainte BDD)
- **RG-003** - Description : Un chantier doit être rattaché à un client existant - Niveau de blocage : BLOQUANT (clé étrangère)
- **RG-004** - Description : Une facture doit être rattachée à un chantier existant - Niveau de blocage : BLOQUANT (clé étrangère)
- **RG-005** - Description : La somme des taux_honoraire de toutes les tranches = 100% - Niveau de blocage : BLOQUANT (validation JS + PHP)
- **RG-006** - Description : La somme des taux_debours de toutes les tranches = 100% - Niveau de blocage : BLOQUANT (validation JS + PHP)
- **RG-007** - Description : Les montants doivent être positifs ou nuls - Niveau de blocage : BLOQUANT (validation PHP)
- **RG-008** - Description : La date de fin prévue doit être >= date initialisation - Niveau de blocage : AVERTISSEMENT
- **RG-009** - Description : Un encaissement ne peut être créé que sur une tranche non payée - Niveau de blocage : BLOQUANT
- **RG-010** - Description : Le trigramme du personnel doit être unique - Niveau de blocage : BLOQUANT (contrainte BDD)


#### Règles de calcul

- **RC-001** - Formule : Budget total = Σ(nb_jour_homme × taux) pour tous les membres d'équipe
- **RC-002** - Formule : Montant honoraire tranche = (taux_honoraire × budget_total) / 100
- **RC-003** - Formule : Montant débours tranche = (taux_debours × débours_total) / 100
- **RC-004** - Formule : Montant total facture = budget_total + débours_décaissables + débours_non_décaissables
- **RC-005** - Formule : TVA = (montant_honoraire + montant_debours) × taux_TVA
- **RC-006** - Formule : IMP = montant_honoraire × taux_IMP


#### Règles de statut

- **Facture : Non payé** - Valeur : `etat = 0` - Condition : Aucune tranche payée
- **Facture : Partiellement payé** - Valeur : `etat = 1` - Condition : Au moins 1 tranche payée, mais pas toutes
- **Facture : Totalement payé** - Valeur : `etat = 2` - Condition : Toutes les tranches payées
- **Tranche : Non payée** - Valeur : `etat = false` - Condition : Aucun encaissement associé
- **Tranche : Payée** - Valeur : `etat = true` - Condition : Au moins un encaissement associé
- **Chantier : En cours** - Valeur : `statut_completion = 'en_cours'`<br>`etat = true` - Condition : Au moins une facture non totalement payée
- **Chantier : Complet** - Valeur : `statut_completion = 'complet'`<br>`etat = false` - Condition : Toutes les factures totalement payées


---

## 4. EXIGENCES FONCTIONNELLES

### 4.1 Module Gestion des Clients

#### 4.1.1 Fonctionnalités

- **Lister les clients** - Description : Affichage paginé de tous les clients actifs - Rôle requis : Admin, Consultant
- **Consulter un client** - Description : Détails complets + liste des chantiers associés - Rôle requis : Admin, Consultant
- **Créer un client** - Description : Formulaire de saisie avec génération automatique du code - Rôle requis : Admin uniquement
- **Modifier un client** - Description : Modification des informations (code non modifiable) - Rôle requis : Admin uniquement
- **Supprimer un client** - Description : Suppression logique (actif = false) - Rôle requis : Admin uniquement
- **Rechercher un client** - Description : Recherche par nom, code, secteur, zone - Rôle requis : Admin, Consultant
- **Importer des clients** - Description : Import massif via fichier Excel - Rôle requis : Admin uniquement


#### 4.1.2 Données gérées

- **Champ** : Code client - Type : VARCHAR(10) - Obligatoire : Auto-généré - Règle : Unique, première lettre nom + numéro
- **Champ** : Nom - Type : VARCHAR(255) - Obligatoire : Oui - Règle : Minimum 2 caractères
- **Champ** : Forme juridique - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence table `forme_juridique`
- **Champ** : Secteur d'activité - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence table `secteur_activite`
- **Champ** : Pays - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence table `pays`
- **Champ** : Pays groupe - Type : Clé étrangère - Obligatoire : Non - Règle : Référence table `pays_groupe`
- **Champ** : Zone géographique - Type : Clé étrangère - Obligatoire : Non - Règle : Référence table `zone_geographique`
- **Champ** : Adresse - Type : TEXT - Obligatoire : Non
- **Champ** : Téléphone - Type : VARCHAR(20) - Obligatoire : Non
- **Champ** : Email - Type : VARCHAR(255) - Obligatoire : Non - Règle : Format email valide si renseigné
- **Champ** : Notes - Type : TEXT - Obligatoire : Non
- **Champ** : Actif - Type : BOOLEAN - Obligatoire : Oui - Règle : Par défaut : true


#### 4.1.3 Règles métier spécifiques

- **Génération du code client** : Première lettre du nom (majuscule) + numéro incrémental sur 5 chiffres
  - Exemple : "Unilever" → U00001, U00002, etc.
  - Si plusieurs clients commencent par la même lettre, incrémentation continue
- **Suppression** : Impossible si des chantiers actifs sont associés (protection par clé étrangère)
- **Import Excel** : Format attendu avec colonnes : nom, forme_juridique, secteur, pays, zone (optionnel), adresse (optionnel)

### 4.2 Module Gestion des Chantiers

#### 4.2.1 Fonctionnalités

- **Lister les chantiers** - Description : Affichage paginé avec filtres (client, statut, période) - Rôle requis : Admin, Consultant
- **Consulter un chantier** - Description : Détails complets : équipe, budget, factures, dates - Rôle requis : Admin, Consultant
- **Créer un chantier** - Description : Processus guidé en 8 étapes - Rôle requis : Admin uniquement
- **Modifier un chantier** - Description : Modification dates, équipe, budget - Rôle requis : Admin uniquement
- **Supprimer un chantier** - Description : Suppression logique - Rôle requis : Admin uniquement
- **Voir chantiers incomplets** - Description : Liste des chantiers en cours (dashboard) - Rôle requis : Admin, Consultant
- **Importer des chantiers** - Description : Import massif via Excel - Rôle requis : Admin uniquement


#### 4.2.2 Processus de création (8 étapes)

- **Étape** : 1. Informations générales - Données saisies : Client, type mission, sous-type mission, monnaie
- **Étape** : 2. Dates - Données saisies : Date initialisation, date fin prévue
- **Étape** : 3. Référence - Données saisies : Génération automatique de la référence chantier
- **Étape** : 4. Équipe (1re personne) - Données saisies : Sélection personnel (trigramme), grade
- **Étape** : 5. Budget (1re personne) - Données saisies : Nombre jours/homme, taux journalier
- **Étape** : 6. Équipe supplémentaire - Données saisies : Ajout autres membres (optionnel)
- **Étape** : 7. Budgets supplémentaires - Données saisies : Saisie budgets pour autres membres
- **Étape** : 8. Validation - Données saisies : Récapitulatif et confirmation


#### 4.2.3 Données gérées

**Table `chantier` :**

- **Champ** : Référence chantier - Type : VARCHAR(20) - Obligatoire : Auto-généré - Règle : Format : O + numéro + trigramme + date
- **Champ** : id_client - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `client.id_client`
- **Champ** : id_type_mission - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `type_mission.id_type_mission`
- **Champ** : id_sous_type_mission - Type : Clé étrangère - Obligatoire : Non - Règle : Référence `sous_type_mission.id_sous_type_mission`
- **Champ** : id_monnaie - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `monnaie.id_monnaie`
- **Champ** : statut_completion - Type : ENUM - Obligatoire : Oui - Règle : 'en_cours' ou 'complet'
- **Champ** : etat - Type : BOOLEAN - Obligatoire : Oui - Règle : true = actif, false = terminé
- **Champ** : Actif - Type : BOOLEAN - Obligatoire : Oui - Règle : true par défaut (soft delete)


**Table `get_date` (1:1 avec chantier) :**

- **Champ** : id_chantier - Type : Clé étrangère - Obligatoire : Oui
- **Champ** : date_initialisation - Type : DATE - Obligatoire : Oui
- **Champ** : date_fin_prevue - Type : DATE - Obligatoire : Oui
- **Champ** : reference_chantier - Type : VARCHAR(20) - Obligatoire : Oui (copie pour queries)


**Table `equipe` (N membres par chantier) :**

- **Champ** : id_chantier - Type : Clé étrangère - Obligatoire : Oui
- **Champ** : id_liste_personnel - Type : Clé étrangère - Obligatoire : Oui
- **Champ** : id_grade - Type : Clé étrangère - Obligatoire : Oui


**Table `budget` (N budgets par chantier, 1 par membre) :**

- **Champ** : id_equipe - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence membre d'équipe
- **Champ** : id_chantier - Type : Clé étrangère - Obligatoire : Oui
- **Champ** : nb_jour_homme - Type : DECIMAL(10,2) - Obligatoire : Oui - Règle : Positif, support virgule
- **Champ** : taux - Type : DECIMAL(15,2) - Obligatoire : Oui - Règle : Positif
- **Champ** : total - Type : DECIMAL(15,2) - Obligatoire : Auto-calculé - Règle : nb_jour_homme × taux


### 4.3 Module Facturation

#### 4.3.1 Fonctionnalités

- **Lister les factures** - Description : Affichage paginé avec filtres (chantier, état, période) - Rôle requis : Admin, Consultant
- **Consulter une facture** - Description : Détails complets + tranches + encaissements - Rôle requis : Admin, Consultant
- **Créer une facture** - Description : Formulaire de saisie avec génération automatique numéro - Rôle requis : Admin uniquement
- **Modifier une facture** - Description : Modification débours, notes - Rôle requis : Admin uniquement
- **Supprimer une facture** - Description : Suppression logique - Rôle requis : Admin uniquement
- **Générer PDF** - Description : Export professionnel de la facture - Rôle requis : Admin, Consultant
- **Voir factures par état** - Description : Filtres : non payé, partiel, totalement payé - Rôle requis : Admin, Consultant
- **Alertes émission** - Description : Factures à émettre (J-7) - Rôle requis : Admin
- **Alertes recouvrement** - Description : Factures à recouvrer (J-7) - Rôle requis : Admin


#### 4.3.2 Données gérées

- **Champ** : Numéro facture - Type : VARCHAR(20) - Obligatoire : Auto-généré - Règle : Format : FACT-YYYY-NNNNN
- **Champ** : id_chantier - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `chantier.id_chantier`
- **Champ** : debours_decaissable - Type : DECIMAL(15,2) - Obligatoire : Oui - Règle : >= 0
- **Champ** : debours_non_decaissable - Type : DECIMAL(15,2) - Obligatoire : Oui - Règle : >= 0
- **Champ** : nb_tranche_facture - Type : INTEGER - Obligatoire : Auto-calculé - Règle : Nombre de tranches associées
- **Champ** : etat - Type : INTEGER - Obligatoire : Auto-mis à jour - Règle : 0=Non payé, 1=Partiel, 2=Payé
- **Champ** : notes - Type : TEXT - Obligatoire : Non
- **Champ** : Actif - Type : BOOLEAN - Obligatoire : Oui - Règle : true par défaut


#### 4.3.3 Génération PDF

La facture PDF inclut :
- En-tête : Société émettrice (logo, coordonnées)
- Informations client : Nom, adresse, secteur
- Référence chantier et numéro facture
- Tableau détaillé :
  - Honoraires par tranche (montant, taux)
  - Débours par tranche (montant, taux)
  - Sous-totaux
  - Taxes (TVA, IMP) si applicables
  - Total TTC
- Montant en lettres (conversion automatique via `kwn/number-to-words`)
- Conditions de paiement
- Coordonnées bancaires (RIB)

### 4.4 Module Tranches de Facture

#### 4.4.1 Fonctionnalités

- **Créer des tranches** - Description : Formulaire dynamique selon nb tranches défini - Rôle requis : Admin uniquement
- **Modifier une tranche** - Description : Modification taux, dates, nom - Rôle requis : Admin uniquement
- **Supprimer une tranche** - Description : Suppression en cascade - Rôle requis : Admin uniquement
- **Consulter une tranche** - Description : Détails + encaissements associés - Rôle requis : Admin, Consultant
- **Calculer dernière tranche** - Description : Ajustement automatique pour atteindre 100% - Rôle requis : Automatique


#### 4.4.2 Données gérées

- **Champ** : id_facture - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `facture.id_facture`
- **Champ** : nom_tranche - Type : VARCHAR(100) - Obligatoire : Oui - Règle : Ex: "Acompte 1", "Solde"
- **Champ** : taux_honoraire - Type : DECIMAL(5,2) - Obligatoire : Oui - Règle : 0 à 100
- **Champ** : montant_honoraire - Type : DECIMAL(15,2) - Obligatoire : Auto-calculé - Règle : (taux × budget_total) / 100
- **Champ** : taux_debours - Type : DECIMAL(5,2) - Obligatoire : Oui - Règle : 0 à 100
- **Champ** : montant_debours - Type : DECIMAL(15,2) - Obligatoire : Auto-calculé - Règle : (taux × débours_total) / 100
- **Champ** : date_prevision_facture - Type : DATE - Obligatoire : Oui - Règle : Date émission prévue
- **Champ** : date_prevision_recouvrement - Type : DATE - Obligatoire : Non - Règle : Date recouvrement prévue
- **Champ** : etat - Type : BOOLEAN - Obligatoire : Auto-mis à jour - Règle : false=Non payé, true=Payé


#### 4.4.3 Validation stricte

**Règle de validation primordiale :**
```
Σ(taux_honoraire de toutes les tranches) = 100%
ET
Σ(taux_debours de toutes les tranches) = 100%
```

**Implémentation :**
- Validation JavaScript temps réel (bloque soumission formulaire si non respectée)
- Validation PHP côté serveur (double sécurité)
- Message d'erreur explicite si non respectée

**Assistance à la saisie :**
- La dernière tranche voit ses taux calculés automatiquement pour atteindre exactement 100%
- Exemple : Si 2 tranches saisies à 30% et 40%, la 3e tranche sera automatiquement à 30%

### 4.5 Module Encaissement

#### 4.5.1 Fonctionnalités

- **Créer un encaissement** - Description : Formulaire avec sélection tranche + mode paiement - Rôle requis : Admin uniquement
- **Modifier un encaissement** - Description : Modification dates, montant, détails - Rôle requis : Admin uniquement
- **Supprimer un encaissement** - Description : Suppression avec mise à jour statuts - Rôle requis : Admin uniquement
- **Consulter encaissements** - Description : Liste par tranche ou par facture - Rôle requis : Admin, Consultant
- **Historique paiements** - Description : Liste chronologique de tous les encaissements - Rôle requis : Admin, Consultant


#### 4.5.2 Données gérées

- **Champ** : id_tranche - Type : Clé étrangère - Obligatoire : Oui - Règle : Référence `tranche_facture.id_tranche`
- **Champ** : mode_paiement - Type : VARCHAR(20) - Obligatoire : Oui - Règle : 'cheque', 'virement', 'especes', 'carte'
- **Champ** : numero_cheque - Type : VARCHAR(50) - Obligatoire : Si mode=cheque
- **Champ** : id_type_cheque - Type : Clé étrangère - Obligatoire : Si mode=cheque - Règle : Référence `type_cheque.id_type_cheque`
- **Champ** : id_banque - Type : Clé étrangère - Obligatoire : Si mode=cheque - Règle : Référence `banque.id_banque`
- **Champ** : date_encaissement_probable - Type : DATE - Obligatoire : Oui
- **Champ** : date_encaissement_reel - Type : DATE - Obligatoire : Non
- **Champ** : montant - Type : DECIMAL(15,2) - Obligatoire : Oui - Règle : Positif
- **Champ** : notes - Type : TEXT - Obligatoire : Non


#### 4.5.3 Modes de paiement

- **Chèque** - Champs supplémentaires requis : Numéro chèque, type chèque, banque émettrice
- **Virement** - Champs supplémentaires requis : Aucun champ supplémentaire
- **Espèces** - Champs supplémentaires requis : Aucun champ supplémentaire
- **Carte bancaire** - Champs supplémentaires requis : Aucun champ supplémentaire


### 4.6 Module Reporting et Tableaux de Bord

#### 4.6.1 Dashboard principal

**URL** : `/dashboard`

**Indicateurs clés (KPI) :**

- **Nombre de clients** - Calcul : COUNT(clients actifs) - Affichage : Card avec variation mensuelle
- **Chantiers en cours** - Calcul : COUNT(chantiers WHERE etat=true) - Affichage : Card avec variation mensuelle
- **Total jours/homme** - Calcul : SUM(total_jour_homme) - Affichage : Card avec chiffre global
- **Nombre de factures** - Calcul : COUNT(factures actives) - Affichage : Card avec chiffre global
- **Chantiers incomplets** - Calcul : TOP 10 chantiers en cours - Affichage : Tableau détaillé


**Graphiques (Chart.js) :**

- **Chantiers par mois** - Type : Courbe - Données : Nombre de chantiers créés par mois (année sélectionnable)
- **Factures par état** - Type : Donut - Données : Répartition : Non payées, Partielles, Totalement payées (année sélectionnable)
- **Budgets par mois** - Type : Double courbe - Données : - Budget global (€)<br>- Jours/homme (année sélectionnable)


#### 4.6.2 Rapports spécialisés

**Rapport de clôture** (`/rapports/cloture`)

- **Objectif** - Détails : Lister les factures totalement payées (100% recouvrement)
- **Données affichées** - Détails : - Référence chantier<br>- Client<br>- Numéro facture<br>- Montant total<br>- Date dernier encaissement
- **Filtres** - Détails : Période (date début - date fin)
- **Export** - Détails : PDF (bouton de génération)


**Rapport de vérification** (`/rapports/verification`)

- **Objectif** - Détails : Vérifier la cohérence des tranches (somme = 100%)
- **Contrôles** - Détails : - Σ(taux_honoraire) = 100%<br>- Σ(taux_debours) = 100%
- **Affichage** - Détails : Liste des factures avec indicateur ✓ (OK) ou ✗ (Erreur)
- **Action** - Détails : Correction manuelle si erreur détectée


**Baromètre annuel** (`/rapports/barometre`)

- **Objectif** - Détails : Tableau croisé dynamique : Chantiers × Mois
- **Données sources** - Détails : Vue SQL `v_barometre` (agrégation PostgreSQL)
- **Affichage** - Détails : Matrice avec chiffres d'affaires mensuels par chantier
- **Filtres** - Détails : Année (sélection)
- **Total** - Détails : Ligne de total par mois + colonne de total par chantier


**Analyse par ligne métier** (`/rapports/ligne-metier`)

- **Objectif** - Détails : Répartition des chantiers par type de mission
- **Données affichées** - Détails : - Type de mission<br>- Nombre de chantiers<br>- Budget total<br>- Pourcentage
- **Graphique** - Détails : Diagramme en barres horizontales


**Analyse par secteur** (`/rapports/secteur`)

- **Objectif** - Détails : Répartition des clients par secteur d'activité
- **Données affichées** - Détails : - Secteur<br>- Nombre de clients<br>- Pourcentage
- **Graphique** - Détails : Diagramme circulaire (Pie chart)


**Analyse par zone géographique** (`/rapports/zone`)

- **Objectif** - Détails : Répartition des clients par zone géographique
- **Données affichées** - Détails : - Zone<br>- Nombre de clients<br>- Pourcentage
- **Graphique** - Détails : Carte ou diagramme en barres


### 4.7 Module Paramètres et Configuration

**Accès** : Administrateurs uniquement

- **Banques** - Données gérées : Liste des banques (nom, code BIC, RIB) - URL : `/parametres/banques`
- **Types de chèques** - Données gérées : Liste des types (barré, certifié, ordinaire, etc.) - URL : `/parametres/types-cheques`
- **Personnel** - Données gérées : Liste du personnel (nom, prénom, trigramme, grade) - URL : `/parametres/personnel`
- **Grades** - Données gérées : Liste des grades (Associé, Manager, Senior, etc.) - URL : `/parametres/grades`
- **Sociétés émettrices** - Données gérées : Sociétés du cabinet (nom, SIREN, logo, coordonnées) - URL : `/parametres/societes`
- **Taux de change** - Données gérées : Taux de conversion entre devises - URL : `/parametres/taux-change`
- **Taux de taxes** - Données gérées : TVA, IMP, autres taxes - URL : `/parametres/taux-taxes`


**Fonctionnalités communes :**
- CRUD complet (Create, Read, Update, Delete)
- Validation des données
- Suppression logique (soft delete)
- Historisation des modifications

### 4.8 Module Import/Export

#### 4.8.1 Import Excel

**Fonctionnalité** : Import massif de données via fichier Excel (.xlsx, .xls)

**Types d'import disponibles :**

- **Clients** - Fichier : ClientImport.php - Feuilles attendues : "Clients" - Colonnes requises : nom, forme_juridique, secteur_activite, pays
- **Chantiers** - Fichier : ChantierImport.php - Feuilles attendues : "Chantiers" - Colonnes requises : client_code, type_mission, date_initialisation
- **Budget + Factures** - Fichier : BudgetFactureImport.php - Feuilles attendues : "Budget" + "Facture" - Colonnes requises : Voir détails ci-dessous


**Import Budget + Factures (détails) :**

*Feuille "Budget" :*
- `code_chantier` : Référence du chantier existant
- `nb_jour_homme` : Nombre de jours/homme (décimal)
- `taux` : Taux journalier (décimal)

*Feuille "Facture" :*
- `code_chantier` : Référence du chantier existant
- `debours_decaissable` : Montant (décimal)
- `debours_non_decaissable` : Montant (décimal)
- `taux_honoraire` : Taux de la tranche (%)
- `montant_honoraire` : Montant honoraires (décimal)
- `taux_debours` : Taux débours (%)
- `montant_debours` : Montant débours (décimal)
- `date_prevision_facture` : Date (format : YYYY-MM-DD)
- `nom_tranche` : Nom de la tranche (texte)
- `etat` : État (0 ou 1)

**Règles d'import :**
- Validation stricte des données avant insertion
- Gestion des erreurs ligne par ligne
- Rapport d'import (lignes réussies / échouées)
- Transaction globale (rollback si erreur critique)

#### 4.8.2 Export PDF

**Factures** : Export professionnel avec en-tête, détails, totaux, montant en lettres

**Rapports** : Export des rapports (clôture, baromètre) au format PDF

### 4.9 Module Authentification et Sécurité

#### 4.9.1 Inscription

- **URL** - Détails : `/register`
- **Formulaire** - Détails : Nom, prénom, email, mot de passe, confirmation mot de passe
- **Validation** - Détails : - Email unique (contrainte BDD)<br>- Mot de passe min 8 caractères<br>- Confirmation mot de passe identique
- **Rôle attribué** - Détails : **Consultant** (automatiquement, non modifiable lors de l'inscription)
- **Vérification email** - Détails : **NON** (pas de code 2FA, inscription immédiate)
- **Connexion automatique** - Détails : Oui après inscription réussie


**Important** : Il n'est **PAS possible de créer un compte Administrateur** lors de l'inscription. Seul un compte Administrateur existant peut promouvoir un utilisateur Consultant au rôle Administrateur.

#### 4.9.2 Connexion

- **URL** - Détails : `/login`
- **Formulaire** - Détails : Email, mot de passe
- **Validation** - Détails : Vérification email + mot de passe (hash bcrypt)
- **Session** - Détails : Durée : 120 minutes d'inactivité
- **Redirection** - Détails : Dashboard selon le rôle (Admin ou Consultant)


#### 4.9.3 Déconnexion

- **URL** - Détails : `/logout`
- **Action** - Détails : Destruction de la session + redirection vers page de connexion


#### 4.9.4 Réinitialisation mot de passe

- **URL** - Détails : `/password/reset`
- **Processus** - Détails : 1. Saisie email<br>2. Envoi email avec lien de réinitialisation<br>3. Clic lien + saisie nouveau mot de passe<br>4. Confirmation
- **Sécurité** - Détails : Token unique avec expiration (60 minutes)


---

## 5. AUTOMATISATIONS ET VALIDATIONS

### 5.1 Automatisations métier

- **Génération code client** - Déclencheur : Création client - Action : Première lettre nom + numéro incrémental (ex: U00001)
- **Génération référence chantier** - Déclencheur : Création chantier - Action : Format : O + numéro + trigramme + date (ex: O00002A131025)
- **Génération numéro facture** - Déclencheur : Création facture - Action : Format : FACT-YYYY-NNNNN (ex: FACT-2025-00001)
- **Calcul budget total** - Déclencheur : Saisie jours/homme + taux - Action : total = nb_jour_homme × taux
- **Calcul montant honoraire tranche** - Déclencheur : Saisie taux_honoraire - Action : montant_honoraire = (taux × budget_total) / 100
- **Calcul montant débours tranche** - Déclencheur : Saisie taux_debours - Action : montant_debours = (taux × débours_total) / 100
- **Calcul dernière tranche** - Déclencheur : Saisie N-1 tranches - Action : Ajustement automatique pour atteindre 100%
- **Mise à jour statut facture** - Déclencheur : Création/modification encaissement - Action : Appel `Facture::updateFactureStatus()`
- **Clôture chantier** - Déclencheur : Toutes factures payées - Action : statut_completion = 'complet', etat = false
- **Conversion virgule → point** - Déclencheur : Saisie montants avec virgule - Action : Remplacement automatique "," par "."


### 5.2 Validations et contrôles

#### 5.2.1 Validations formulaires

- **Email** - Validation : Format email valide, unique en base
- **Montants** - Validation : Positifs ou nuls, format décimal (max 15 chiffres, 2 décimales)
- **Taux** - Validation : Entre 0 et 100, format décimal (max 5 chiffres, 2 décimales)
- **Dates** - Validation : Format YYYY-MM-DD, date fin >= date début
- **Code client** - Validation : Unique (contrainte BDD)
- **Référence chantier** - Validation : Unique (contrainte BDD)
- **Numéro facture** - Validation : Unique (contrainte BDD)
- **Trigramme** - Validation : 3 lettres majuscules, unique (contrainte BDD)


#### 5.2.2 Validations métier

- **Somme taux honoraires = 100%** - Implémentation : Validation JavaScript + PHP (bloquante)
- **Somme taux débours = 100%** - Implémentation : Validation JavaScript + PHP (bloquante)
- **Client existe** - Implémentation : Clé étrangère (ON DELETE RESTRICT)
- **Chantier existe** - Implémentation : Clé étrangère (ON DELETE RESTRICT)
- **Facture existe** - Implémentation : Clé étrangère (ON DELETE CASCADE)
- **Tranche existe** - Implémentation : Clé étrangère (ON DELETE CASCADE)
- **Tranche non payée** - Implémentation : Vérification avant création encaissement


### 5.3 Alertes et notifications

- **Factures à émettre** - Condition : Date prévision facture dans 7 jours - Affichage : Badge ou liste dédiée
- **Factures à recouvrer** - Condition : Date prévision recouvrement dans 7 jours - Affichage : Badge ou liste dédiée
- **Factures en retard** - Condition : Date prévision recouvrement dépassée + non payé - Affichage : Badge rouge avec compteur
- **Chantiers incomplets** - Condition : statut_completion = 'en_cours' - Affichage : Section dashboard
- **Message succès** - Condition : Action réussie (création, modification, suppression) - Affichage : Toast vert en haut de page
- **Message erreur** - Condition : Validation échouée ou erreur technique - Affichage : Toast rouge avec détail
- **Message avertissement** - Condition : Action réversible ou demande confirmation - Affichage : Modal ou toast orange


---

## 6. ARCHITECTURE TECHNIQUE

### 6.1 Stack technologique

#### 6.1.1 Backend

- **Langage** - Technologie : PHP - Version : 8.2+
- **Framework** - Technologie : Laravel - Version : 11.x
- **ORM** - Technologie : Eloquent - Version : Intégré Laravel
- **Base de données** - Technologie : PostgreSQL - Version : 14+ (Render Managed)
- **Serveur web** - Technologie : Apache / Nginx - Version : Géré par Render
- **Gestionnaire de paquets** - Technologie : Composer - Version : 2.x


#### 6.1.2 Frontend

- **Template Engine** - Technologie : Blade - Version : Intégré Laravel
- **Build Tool** - Technologie : Vite - Version : 5.0
- **Framework CSS** - Technologie : Bootstrap - Version : 5.3
- **JavaScript** - Technologie : jQuery - Version : 3.6
- **Sélection avancée** - Technologie : Select2 - Version : 4.1
- **Graphiques** - Technologie : Chart.js - Version : 4.0
- **Icônes** - Technologie : Bootstrap Icons - Version : Dernière version


#### 6.1.3 Bibliothèques PHP

- **Package** : `maatwebsite/excel` - Usage : Import/Export Excel
- **Package** : `phpoffice/phpspreadsheet` - Usage : Manipulation fichiers Excel
- **Package** : `kwn/number-to-words` - Usage : Conversion montants en lettres (français)
- **Package** : `consoletvs/charts` - Usage : Génération de graphiques côté serveur
- **Package** : `guzzlehttp/guzzle` - Usage : Requêtes HTTP (si intégrations externes)


### 6.2 Architecture applicative

#### 6.2.1 Pattern MVC

```
┌───────────────────────────────────────────────────────────────┐
│                      ARCHITECTURE MVC                         │
└───────────────────────────────────────────────────────────────┘

                         ┌─────────────┐
                         │  UTILISATEUR │
                         │  (Navigateur)│
                         └──────┬──────┘
                                │ HTTP Request
                                ▼
                   ┌────────────────────────┐
                   │      ROUTES            │
                   │  (web.php)             │
                   │  201 routes définies   │
                   └────────┬───────────────┘
                            │
                            ▼
                   ┌────────────────────────┐
                   │    CONTROLLERS         │
                   │  - ClientController    │
                   │  - ChantierController  │
                   │  - FactureController   │
                   │  - TrancheController   │
                   │  - EncaissementController│
                   │  - DashboardController │
                   │  - RapportController   │
                   │  (20 controllers)      │
                   └────────┬───────────────┘
                            │
              ┌─────────────┼─────────────┐
              │             │             │
              ▼             ▼             ▼
     ┌────────────┐ ┌────────────┐ ┌────────────┐
     │   MODELS   │ │   VIEWS    │ │ MIDDLEWARE │
     │  (Eloquent)│ │  (Blade)   │ │  - Auth    │
     │            │ │            │ │  - CSRF    │
     │ - Client   │ │ - Layouts  │ │  - Role    │
     │ - Chantier │ │ - Forms    │ └────────────┘
     │ - Facture  │ │ - Lists    │
     │ - Tranche  │ │ - Dashboard│
     │ - Encaiss. │ │            │
     │ (38 models)│ │            │
     └─────┬──────┘ └────────────┘
           │
           ▼
  ┌───────────────────┐
  │   BASE DE DONNÉES │
  │   PostgreSQL 14   │
  │   43 tables       │
  └───────────────────┘
```

#### 6.2.2 Structure des dossiers

```
factures-app/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ClientController.php
│   │   │   ├── ChantierController.php
│   │   │   ├── FactureController.php
│   │   │   ├── TrancheFactureController.php
│   │   │   ├── EncaissementController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── RapportController.php
│   │   │   ├── ImportController.php
│   │   │   ├── AuthController.php
│   │   │   └── (11 autres controllers)
│   │   │
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── VerifyCsrfToken.php
│   │   │   └── CheckRole.php
│   │   │
│   │   └── Requests/
│   │       └── (Validation requests)
│   │
│   ├── Models/
│   │   ├── Client.php
│   │   ├── Chantier.php
│   │   ├── Facture.php (méthode updateFactureStatus)
│   │   ├── TrancheFacture.php
│   │   ├── Encaissement.php
│   │   ├── Budget.php
│   │   ├── Equipe.php
│   │   ├── GetDate.php
│   │   └── (30 autres models)
│   │
│   └── Imports/
│       ├── ClientImport.php
│       ├── ChantierImport.php
│       └── BudgetFactureImport.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── navbar.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   ├── navbarConsultant.blade.php
│   │   │   └── sidebarConsultant.blade.php
│   │   │
│   │   ├── clients/
│   │   ├── chantiers/
│   │   ├── factures/
│   │   ├── tranches/
│   │   ├── encaissements/
│   │   ├── dashboard.blade.php
│   │   └── (autres vues)
│   │
│   └── js/
│       └── app.js
│
├── database/
│   ├── migrations/
│   │   └── (43 fichiers de migration)
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── routes/
│   └── web.php (201 routes)
│
├── public/
│   ├── assetsfacture/
│   │   └── (CSS, images, Bootstrap Icons)
│   └── index.php
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── (autres configs)
│
└── docs/
    ├── GUIDE_TECHNIQUE.md (8104 lignes)
    ├── CAHIER_DES_CHARGES.md (ce document)
    └── GUIDE_UTILISATEUR.md (1640 lignes)
```

### 6.3 Modèle de données

#### 6.3.1 Hiérarchie des entités

```
Client (1)
  ├── Attributs : id_client, code_client, nom, forme_juridique, secteur, pays, zone
  │
  └── Chantier (N)
        ├── Attributs : id_chantier, reference_chantier, type_mission, statut_completion, etat
        │
        ├── GetDate (1:1)
        │     └── Attributs : date_initialisation, date_fin_prevue
        │
        ├── Equipe (N)
        │     └── Attributs : id_liste_personnel, id_grade
        │
        ├── Budget (N)
        │     └── Attributs : id_equipe, nb_jour_homme, taux, total
        │
        └── Facture (N)
              ├── Attributs : id_facture, numero_facture, debours_decaissable, debours_non_decaissable, etat
              │
              ├── ChoixBanque (1:1)
              │     └── Attributs : id_banque
              │
              └── TrancheFacture (N)
                    ├── Attributs : nom_tranche, taux_honoraire, montant_honoraire, taux_debours, montant_debours, etat
                    │
                    └── Encaissement (N)
                          └── Attributs : mode_paiement, montant, date_encaissement_reel, numero_cheque
```

#### 6.3.2 Tables principales (43 au total)

**Tables métier (10) :**
- `client` : Clients du cabinet
- `chantier` : Missions/projets
- `get_date` : Dates des chantiers (1:1)
- `equipe` : Personnel affecté aux chantiers
- `budget` : Budgets par membre d'équipe
- `total_budget` : Agrégation des budgets par chantier
- `facture` : Factures émises
- `tranche_facture` : Tranches de paiement
- `encaissement` : Paiements reçus
- `choix_banque` : Banques pour facturation (1:1 avec facture)

**Tables de liaison (2) :**
- `facture_budget` : Pivot N:N entre facture et budget

**Tables de référence (23) :**
- `pays`, `pays_groupe`, `zone_geographique`
- `secteur_activite`, `forme_juridique`
- `type_mission`, `sous_type_mission`
- `monnaie` (EUR, USD, XAF, MGA)
- `grade` (Associé, Manager, Senior, Junior, Consultant, Stagiaire)
- `liste_personnel` (trigramme, nom, prénom)
- `banque`, `type_cheque`
- `taux` (TVA, IMP)
- `societes` (sociétés émettrices)
- (et 10 autres tables de référence)

**Tables système (5) :**
- `users` : Utilisateurs (avec rôles Admin/Consultant)
- `migrations` : Historique migrations
- `failed_jobs` : Jobs échoués
- `password_reset_tokens` : Tokens de réinitialisation
- `sessions` : Sessions utilisateurs

**Vues SQL (1) :**
- `v_barometre` : Vue agrégée pour baromètre annuel

### 6.4 Conventions et standards

#### 6.4.1 Clés primaires personnalisées

Contrairement à la convention Laravel standard (`id`), l'application utilise des clés primaires nommées selon la table :

- **Table** : `client` - Clé primaire : `id_client`
- **Table** : `chantier` - Clé primaire : `id_chantier`
- **Table** : `facture` - Clé primaire : `id_facture`
- **Table** : `tranche_facture` - Clé primaire : `id_tranche`
- **Table** : `encaissement` - Clé primaire : `id_encaissement`
- **Table** : Etc. - Clé primaire : `id_{nom_table}`


**Déclaration dans les modèles :**
```php
class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id_client';
    public $incrementing = true;
    protected $keyType = 'int';
}
```

#### 6.4.2 Nommage des tables

- **Singular** : Les tables sont au singulier (ex: `client`, `facture`)
- **Anglais** : Noms en anglais (sauf termes métier français : `chantier`, `tranche_facture`)
- **Pas de pluriel automatique** : Désactivation du pluriel automatique Laravel

```php
// Dans les modèles
protected $table = 'client'; // et non 'clients'
```

#### 6.4.3 Relations Eloquent

**Relation 1:N (One to Many) :**
```php
// Dans Client.php
public function chantiers()
{
    return $this->hasMany(Chantier::class, 'id_client', 'id_client');
}

// Dans Chantier.php
public function client()
{
    return $this->belongsTo(Client::class, 'id_client', 'id_client');
}
```

**Relation 1:1 (One to One) :**
```php
// Dans Chantier.php
public function getDate()
{
    return $this->hasOne(GetDate::class, 'id_chantier', 'id_chantier');
}

// Dans GetDate.php
public function chantier()
{
    return $this->belongsTo(Chantier::class, 'id_chantier', 'id_chantier');
}
```

**Relation N:N (Many to Many) :**
```php
// Dans Facture.php
public function budgets()
{
    return $this->belongsToMany(
        Budget::class,
        'facture_budget',
        'id_facture',
        'id_budget'
    );
}
```

#### 6.4.4 Contraintes d'intégrité

- **ON DELETE RESTRICT** - Exemple : `chantier.id_client` → `client.id_client` - Action : Empêche suppression client si chantiers associés
- **ON DELETE CASCADE** - Exemple : `facture.id_chantier` → `chantier.id_chantier` - Action : Supprime factures si chantier supprimé
- **ON DELETE CASCADE** - Exemple : `tranche_facture.id_facture` → `facture.id_facture` - Action : Supprime tranches si facture supprimée
- **ON DELETE CASCADE** - Exemple : `encaissement.id_tranche` → `tranche_facture.id_tranche` - Action : Supprime encaissements si tranche supprimée


#### 6.4.5 Soft Delete (Suppression logique)

Au lieu de supprimer définitivement les enregistrements, l'application utilise un champ `actif` :

```php
// Suppression logique
$client->update(['actif' => false]);

// Récupération uniquement des enregistrements actifs
$clients = Client::where('actif', true)->get();
```

**Avantages :**
- Traçabilité complète
- Récupération possible en cas d'erreur
- Conformité aux exigences d'archivage légal

---

## 7. EXIGENCES NON FONCTIONNELLES

### 7.1 Performance

- **Temps de chargement listes** - Objectif : < 2 secondes - Mesure : Liste 100 clients : 1,5s (✓)
- **Temps de chargement dashboard** - Objectif : < 2 secondes - Mesure : Dashboard complet : 1,3s (✓)
- **Génération PDF facture** - Objectif : < 3 secondes - Mesure : Facture avec 5 tranches : 2,1s (✓)
- **Temps de réponse formulaires** - Objectif : < 1 seconde - Mesure : Soumission formulaire : 0,8s (✓)
- **Import Excel 100 lignes** - Objectif : < 10 secondes - Mesure : Import 100 clients : 7s (✓)


**Optimisations implémentées :**
- **Eager Loading** systématique pour éviter le problème N+1
  ```php
  $factures = Facture::with(['chantier', 'tranches', 'encaissements'])->get();
  ```
- **Pagination** : Toutes les listes paginées (10-50 items/page)
- **Index SQL** : Sur colonnes fréquemment recherchées (code_client, reference_chantier, numero_facture)
- **Cache** : Config, routes et vues en cache en production
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

### 7.2 Scalabilité

- **Nombre de clients** - Capacité actuelle : 10 000+ - Capacité cible : 50 000
- **Nombre de chantiers** - Capacité actuelle : 50 000+ - Capacité cible : 200 000
- **Nombre de factures** - Capacité actuelle : 100 000+ - Capacité cible : 500 000
- **Utilisateurs simultanés** - Capacité actuelle : 50 - Capacité cible : 200
- **Taille base de données** - Capacité actuelle : 10 GB - Capacité cible : 100 GB


**Stratégies de scalabilité :**
- Architecture stateless (scalabilité horizontale possible)
- PostgreSQL performant pour gros volumes
- Render permet scale up (instance plus puissante) ou scale out (multiples instances)

### 7.3 Disponibilité et continuité

- **Uptime visé** - Valeur : 99% (363 jours/an)
- **Uptime actuel (Render)** - Valeur : 99,9% (garantie plateforme)
- **Fenêtre de maintenance** - Valeur : Dimanche 2h-4h du matin (si nécessaire)
- **Backup automatique** - Valeur : Quotidien (géré par Render)
- **Rétention backups** - Valeur : 7 jours (plan gratuit) ou 30 jours (payant)
- **RPO (Recovery Point Objective)** - Valeur : 24h (dernière sauvegarde)
- **RTO (Recovery Time Objective)** - Valeur : 2h (temps de restauration)


### 7.4 Compatibilité

#### 7.4.1 Navigateurs supportés

- **Google Chrome** - Version minimale : 90+ - Statut : ✅ Supporté et testé
- **Mozilla Firefox** - Version minimale : 88+ - Statut : ✅ Supporté et testé
- **Safari** - Version minimale : 14+ - Statut : ✅ Supporté (partiel)
- **Microsoft Edge** - Version minimale : 90+ - Statut : ✅ Supporté et testé
- **Internet Explorer** - Version minimale : Non supporté - Statut : ❌


#### 7.4.2 Résolutions d'écran

- **1920×1080** - Appareil : Desktop - Compatibilité : ✅ Optimisé
- **1366×768** - Appareil : Laptop - Compatibilité : ✅ Optimisé
- **1280×1024** - Appareil : Desktop ancien - Compatibilité : ✅ Fonctionnel
- **768×1024** - Appareil : Tablet (portrait) - Compatibilité : ⚠️ Limité
- **375×667** - Appareil : Mobile (portrait) - Compatibilité : ❌ Non optimisé


**Note** : L'application est conçue prioritairement pour usage desktop. L'utilisation sur mobile n'est pas optimisée (pas de responsive design avancé).

### 7.5 Ergonomie et expérience utilisateur

- **Langue** - Mise en œuvre : Français uniquement (interface, messages, documentation)
- **Navigation** - Mise en œuvre : Maximum 3 clics vers n'importe quelle fonction
- **Feedback utilisateur** - Mise en œuvre : Messages de succès (vert), erreur (rouge), avertissement (orange)
- **Formulaires guidés** - Mise en œuvre : Processus en étapes (chantier = 8 étapes)
- **Design cohérent** - Mise en œuvre : Bootstrap 5 sur toutes les pages
- **Accessibilité** - Mise en œuvre : Contraste suffisant, taille de police lisible (14px minimum)
- **Confirmation actions sensibles** - Mise en œuvre : Modal de confirmation pour suppressions
- **Aide contextuelle** - Mise en œuvre : Tooltips sur champs complexes


---

## 8. SÉCURITÉ ET CONFORMITÉ

### 8.1 Authentification et autorisation

#### 8.1.1 Authentification

- **Hash mot de passe** - Détails : `bcrypt` (coût 12, recommandation OWASP)
- **Stockage** - Détails : Champ `password` dans table `users` (VARCHAR 255)
- **Vérification** - Détails : `Hash::check($password, $user->password)`
- **Sessions** - Détails : Stockage fichier ou base de données (configurable)
- **Durée session** - Détails : 120 minutes d'inactivité
- **Cookies** - Détails : `httpOnly=true`, `Secure=true` (HTTPS), `SameSite=Lax`


#### 8.1.2 Autorisation

**Rôles définis :**

- **Admin** - Valeur : `role = 'Admin'` - Droits : CRUD complet, accès paramètres, imports, rapports complets
- **Consultant** - Valeur : `role = 'Consultant'` - Droits : Lecture seule, pas d'accès paramètres


**Middleware de protection :**
```php
// Dans web.php
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('clients', ClientController::class)->except(['index', 'show']);
    Route::get('/parametres', [ParametreController::class, 'index']);
});
```

**Contrôle dans les vues :**
```blade
@if(Auth::user()->role === 'Admin')
    <button>Modifier</button>
    <button>Supprimer</button>
@endif
```

### 8.2 Protection des données

#### 8.2.1 Protection contre les vulnérabilités

- **SQL Injection** - Protection : ORM Eloquent - Mise en œuvre : Requêtes préparées automatiques
- **XSS (Cross-Site Scripting)** - Protection : Échappement Blade - Mise en œuvre : `{{ $variable }}` échappe automatiquement
- **CSRF (Cross-Site Request Forgery)** - Protection : Token CSRF - Mise en œuvre : `@csrf` sur tous les formulaires
- **Mass Assignment** - Protection : `$fillable` - Mise en œuvre : Définition explicite des champs modifiables
- **Session Hijacking** - Protection : Cookies sécurisés - Mise en œuvre : `httpOnly`, `Secure`, `SameSite`
- **Brute Force** - Protection : Rate Limiting - Mise en œuvre : Limitation tentatives connexion (5/min)


**Exemple de protection Mass Assignment :**
```php
class Client extends Model
{
    protected $fillable = [
        'nom', 'forme_juridique', 'secteur_activite', 'pays', 'zone_geographique'
    ];

    // 'id_client', 'code_client' ne sont PAS dans $fillable
    // → Impossible de les modifier via User::create($request->all())
}
```

#### 8.2.2 Validation des entrées

Toutes les données utilisateur sont validées avant traitement :

```php
$request->validate([
    'nom' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'montant' => 'required|numeric|min:0|max:999999999.99',
    'taux' => 'required|numeric|min:0|max:100',
    'date_initialisation' => 'required|date',
]);
```

### 8.3 Sécurisation des communications

- **HTTPS obligatoire** - Détails : Redirection automatique HTTP → HTTPS en production
- **Certificat SSL** - Détails : Fourni gratuitement par Render (Let's Encrypt)
- **Renouvellement SSL** - Détails : Automatique (tous les 90 jours)
- **HSTS (HTTP Strict Transport Security)** - Détails : Configuré dans headers HTTP
- **Sécurité headers** - Détails : `X-Frame-Options: SAMEORIGIN`<br>`X-Content-Type-Options: nosniff`<br>`X-XSS-Protection: 1; mode=block`


### 8.4 Conformité réglementaire

#### 8.4.1 RGPD (Règlement Général sur la Protection des Données)

- **Minimisation des données** - Mise en conformité : Collecte uniquement des données nécessaires
- **Droit à l'oubli** - Mise en conformité : Suppression logique (soft delete) permettant anonymisation
- **Droit à la portabilité** - Mise en conformité : Export Excel des données clients possible
- **Consentement** - Mise en conformité : Inscription volontaire, pas de pré-remplissage
- **Sécurité** - Mise en conformité : Hash bcrypt, HTTPS, protection CSRF/XSS


#### 8.4.2 Archivage légal

- **Conservation factures** - Durée : 10 ans minimum (Code de commerce) - Mise en œuvre : Suppression logique, pas de purge automatique
- **Logs d'audit** - Durée : 1 an minimum - Mise en œuvre : Horodatage `created_at` sur toutes les tables
- **Historique modifications** - Durée : Recommandé - Mise en œuvre : Via champs `updated_at` (Laravel)


---

## 9. DÉPLOIEMENT ET INFRASTRUCTURE

### 9.1 Environnement de production

#### 9.1.1 Plateforme Render

- **Plateforme** - Valeur : Render (https://render.com)
- **Type de service** - Valeur : Web Service
- **Région** - Valeur : Oregon, USA (us-west-2)
- **URL production** - Valeur : https://factures-mazars-app.onrender.com/
- **Statut** - Valeur : ✅ EN PRODUCTION depuis janvier 2025


#### 9.1.2 Configuration Web Service

**Build Command :**
```bash
composer install --no-dev --optimize-autoloader && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache
```

**Explication :**
- `composer install --no-dev` : Installe uniquement dépendances de production (pas de PHPUnit, etc.)
- `--optimize-autoloader` : Optimise l'autoloader Composer (performances)
- `config:cache` : Met en cache la configuration
- `route:cache` : Met en cache les routes
- `view:cache` : Compile les templates Blade

**Start Command :**
```bash
php artisan migrate --force && \
php artisan storage:link && \
php -S 0.0.0.0:${PORT:-8000} -t public
```

**Explication :**
- `migrate --force` : Exécute les migrations BDD (--force pour production)
- `storage:link` : Crée le lien symbolique `public/storage` → `storage/app/public`
- `php -S` : Démarre le serveur PHP built-in sur port défini par Render

#### 9.1.3 Base de données PostgreSQL

- **Type** - Valeur : PostgreSQL Managed (Render)
- **Version** - Valeur : 14+
- **Région** - Valeur : Oregon, USA (même région que Web Service)
- **Connexion** - Valeur : Via variable `DATABASE_URL`
- **Backup** - Valeur : Quotidien automatique (Render)
- **Rétention** - Valeur : 7 jours (plan gratuit)


### 9.2 Configuration et paramétrage

#### 9.2.1 Variables d'environnement (.env Production)

```env
# Application
APP_NAME="Factures Mazars"
APP_ENV=production
APP_DEBUG=false           # CRITIQUE : false en production
APP_KEY=base64:xxxxx      # Généré avec php artisan key:generate
APP_URL=https://factures-mazars-app.onrender.com

# Base de données
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:password@host:5432/database  # Fourni par Render

# Cache et sessions
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Logs
LOG_CHANNEL=stack
LOG_LEVEL=error           # Logs uniquement erreurs en production

# Mail (si notification email activée)
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@mazars.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Important** :
- `APP_DEBUG=false` : Désactive l'affichage des erreurs détaillées (sécurité)
- `APP_KEY` : Unique, utilisé pour chiffrement cookies/sessions
- `DATABASE_URL` : Fourni automatiquement par Render (ne pas saisir manuellement)

#### 9.2.2 Configuration BDD (config/database.php)

```php
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'prefix' => '',
    'prefix_indexes' => true,
    'schema' => 'public',
    'sslmode' => 'prefer',
],
```

### 9.3 Sauvegarde et restauration

#### 9.3.1 Backups automatiques (Render)

- **Fréquence** - Valeur : Quotidien (automatique)
- **Heure** - Valeur : Variable (géré par Render)
- **Rétention** - Valeur : 7 jours (plan gratuit) / 30 jours (payant)
- **Type** - Valeur : Snapshot complet de la base PostgreSQL
- **Accès** - Valeur : Via dashboard Render > Database > Backups


#### 9.3.2 Restauration

**Procédure de restauration (via Render) :**
1. Se connecter au dashboard Render
2. Aller dans Database > Backups
3. Sélectionner le backup souhaité (date/heure)
4. Cliquer sur "Restore" (crée une nouvelle instance ou écrase l'existante)
5. Mettre à jour `DATABASE_URL` dans Web Service si nouvelle instance

**Restauration manuelle (via pg_dump) :**
```bash
# 1. Export manuel de la base
pg_dump -h host -U user -d database > backup_YYYYMMDD.sql

# 2. Restauration
psql -h host -U user -d database < backup_YYYYMMDD.sql
```

#### 9.3.3 Recommandations de sauvegarde

- **Backup BDD automatique** - Fréquence : Quotidien - Responsable : Render (automatique)
- **Export Excel données critiques** - Fréquence : Hebdomadaire - Responsable : Administrateur
- **Backup manuel (pg_dump)** - Fréquence : Mensuel - Responsable : Administrateur
- **Copie locale** - Fréquence : Avant migration majeure - Responsable : Administrateur


### 9.4 Monitoring et supervision

#### 9.4.1 Logs

**Logs Laravel :**
- **Emplacement** : `storage/logs/laravel.log`
- **Rotation** : Quotidienne (nouveau fichier chaque jour)
- **Niveau** : `error` en production (configurable dans `.env`)
- **Accès** : Via terminal Render ou SFTP

**Logs Render :**
- **Emplacement** : Dashboard Render > Logs (temps réel)
- **Contenu** : Requêtes HTTP, erreurs PHP, déploiements
- **Rétention** : 7 jours (plan gratuit)

#### 9.4.2 Health Check

**Recommandation** : Créer un endpoint `/health` pour vérification automatique :

```php
// Dans routes/web.php
Route::get('/health', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['status' => 'ok', 'database' => 'connected']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'database' => 'disconnected'], 500);
    }
});
```

#### 9.4.3 Monitoring recommandé

- **UptimeRobot** - Usage : Vérification uptime (ping toutes les 5 min) - Prix : Gratuit
- **Sentry** - Usage : Error tracking détaillé (exceptions PHP) - Prix : Gratuit jusqu'à 5k events/mois
- **Laravel Pulse** - Usage : Dashboard monitoring intégré Laravel 10+ - Prix : Gratuit (intégré)
- **Render Metrics** - Usage : CPU, RAM, requêtes HTTP (natif Render) - Prix : Gratuit


---

## 10. MAINTENANCE ET ÉVOLUTION

### 10.1 Maintenance préventive

#### 10.1.1 Tâches mensuelles

- **Vérifier les logs d'erreurs** - Action : Consulter `storage/logs/laravel.log` et Render Logs - Responsable : Admin technique
- **Vérifier l'espace disque BDD** - Action : Dashboard Render > Database > Metrics - Responsable : Admin technique
- **Tester une restauration de backup** - Action : Restaurer backup sur environnement de test - Responsable : Admin technique
- **Vérifier les mises à jour de sécurité** - Action : `composer audit` (détecte vulnérabilités) - Responsable : Admin technique


#### 10.1.2 Tâches trimestrielles

- **Mettre à jour les dépendances** - Action : `composer update` (en local, tester, puis déployer) - Responsable : Développeur
- **Nettoyer les logs anciens** - Action : Supprimer logs > 3 mois (`rm storage/logs/laravel-*.log`) - Responsable : Admin technique
- **Optimiser la base de données** - Action : `VACUUM ANALYZE` (PostgreSQL) - Responsable : Admin BDD
- **Revoir les permissions utilisateurs** - Action : Vérifier rôles Admin/Consultant, supprimer comptes inactifs - Responsable : Admin fonctionnel


#### 10.1.3 Tâches annuelles

- **Mise à jour majeure Laravel** - Action : Upgrade Laravel 11 → 12 (si disponible) - Responsable : Développeur senior
- **Migration PostgreSQL** - Action : Upgrade vers nouvelle version PostgreSQL - Responsable : Admin BDD
- **Revue complète de sécurité** - Action : Audit sécurité (OWASP, penetration testing) - Responsable : Expert sécurité
- **Audit de performance** - Action : Profiling, optimisation queries lentes - Responsable : Développeur senior


### 10.2 Procédures d'urgence

#### 10.2.1 En cas de problème critique

**Étape 1 : Mettre l'application en maintenance**
```bash
php artisan down --message="Maintenance en cours. Retour estimé dans 1 heure."
```

**Étape 2 : Diagnostiquer le problème**
- Consulter Render Logs (Dashboard Render > Logs)
- Consulter `storage/logs/laravel.log`
- Identifier la cause (erreur BDD, bug code, ressources saturées)

**Étape 3 : Rollback si nécessaire**
- **Render** : Redéployer un commit précédent (Dashboard > Deployments > Redeploy)
- **BDD** : Restaurer un backup récent si corruption

**Étape 4 : Corriger et tester**
- Créer une branche `hotfix/nom-bug`
- Corriger le bug
- Tester localement
- Pusher et déployer

**Étape 5 : Remettre en ligne**
```bash
php artisan up
```

#### 10.2.2 Contacts d'urgence

- **Bug critique application** - Contact : Chef de projet : Gershom Ny Aina Fitia
- **Problème infrastructure (Render)** - Contact : Support Render : support@render.com
- **Corruption BDD** - Contact : Admin BDD (interne)


### 10.3 Évolutions planifiées

#### 10.3.1 Court terme (3-6 mois)

**Fonctionnalités :**

- **Évolution** : Module de devis (avant facturation) - Priorité : Haute - Effort : 10 jours
- **Évolution** : Export Excel des rapports - Priorité : Haute - Effort : 3 jours
- **Évolution** : Gestion documentaire (upload PDF contrats) - Priorité : Moyenne - Effort : 5 jours
- **Évolution** : Historique des modifications (audit trail) - Priorité : Moyenne - Effort : 7 jours
- **Évolution** : Notifications email automatiques - Priorité : Basse - Effort : 5 jours


**Technique :**

- **Amélioration** : Mise en cache Redis (performances) - Priorité : Haute - Effort : 3 jours
- **Amélioration** : Queue system (jobs asynchrones) - Priorité : Moyenne - Effort : 5 jours
- **Amélioration** : Stockage S3 pour fichiers - Priorité : Moyenne - Effort : 3 jours
- **Amélioration** : Tests automatisés (PHPUnit) - Priorité : Haute - Effort : 10 jours


#### 10.3.2 Moyen terme (6-12 mois)

**Fonctionnalités :**

- **Module CRM complet** - Description : Opportunités, pipeline commercial, suivi prospects - Effort : 20 jours
- **Tableau de bord prédictif** - Description : IA pour prévisions trésorerie (ML) - Effort : 15 jours
- **Multi-devises avancé** - Description : Taux de change temps réel (API) - Effort : 5 jours
- **Workflow de validation** - Description : Circuit validation factures avant émission - Effort : 10 jours
- **Signature électronique** - Description : DocuSign ou équivalent - Effort : 7 jours


**Technique :**

- **API REST** - Description : Pour intégrations externes (ERP, comptabilité) - Effort : 15 jours
- **Application mobile** - Description : Flutter ou React Native (consultation) - Effort : 30 jours
- **Synchronisation comptable** - Description : Export FEC (Fichier des Écritures Comptables) - Effort : 10 jours
- **Multi-société** - Description : Plusieurs entités dans une instance - Effort : 20 jours


### 10.4 Roadmap

```
2025 Q1 (Janvier - Mars)
├── ✅ Déploiement production
├── ✅ Documentation complète
└── 🔄 Suivi et corrections bugs mineurs

2025 Q2 (Avril - Juin)
├── Module de devis
├── Export Excel rapports
├── Tests automatisés (PHPUnit)
└── Mise en cache Redis

2025 Q3 (Juillet - Septembre)
├── Gestion documentaire
├── Notifications email automatiques
├── Historique modifications
└── Queue system (jobs asynchrones)

2025 Q4 (Octobre - Décembre)
├── Module CRM complet
├── Multi-devises avancé
└── API REST (v1)

2026
├── Application mobile
├── Signature électronique
├── Multi-société
└── BI avancée (Power BI intégration)
```

---

## 11. VALIDATION ET RECETTE

### 11.1 Critères de validation technique

- **Critère** : Toutes les fonctionnalités prioritaires implémentées - Statut : ✅ VALIDÉ - Preuve : 9 modules complets (Client, Chantier, Facture, Tranche, Encaissement, Dashboard, Rapports, Paramètres, Import)
- **Critère** : Application déployée en production - Statut : ✅ VALIDÉ - Preuve : URL : https://factures-mazars-app.onrender.com/
- **Critère** : Base de données PostgreSQL opérationnelle - Statut : ✅ VALIDÉ - Preuve : 43 tables créées, relations définies
- **Critère** : HTTPS activé (SSL) - Statut : ✅ VALIDÉ - Preuve : Certificat Let's Encrypt automatique
- **Critère** : Authentification et autorisation fonctionnelles - Statut : ✅ VALIDÉ - Preuve : 2 rôles (Admin, Consultant) avec restrictions
- **Critère** : Calculs automatiques fiables - Statut : ✅ VALIDÉ - Preuve : Tests manuels concluants sur 50+ factures
- **Critère** : Import Excel fonctionnel - Statut : ✅ VALIDÉ - Preuve : Import clients, chantiers, budgets/factures testés
- **Critère** : Export PDF professionnel - Statut : ✅ VALIDÉ - Preuve : Génération PDF avec en-tête, tableaux, totaux
- **Critère** : Rapports et dashboard opérationnels - Statut : ✅ VALIDÉ - Preuve : Dashboard + 6 rapports (clôture, baromètre, etc.)
- **Critère** : Documentation technique complète - Statut : ✅ VALIDÉ - Preuve : GUIDE_TECHNIQUE.md (8104 lignes)


### 11.2 Critères de validation fonctionnelle

- **Processus** : Création client → Génération code automatique - Statut : ✅ VALIDÉ - Observations : Format U00001, V00001, etc. respecté
- **Processus** : Création chantier → Génération référence automatique - Statut : ✅ VALIDÉ - Observations : Format O00002A131025 respecté
- **Processus** : Création facture → Génération numéro automatique - Statut : ✅ VALIDÉ - Observations : Format FACT-2025-00001 respecté
- **Processus** : Création tranches → Validation somme = 100% - Statut : ✅ VALIDÉ - Observations : Validation JS + PHP bloque si ≠ 100%
- **Processus** : Encaissement → Mise à jour statuts cascade - Statut : ✅ VALIDÉ - Observations : Méthode `updateFactureStatus()` testée
- **Processus** : Clôture automatique chantier - Statut : ✅ VALIDÉ - Observations : Chantier.etat=false quand toutes factures payées
- **Processus** : Import Excel clients (100 lignes) - Statut : ✅ VALIDÉ - Observations : Temps : 7s, 100% succès
- **Processus** : Export PDF facture - Statut : ✅ VALIDÉ - Observations : Conforme maquette, montant en lettres OK
- **Processus** : Dashboard : Graphiques - Statut : ✅ VALIDÉ - Observations : 3 graphiques Chart.js fonctionnels
- **Processus** : Rapport baromètre - Statut : ✅ VALIDÉ - Observations : Vue SQL agrégée, tableau croisé OK
- **Processus** : Restrictions consultant - Statut : ✅ VALIDÉ - Observations : Pas d'accès création/modification/suppression


### 11.3 Tests et métriques

#### 11.3.1 Tests de performance

- **Test** : Chargement dashboard - Objectif : < 2s - Résultat : 1,3s - Statut : ✅
- **Test** : Liste 100 clients - Objectif : < 2s - Résultat : 1,5s - Statut : ✅
- **Test** : Liste 100 factures - Objectif : < 2s - Résultat : 1,8s - Statut : ✅
- **Test** : Génération PDF facture - Objectif : < 3s - Résultat : 2,1s - Statut : ✅
- **Test** : Import Excel 100 lignes - Objectif : < 10s - Résultat : 7s - Statut : ✅
- **Test** : Création chantier (8 étapes) - Objectif : < 30s - Résultat : ~25s - Statut : ✅


#### 11.3.2 Tests de sécurité

- **Test** : `APP_DEBUG=false` en production - Résultat : ✓ Vérifié - Statut : ✅
- **Test** : HTTPS obligatoire - Résultat : ✓ Redirection HTTP → HTTPS - Statut : ✅
- **Test** : Tokens CSRF sur formulaires - Résultat : ✓ Tous les formulaires protégés - Statut : ✅
- **Test** : Mots de passe hashés (bcrypt) - Résultat : ✓ Vérification table `users` - Statut : ✅
- **Test** : Protection injection SQL - Résultat : ✓ Utilisation exclusive Eloquent - Statut : ✅
- **Test** : Échappement XSS (Blade) - Résultat : ✓ Utilisation `{{ }}` partout - Statut : ✅
- **Test** : Sessions sécurisées - Résultat : ✓ Timeout 120min, cookies `httpOnly` - Statut : ✅


#### 11.3.3 Métriques de qualité

- **Nombre de lignes de code** - Valeur : ~50 000 (PHP + Blade + JS)
- **Nombre de fichiers** - Valeur : ~250
- **Taux de couverture tests** - Valeur : 0% (pas de tests automatisés)
- **Nombre de bugs critiques** - Valeur : 0 (connus à ce jour)
- **Nombre de bugs mineurs** - Valeur : 3 (non bloquants)
- **Temps moyen de réponse** - Valeur : 1,2s
- **Taux d'uptime (30 derniers jours)** - Valeur : 99,9%


---

## 12. DOCUMENTATION ET SUPPORT

### 12.1 Documentation fournie

- **GUIDE_TECHNIQUE.md** - Taille : 8104 lignes - Public cible : Développeurs débutants/confirmés - Statut : ✅ Complet
- **CAHIER_DES_CHARGES.md** - Taille : Ce document - Public cible : Chefs de projet, clients, développeurs - Statut : ✅ Complet
- **GUIDE_UTILISATEUR.md** - Taille : 1640 lignes - Public cible : Utilisateurs finaux (Admin, Consultant) - Statut : ✅ Complet
- **CLAUDE.md** - Taille : ~150 lignes - Public cible : Assistant IA (Claude Code) - Statut : ✅ À jour
- **README.md** - Taille : ~100 lignes - Public cible : Développeurs (installation rapide) - Statut : ✅ À jour


**Accessibilité :**
- Tous les documents sont dans le dossier `docs/` (sauf README.md et CLAUDE.md à la racine)
- Format Markdown (lisible sur GitHub, IDE, éditeurs de texte)
- Tables des matières détaillées
- Exemples de code nombreux
- Diagrammes ASCII art

### 12.2 Support et contacts

#### 12.2.1 Support technique

- **L1 - Incident mineur** - Contact : Consulter GUIDE_UTILISATEUR.md - Délai de réponse : Immédiat (auto-assistance)
- **L2 - Bug non bloquant** - Contact : Chef de projet : Gershom Ny Aina Fitia - Délai de réponse : 24h (jours ouvrés)
- **L3 - Bug critique** - Contact : Chef de projet + Admin technique - Délai de réponse : 2h
- **Infrastructure (Render)** - Contact : Support Render : support@render.com - Délai de réponse : Variable (selon plan)


#### 12.2.2 Demande d'évolution

**Processus :**
1. **Soumettre une demande** : Email au chef de projet avec description détaillée
2. **Analyse** : Étude de faisabilité (effort, impact, ROI)
3. **Priorisation** : Ajout à la roadmap selon priorité
4. **Planification** : Attribution sprint et développeur
5. **Développement** : Branche `feature/nom-evolution`
6. **Recette** : Tests par utilisateurs pilotes
7. **Déploiement** : Mise en production

**Délais indicatifs :**
- Évolution mineure (< 1 jour) : 1-2 semaines
- Évolution moyenne (1-5 jours) : 1 mois
- Évolution majeure (> 5 jours) : 2-3 mois

---

## 13. ANNEXES

### 13.1 Glossaire métier

Voir section [1.3 Définitions et acronymes](#13-définitions-et-acronymes) pour le glossaire complet.

### 13.2 Périmètre exclu

**Fonctionnalités NON incluses dans la version actuelle (v2.0) :**

- **Fonctionnalité** : Comptabilité complète (plan comptable, écritures) - Raison de l'exclusion : Hors périmètre initial - Évolution future possible
- **Fonctionnalité** : Gestion de paie - Raison de l'exclusion : Hors périmètre métier
- **Fonctionnalité** : CRM avancé (pipeline commercial, opportunités) - Raison de l'exclusion : Évolution future (roadmap 2025 Q4)
- **Fonctionnalité** : Gestion de stock - Raison de l'exclusion : Non applicable au métier du conseil
- **Fonctionnalité** : Module de devis - Raison de l'exclusion : Évolution future (roadmap 2025 Q2)
- **Fonctionnalité** : Application mobile native - Raison de l'exclusion : Évolution future (roadmap 2026)
- **Fonctionnalité** : API REST publique - Raison de l'exclusion : Évolution future (roadmap 2025 Q4)
- **Fonctionnalité** : Signature électronique - Raison de l'exclusion : Évolution future (roadmap 2026)
- **Fonctionnalité** : Paiement en ligne intégré - Raison de l'exclusion : Complexité réglementaire, hors périmètre
- **Fonctionnalité** : Multi-sociétés - Raison de l'exclusion : Évolution future (roadmap 2026)
- **Fonctionnalité** : Notifications push - Raison de l'exclusion : Non applicable (application web)
- **Fonctionnalité** : Mode hors ligne - Raison de l'exclusion : Non applicable (application web centralisée)
- **Fonctionnalité** : Import formats autres qu'Excel - Raison de l'exclusion : Format Excel suffisant pour les besoins actuels
- **Fonctionnalité** : Export formats autres que PDF/Excel - Raison de l'exclusion : Formats suffisants pour les besoins actuels


---

## CONCLUSION

Ce cahier des charges définit l'**Application de Gestion de Factures Mazars** dans son état actuel (version 2.0, production depuis janvier 2025). L'application couvre l'intégralité du cycle de facturation avec un haut niveau d'automatisation et de fiabilité.

**Points clés :**
- ✅ **Production** : Application déployée et opérationnelle
- ✅ **Complétude** : 9 modules fonctionnels couvrant tous les besoins
- ✅ **Qualité** : Calculs automatiques fiables, validations strictes
- ✅ **Sécurité** : HTTPS, authentification, protection CSRF/XSS/SQL Injection
- ✅ **Performance** : Temps de réponse < 2s, support de 10 000+ clients
- ✅ **Documentation** : 3 guides complets (8104 + 1640 + ce document)

**Évolutions prévues :**
- 2025 Q2 : Module devis, export Excel rapports, tests automatisés
- 2025 Q4 : Module CRM, API REST
- 2026 : Application mobile, signature électronique, multi-société

**Engagement qualité :**
Ce document sera maintenu à jour à chaque évolution majeure de l'application. Toute modification du périmètre fonctionnel ou technique donnera lieu à une nouvelle version du cahier des charges.

---

**Document validé le** : Janvier 2025
**Version** : 2.0
**Statut** : ✅ PRODUCTION
**URL** : https://factures-mazars-app.onrender.com/

**Propriété intellectuelle** : Ce document est la propriété du Cabinet Mazars. Toute reproduction, même partielle, est interdite sans autorisation écrite préalable.

---

**FIN DU CAHIER DES CHARGES**
