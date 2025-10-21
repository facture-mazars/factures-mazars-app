# GUIDE UTILISATEUR
## Application de Gestion de Factures

---

**Document** : Guide Utilisateur
**Version** : 2.0
**Date de publication** : Janvier 2025
**Statut** : Production
**Plateforme** : https://factures-mazars-app.onrender.com/

---

### Informations du Document

- **Titre** : Guide d'Utilisation - Application de Gestion de Factures
- **Auteur** : Équipe Technique
- **Public cible** : Utilisateurs finaux, Consultants, Administrateurs
- **Confidentialité** : Usage interne
- **Framework** : Laravel 11.x
- **Base de données** : PostgreSQL 14+

---

## Table des Matières

1. [Présentation Générale](#1-présentation-générale)
   - 1.1 [Objet du document](#11-objet-du-document)
   - 1.2 [Périmètre fonctionnel](#12-périmètre-fonctionnel)
   - 1.3 [Architecture technique](#13-architecture-technique)
   - 1.4 [Workflow de facturation](#14-workflow-de-facturation)

2. [Accès et Authentification](#2-accès-et-authentification)
   - 2.1 [Accès à l'application](#21-accès-à-lapplication)
   - 2.2 [Création de compte](#22-création-de-compte)
   - 2.3 [Connexion](#23-connexion)
   - 2.4 [Gestion des rôles](#24-gestion-des-rôles)

3. [Module Gestion des Clients](#3-module-gestion-des-clients)
   - 3.1 [Création d'un client](#31-création-dun-client)
   - 3.2 [Consultation de la liste des clients](#32-consultation-de-la-liste-des-clients)
   - 3.3 [Consultation de la fiche client](#33-consultation-de-la-fiche-client)
   - 3.4 [Modification d'un client](#34-modification-dun-client)
   - 3.5 [Suppression d'un client](#35-suppression-dun-client)

4. [Module Gestion des Chantiers](#4-module-gestion-des-chantiers)
5. [Module Gestion de la Facturation](#5-module-gestion-de-la-facturation)
6. [Module Gestion de l'Encaissement](#6-module-gestion-de-lencaissement)
7. [Clôture des Missions](#7-clôture-des-missions)
8. [Reporting et Statistiques](#8-reporting-et-statistiques)
9. [Système d'Alertes](#9-système-dalertes)
10. [Baromètre de Facturation](#10-baromètre-de-facturation)
11. [Bonnes Pratiques](#11-bonnes-pratiques)
12. [Support et Assistance](#12-support-et-assistance)

---

## 1. Présentation Générale

### 1.1 Objet du document

Le présent guide utilisateur a pour objet de fournir une documentation complète et détaillée sur l'utilisation de l'application de gestion de factures. Il s'adresse à l'ensemble des utilisateurs de l'application, qu'ils soient administrateurs ou consultants.

Ce document couvre l'intégralité des fonctionnalités de l'application, depuis la création d'un client jusqu'à la clôture complète d'une mission, en passant par la facturation et l'encaissement.

### 1.2 Périmètre fonctionnel

L'application de gestion de factures est un système intégré permettant de :

- **Gérer le référentiel clients** : Création, modification, consultation et archivage des données clients
- **Piloter les missions** : Création et suivi des chantiers/missions
- **Affecter les ressources** : Gestion des équipes et allocation des personnels
- **Budgétiser les projets** : Définition des budgets prévisionnels en jours/homme et montants
- **Facturer les prestations** : Création de factures avec gestion de tranches multiples
- **Suivre les encaissements** : Enregistrement et suivi des paiements reçus
- **Analyser l'activité** : Production de rapports statistiques et analytiques
- **Piloter par les alertes** : Système de notifications automatiques

### 1.3 Architecture technique

**Environnement de production**

L'application est déployée sur une infrastructure cloud moderne garantissant haute disponibilité et performance :

- **Hébergement** : Render (Web Service) - Cloud Platform
- **Base de données** : PostgreSQL (Managed) - Version 14+
- **Framework Backend** : Laravel - Version 11.x
- **Langage** : PHP - Version 8.2+
- **Frontend** : Blade Templates
- **URL de production** : https://factures-mazars-app.onrender.com/

**Compatibilité navigateurs**

L'application est compatible avec les navigateurs modernes suivants :
- Google Chrome (version 90+)
- Mozilla Firefox (version 88+)
- Microsoft Edge (version 90+)
- Safari (version 14+)

> **Note technique** : L'application utilise une mise en veille automatique après 15 minutes d'inactivité (limitation plateforme Render). Le premier accès de la journée peut nécessiter quelques secondes de chargement initial.

### 1.4 Workflow de facturation

L'application implémente un processus de facturation structuré en **10 étapes séquentielles** :

**Étape 1 : Clients**
- Module : Clients
- Description : Enregistrement des informations client (raison sociale, secteur, localisation)
- Acteurs : Administrateur

**Étape 2 : Chantiers**
- Module : Chantiers
- Description : Création de la mission (type, objet, périmètre géographique)
- Acteurs : Administrateur

**Étape 3 : Dates**
- Module : Dates
- Description : Planification temporelle (date début, date fin, référence chantier)
- Acteurs : Administrateur

**Étape 4 : Équipe**
- Module : Équipe
- Description : Affectation des ressources humaines par grade
- Acteurs : Administrateur

**Étape 5 : Budget**
- Module : Budget
- Description : Budgétisation (jours/homme, taux horaires, montants prévisionnels)
- Acteurs : Administrateur

**Étape 6 : Factures**
- Module : Factures
- Description : Création des factures et définition des tranches de paiement
- Acteurs : Administrateur

**Étape 7 : Émission**
- Module : Émission
- Description : Génération et émission des factures avec numérotation automatique
- Acteurs : Administrateur

**Étape 8 : Banque**
- Module : Banque
- Description : Sélection de la banque pour les encaissements
- Acteurs : Administrateur

**Étape 9 : Encaissement**
- Module : Encaissement
- Description : Enregistrement des paiements reçus (mode, date, montant)
- Acteurs : Administrateur

**Étape 10 : Clôture**
- Module : Clôture
- Description : Validation finale et archivage de la mission
- Acteurs : Système

**Schéma de flux**

```
Client → Chantier → Dates → Équipe → Budget → Facture → Tranches → Banque → Encaissement → Clôture
   |         |                  |        |         |                      |              |
   └─────────┴──────────────────┴────────┴─────────┴──────────────────────┴──────────────┘
                              Données persistées en PostgreSQL
```

### Prérequis techniques

Avant d'utiliser l'application, assurez-vous de disposer des éléments suivants :

- **Navigateur web** : Chrome, Firefox, Edge ou Safari (version récente)
- **Connexion internet** : Connexion stable avec débit minimum 1 Mbps
- **Identifiants** : Email et mot de passe fournis par l'administrateur
- **Résolution écran** : Minimum 1280x720 pixels (recommandé : 1920x1080)

---

## 2. Accès et Authentification

### 2.1 Accès à l'application

**URL de production**

L'application est accessible via l'URL suivante :

```
https://factures-mazars-app.onrender.com/
```

**Procédure d'accès**

1. Ouvrez votre navigateur web recommandé (Chrome, Firefox, Edge ou Safari)
2. Saisissez l'URL de production dans la barre d'adresse
3. Appuyez sur la touche `Entrée`
4. La page d'authentification s'affiche

**Points d'attention**

> **Note technique** : Lors du premier accès de la journée, l'application peut nécessiter un temps de chargement de 10 à 15 secondes. Ce délai est lié à la mise en veille automatique de la plateforme Render après 15 minutes d'inactivité. Ce comportement est normal et n'affecte pas le fonctionnement de l'application.

### 2.2 Création de compte

**Procédure d'inscription**

Les nouveaux utilisateurs peuvent créer un compte de manière autonome en suivant les étapes ci-dessous :

1. Depuis la page d'authentification, cliquez sur le lien **"S'inscrire"**
2. Le formulaire d'inscription s'affiche
3. Renseignez les champs obligatoires suivants :

**Champs du formulaire d'inscription :**

- **Nom** : Type Texte - Obligatoire, 2-50 caractères - Exemple : DUPONT
- **Prénom** : Type Texte - Obligatoire, 2-50 caractères - Exemple : Jean
- **Email** : Type Email - Obligatoire, format email valide, unique - Exemple : jean.dupont@entreprise.com
- **Mot de passe** : Type Mot de passe - Obligatoire, minimum 8 caractères - Exemple : ●●●●●●●●
- **Confirmation** : Type Mot de passe - Obligatoire, doit correspondre au mot de passe - Exemple : ●●●●●●●●

4. Validez en cliquant sur le bouton **"S'inscrire"**
5. Le compte est créé instantanément
6. Vous êtes automatiquement connecté et redirigé vers le tableau de bord

**Attribution automatique des rôles**

> **Important** : Tous les comptes créés via le formulaire d'inscription sont automatiquement affectés au **rôle Consultant** (accès en lecture seule). Il n'est pas possible de s'auto-attribuer le rôle Administrateur lors de l'inscription.
>
> Pour obtenir des droits d'administration, veuillez contacter l'administrateur système existant.

**Politique de sécurité**

- Les mots de passe sont chiffrés en base de données (algorithme bcrypt)
- Un email doit être unique dans le système
- Aucune vérification par email n'est requise (activation immédiate)

### 2.3 Connexion

**Procédure de connexion pour utilisateurs existants**

1. Depuis la page d'authentification, saisissez vos identifiants :
   - **Email** : L'adresse email utilisée lors de l'inscription
   - **Mot de passe** : Le mot de passe défini lors de la création du compte

2. Cliquez sur le bouton **"Connexion"**

3. Le système vérifie vos identifiants :
   - Si les identifiants sont corrects → Redirection vers le tableau de bord
   - Si les identifiants sont incorrects → Message d'erreur affiché

**Redirection post-connexion**

Après authentification réussie, vous êtes automatiquement redirigé vers :
- **Tableau de bord administrateur** : Si vous disposez du rôle Administrateur
- **Tableau de bord consultant** : Si vous disposez du rôle Consultant

**Gestion des erreurs d'authentification**

- **Email inconnu** : Message affiché "Ces identifiants ne correspondent pas à nos enregistrements" - Action : Vérifier l'email ou créer un compte
- **Mot de passe incorrect** : Message affiché "Ces identifiants ne correspondent pas à nos enregistrements" - Action : Vérifier le mot de passe
- **Compte désactivé** : Message affiché "Votre compte a été désactivé" - Action : Contacter l'administrateur

> **Note** : Pour des raisons de sécurité, le message d'erreur ne précise pas si l'email ou le mot de passe est incorrect.

### 2.4 Gestion des rôles

**Rôles disponibles**

L'application implémente un système de contrôle d'accès basé sur deux rôles distincts :

**1. Rôle Administrateur**

- **Niveau d'accès** : Complet (CRUD : Create, Read, Update, Delete)
- **Fonctionnalités** :
  - Gestion complète des clients
  - Création et modification des chantiers
  - Gestion de la facturation
  - Enregistrement des encaissements
  - Accès aux paramètres système
  - Gestion des utilisateurs
- **Interface** : Navbar et sidebar standards avec toutes les options
- **Création** : Un compte administrateur existe déjà dans le système (création manuelle uniquement)

**2. Rôle Consultant**

- **Niveau d'accès** : Lecture seule (Read only)
- **Fonctionnalités** :
  - Consultation des clients
  - Consultation des chantiers
  - Visualisation des factures
  - Consultation des statistiques
  - Accès aux rapports
- **Interface** : Navbar et sidebar spécifiques consultants (vues dédiées)
- **Création** : Automatique lors de toute nouvelle inscription

**Matrice des droits**

- **Module Clients** : Administrateur ✅ CRUD | Consultant 👁️ Lecture
- **Module Chantiers** : Administrateur ✅ CRUD | Consultant 👁️ Lecture
- **Module Factures** : Administrateur ✅ CRUD | Consultant 👁️ Lecture
- **Module Encaissements** : Administrateur ✅ CRUD | Consultant 👁️ Lecture
- **Module Statistiques** : Administrateur ✅ Lecture | Consultant 👁️ Lecture
- **Module Paramètres** : Administrateur ✅ CRUD | Consultant ❌ Aucun accès
- **Module Utilisateurs** : Administrateur ✅ CRUD | Consultant ❌ Aucun accès

**Demande d'élévation de privilèges**

Pour obtenir le rôle Administrateur, veuillez contacter l'administrateur système avec les informations suivantes :
- Nom complet
- Email du compte
- Justification de la demande

---

## 3. Module Gestion des Clients

Le module Gestion des Clients constitue la **première étape** du workflow de facturation. Il permet de créer, consulter, modifier et archiver les fiches clients nécessaires à la facturation des prestations.

> **Rappel workflow** : Étape 1/10 - La création d'un client est un prérequis obligatoire avant toute création de chantier.

### 3.1 Création d'un client

**Contexte fonctionnel**

La création d'une fiche client est l'opération initiale permettant d'enregistrer les informations relatives à un nouveau client dans le référentiel. Cette opération est réservée aux utilisateurs disposant du rôle Administrateur.

**Accès à la fonctionnalité**

1. Depuis le menu principal, cliquez sur **"Clients"** dans la barre latérale gauche (sidebar)
2. La page de liste des clients s'affiche
3. Cliquez sur le bouton **"Nouveau Client"** (bouton vert situé en haut à droite de la page)
4. Le formulaire de création s'affiche

**Structure du formulaire**

Le formulaire de création est organisé en quatre sections thématiques distinctes.

**Section 1 : Informations de base**

- **Nom du client** : Type Texte - ✅ Obligatoire - Règle : Raison sociale complète - Exemple : UNION DES MECK
- **Code client** : Type Texte - ✅ Obligatoire - Règle : Auto-généré (1re lettre + séquence) - Exemple : U00001
- **Sigle** : Type Texte - ⚪ Non obligatoire - Règle : Abréviation/Acronyme - Exemple : UDM

> **Règle de génération du code client** : Le code est automatiquement généré selon le pattern `[Première lettre du nom][Séquence sur 5 chiffres]`. Exemple : Pour "UNION DES MECK", si c'est le premier client commençant par "U", le code sera `U00001`. Le code peut être modifié manuellement si nécessaire.

**Section 2 : Informations de localisation**

- **Adresse** : Type Texte long - ⚪ Non obligatoire - Adresse complète du siège social - Exemple : 123 Avenue de la République
- **Pays** : Type Liste déroulante - ✅ Obligatoire - Pays de domiciliation - Exemples : France, Madagascar, Sénégal
- **Pays groupe** : Type Liste déroulante - ⚪ Non obligatoire - Regroupement géographique - Exemples : Afrique de l'Ouest, Europe
- **Zone géographique** : Type Liste déroulante - ⚪ Non obligatoire - Macro-zone - Exemples : Afrique, Europe, Asie, Amérique

**Section 3 : Informations juridiques et sectorielles**

- **Forme juridique** : Type Liste déroulante - ⚪ Non obligatoire - Statut juridique - Valeurs : SA, SARL, SAS, EURL, Association, ONG
- **Secteur d'activité** : Type Liste déroulante - ⚪ Non obligatoire - Domaine d'activité principal - Valeurs : Banque, Assurance, Industrie, Services, Santé
- **Ligne métier** : Type Liste déroulante - ⚪ Non obligatoire - Type de prestation - Valeurs : Audit, Conseil, Expertise comptable, Juridique

**Section 4 : Informations complémentaires**

- **Capital social** : Type Numérique - ⚪ Non obligatoire - Montant du capital en devise locale - Exemple : 10000000
- **Numéro de registre** : Type Texte - ⚪ Non obligatoire - Immatriculation légale (RCCM, SIRET, etc.) - Exemple : 2024B12345
- **Téléphone** : Type Texte - ⚪ Non obligatoire - Numéro principal - Exemple : +261 34 12 345 67
- **Email** : Type Email - ⚪ Non obligatoire - Adresse de contact - Exemple : contact@uniondesmeck.com

**Fonctionnalité avancée : Ajout dynamique de pays**

Si le pays souhaité n'apparaît pas dans la liste déroulante :

1. Sélectionnez l'option **"Ajouter un nouveau pays"** dans la liste déroulante **Pays**
2. Une fenêtre modale (popup) s'affiche avec un formulaire de création de pays
3. Renseignez les informations suivantes :
   - **Nom du pays** (obligatoire)
   - **Code ISO** (optionnel) : Code ISO 3166-1 alpha-2 ou alpha-3
   - **Zone géographique** (optionnel)
4. Cliquez sur **"Enregistrer"**
5. Le pays est créé en base de données
6. Il est automatiquement sélectionné dans le formulaire client
7. La fenêtre modale se ferme

**Validation et enregistrement**

1. Vérifiez que tous les champs obligatoires (marqués d'un astérisque *) sont renseignés
2. Vérifiez la cohérence des informations saisies
3. Cliquez sur le bouton **"Enregistrer"** (bouton bleu situé en bas du formulaire)
4. Le système valide les données :
   - Si validation OK → Message de confirmation affiché + redirection vers la liste
   - Si validation KO → Messages d'erreur affichés sous les champs concernés
5. Le nouveau client apparaît dans le tableau de la liste des clients

**Messages système**

- ✅ Succès : "Client créé avec succès"
- ❌ Erreur : "Le champ [nom du champ] est obligatoire"
- ❌ Erreur : "Un client avec ce code existe déjà"

### 3.2 Consultation de la liste des clients

**Contexte fonctionnel**

La liste des clients permet de visualiser l'ensemble du référentiel client sous forme tabulaire avec des fonctionnalités de recherche, tri et pagination.

**Accès à la liste**

1. Depuis le menu principal, cliquez sur **"Clients"** dans la barre latérale gauche
2. La page de liste s'affiche automatiquement
3. Le tableau présente tous les clients actifs du système

**Structure du tableau**

Le tableau de liste présente les colonnes suivantes :

- **Code Client** : Texte - Identifiant unique du client - Exemple : U00001
- **Nom Client** : Texte - Raison sociale complète - Exemple : UNION DES MECK
- **Sigle** : Texte - Abréviation - Exemple : UDM
- **Adresse** : Texte - Adresse complète - Exemple : 123 Av. de la République
- **Pays** : Texte - Pays de domiciliation - Exemple : Madagascar
- **Secteur** : Texte - Secteur d'activité - Exemple : Banque
- **Détails** : Action - Bouton d'accès à la fiche détaillée - Icône œil 👁️
- **Actions** : Actions - Boutons Modifier / Supprimer - Icônes ✏️ / 🗑️

**Fonctionnalités de recherche et de filtrage**

- **Barre de recherche** : Filtre global multi-colonnes - Tapez un mot-clé (nom, code, pays, secteur) pour filtrer instantanément
- **Tri des colonnes** : Tri ascendant/descendant - Cliquez sur un en-tête de colonne pour trier
- **Pagination** : Navigation par pages - Utilisez les boutons < Précédent / Suivant > en bas du tableau
- **Nombre d'éléments** : Sélection du nombre de lignes affichées - Choisissez 10, 25, 50 ou 100 éléments par page

**Actions disponibles**

- **Créer un client** : Bouton "Nouveau Client" (vert) en haut à droite
- **Consulter les détails** : Icône œil 👁️ dans la colonne "Détails"
- **Modifier un client** : Icône crayon ✏️ dans la colonne "Actions"
- **Supprimer un client** : Icône poubelle 🗑️ dans la colonne "Actions"

### 3.3 Consultation de la fiche client

**Contexte fonctionnel**

La fiche client permet de consulter l'intégralité des informations relatives à un client ainsi que l'ensemble des éléments associés (chantiers, factures, statistiques).

**Accès à la fiche**

1. Depuis la liste des clients, repérez le client concerné
2. Cliquez sur le bouton **"Détails"** (icône œil 👁️) sur la ligne correspondante
3. La page de détail s'affiche

**Contenu de la fiche client**

La fiche client est organisée en plusieurs sections :

**Section 1 : Informations générales**
- Code client
- Raison sociale
- Sigle
- Forme juridique
- Adresse complète
- Pays, zone géographique
- Secteur d'activité, ligne métier
- Informations de contact (téléphone, email)

**Section 2 : Statistiques**
- Nombre total de chantiers (actifs et clôturés)
- Montant total facturé (cumulé)
- Nombre de factures émises
- Taux de recouvrement (%)

**Section 3 : Chantiers associés**
- Tableau listant tous les chantiers du client
- Colonnes : Référence, Objet, Date début, Date fin, Statut, Actions
- Accès direct aux chantiers via liens

**Section 4 : Historique**
- Date de création de la fiche
- Date de dernière modification
- Auteur des dernières modifications

### 3.4 Modification d'un client

**Contexte fonctionnel**

La modification permet de mettre à jour les informations d'un client existant. Cette opération est réservée aux administrateurs.

**Accès à la modification**

1. Depuis la liste des clients, repérez le client à modifier
2. Cliquez sur le bouton **"Modifier"** (icône crayon ✏️ ou bouton jaune)
3. Le formulaire de modification s'affiche (structure identique au formulaire de création)

**Règles de modification**

- **Champs modifiables** : Tous les champs sauf le code client
- **Code client** : ❌ Non modifiable (intégrité référentielle)
- **Champs obligatoires** : Même contraintes que lors de la création
- **Propagation** : Les modifications sont automatiquement répercutées sur les entités liées (chantiers, factures)

**Procédure de modification**

1. Modifiez les champs souhaités
2. Vérifiez la cohérence des données
3. Cliquez sur **"Enregistrer"**
4. Le système valide et enregistre les modifications
5. Message de confirmation affiché : "Client modifié avec succès"
6. Redirection vers la liste des clients

> **Important** : Les modifications apportées à un client (nom, sigle, adresse) sont automatiquement reflétées dans tous les chantiers et factures associés. Aucune action manuelle n'est requise.

### 3.5 Suppression d'un client

**Contexte fonctionnel**

La suppression permet de retirer un client du référentiel actif. L'application implémente une suppression logique (soft delete) pour préserver l'historique et l'intégrité des données.

**Accès à la suppression**

1. Depuis la liste des clients, repérez le client à supprimer
2. Cliquez sur le bouton **"Supprimer"** (icône poubelle 🗑️ ou bouton rouge)
3. Une fenêtre modale de confirmation s'affiche

**Procédure de suppression**

1. Lisez attentivement le message d'avertissement affiché
2. Si vous confirmez la suppression, cliquez sur **"Confirmer"**
3. Le système vérifie les contraintes d'intégrité
4. Si la suppression est autorisée :
   - Le client est marqué comme inactif (`actif = false`)
   - Message de confirmation : "Client supprimé avec succès"
   - Le client disparaît de la liste active
5. Si la suppression est refusée :
   - Message d'erreur explicatif affiché
   - Le client reste dans la liste

**Contraintes d'intégrité référentielle**

La suppression d'un client est **bloquée** dans les cas suivants :

- **Chantiers associés** : Le client possède des chantiers (actifs ou clôturés) - Action : Supprimer ou archiver tous les chantiers du client
- **Factures en cours** : Des factures existent pour ce client - Action : Clôturer ou supprimer toutes les factures
- **Encaissements** : Des encaissements sont enregistrés - Action : Supprimer les encaissements (non recommandé)

> **⚠️ Avertissement** : La suppression d'un client ayant des données associées est **bloquée par le système** pour préserver l'intégrité des données. Vous devez d'abord traiter tous les éléments dépendants avant de procéder à la suppression.

**Mécanisme de suppression logique (soft delete)**

L'application n'effectue **jamais de suppression physique** des clients. Le mécanisme implémenté est le suivant :

- **Méthode** : Suppression logique (soft delete)
- **Technique** : Le champ `actif` passe de `true` à `false`
- **Présence en base** : Les données restent dans la table `client`
- **Affichage** : Le client n'apparaît plus dans les listes actives
- **Récupération** : Possible via intervention technique en base de données
- **Intégrité** : Préservation totale de l'historique et des relations

**Archivage vs Suppression**

Pour les clients inactifs mais devant être conservés pour audit ou historique, privilégiez l'archivage plutôt que la suppression. Contactez l'administrateur système pour mettre en place une politique d'archivage adaptée.

---

## 4. Module Gestion des Chantiers

Le module Gestion des Chantiers couvre les **étapes 2 à 5** du workflow de facturation. Il permet de créer et piloter les missions depuis la définition initiale jusqu'à la budgétisation complète.

> **Rappel workflow** : Étapes 2-5/10 - La création d'un chantier nécessite un client existant et se déroule en 4 sous-étapes séquentielles.

### 4.1 Création d'un chantier

**Contexte fonctionnel**

La création d'un chantier est un processus multi-étapes permettant de définir progressivement tous les paramètres d'une mission : informations générales, planification temporelle, affectation des ressources humaines et budgétisation. Cette opération est réservée aux administrateurs.

**Architecture du processus de création**

Le processus de création suit un workflow séquentiel en 4 étapes obligatoires :

- **Étape 1/4 - Informations générales** : Définir le périmètre de la mission - Données : Client, type mission, objet, pays, monnaie
- **Étape 2/4 - Gestion des dates** : Planifier temporellement - Données : Dates début/fin, référence chantier
- **Étape 3/4 - Affectation équipe** : Constituer l'équipe projet - Données : Sélection des membres par grade
- **Étape 4/4 - Budgétisation** : Chiffrer la mission - Données : Jours/homme, taux, montants

---

#### 4.1.1 Étape 1/4 - Informations générales

**Accès à l'étape**

1. Depuis le menu principal, cliquez sur **"Chantiers"** dans la barre latérale gauche
2. Cliquez sur le bouton **"Nouveau Chantier"** (bouton vert en haut à droite)
3. Le formulaire de l'étape 1 s'affiche

**Champs du formulaire**

- **Client** : Type Liste déroulante avec recherche (Select2) - ✅ Obligatoire - Client bénéficiaire de la mission - Exemple : UNION DES MECK
- **Type de mission** : Type Liste déroulante - ✅ Obligatoire - Catégorie de prestation - Exemple : Revue / audit de projet IT
- **Objet de la mission** : Type Texte long - ✅ Obligatoire - Description détaillée de la mission - Exemple : Audit complet du système d'information...
- **Pays d'intervention** : Type Liste déroulante - ✅ Obligatoire - Pays où se déroule la mission - Exemple : Madagascar
- **Monnaie** : Type Liste déroulante - ✅ Obligatoire - Devise de facturation - Exemple : Ariary (MGA)

**Fonctionnalité de recherche client (Select2)**

Le champ "Client" utilise une interface de recherche dynamique :
- Tapez les premières lettres du nom du client
- La liste se filtre automatiquement
- Sélectionnez le client dans la liste déroulante
- Le code client s'affiche entre parenthèses

**Navigation**

- Bouton **"Suivant"** : Validation et passage à l'étape 2 (Gestion des dates)
- Les données sont sauvegardées temporairement

---

#### 4.1.2 Étape 2/4 - Gestion des dates

**Champs du formulaire**

- **Date de début** : Type Date (sélecteur) - ✅ Obligatoire - Date de démarrage de la mission - Format : JJ/MM/AAAA
- **Date de fin estimée** : Type Date (sélecteur) - ✅ Obligatoire - Date de fin prévisionnelle - Format : JJ/MM/AAAA
- **Référence chantier** : Type Texte - ✅ Obligatoire - Identifiant unique du chantier - Exemple : O00002A131025

**Règle de génération de la référence chantier**

La référence chantier suit le pattern suivant :

```
[Code Client][Code Type Mission][MMAA]
```

Composants de la référence :
- **Code Client** : Code du client sélectionné à l'étape 1 - Exemple : O00002
- **Code Type Mission** : Code automatique du type de mission - Exemple : A13
- **MMAA** : Mois (2 chiffres) + Année (2 chiffres) - Exemple : 1025 (Octobre 2025)

**Exemple complet** : `O00002A131025`
- O00002 : Client "UNION DES MECK"
- A13 : Type mission "Audit"
- 1025 : Octobre 2025

> **Note** : La première partie de la référence (Code Client + Code Type Mission) est générée automatiquement. Vous devez compléter manuellement la partie date (MMAA).

**Navigation**

- Bouton **"Précédent"** : Retour à l'étape 1 (modification possible)
- Bouton **"Suivant"** : Validation et passage à l'étape 3 (Affectation équipe)

---

#### 4.1.3 Étape 3/4 - Affectation de l'équipe

**Contexte**

Cette étape permet de constituer l'équipe qui interviendra sur le chantier. Les membres du personnel sont organisés par grade pour faciliter la sélection.

**Interface de sélection**

Les employés disponibles sont affichés dans des sections par grade :

- **Junior** : Personnel débutant - Exemples : Auditeur junior, Assistant
- **Senior** : Personnel expérimenté - Exemples : Auditeur senior, Consultant
- **Manager** : Encadrement - Exemples : Chef de mission, Manager
- **Partner** : Direction - Exemples : Associé, Directeur

**Procédure de sélection**

1. Parcourez les différentes sections de grades
2. Cochez les cases correspondant aux membres à affecter
3. Vous pouvez sélectionner **plusieurs membres par grade**
4. Les membres sélectionnés sont mis en évidence visuellement

**Règles de gestion**

- ✅ Aucun minimum requis (une équipe peut avoir un seul membre)
- ✅ Aucun maximum (sélection libre)
- ✅ Mixité des grades possible

**Navigation**

- Bouton **"Précédent"** : Retour à l'étape 2 (modification possible)
- Bouton **"Suivant"** : Validation et passage à l'étape 4 (Budgétisation)

---

#### 4.1.4 Étape 4/4 - Budgétisation

**Contexte**

Cette étape finale permet de budgétiser la mission en définissant pour chaque membre de l'équipe le nombre de jours/homme et le taux journalier. Les calculs de totaux sont automatiques.

**Tableau de budgétisation**

Pour chaque membre sélectionné à l'étape 3, le tableau affiche :

- **Nom** : Affichage automatique - Nom complet du membre - Exemple : Jean DUPONT
- **Grade** : Affichage automatique - Grade du membre - Exemple : Senior
- **Nb jours/homme** : Saisie numérique manuelle - Nombre de jours prévus - Exemple : 15
- **Taux journalier** : Saisie numérique manuelle - Taux en devise sélectionnée - Exemple : 500000
- **Total** : Calcul automatique - Nb jours × Taux - Exemple : 7500000

**Calculs automatiques - Totaux globaux**

Le système calcule automatiquement en temps réel :

- **Total jours/homme** : Formule Σ(Nb jours/homme) - Somme de tous les jours/homme
- **Taux horaire moyen** : Formule Σ(Totaux) / Σ(Nb jours/homme) - Moyenne pondérée des taux
- **Total honoraires** : Formule Σ(Totaux) - Montant total du budget

**Contraintes de validation**

- ❌ Les jours/homme ne peuvent être négatifs ou nuls
- ❌ Les taux ne peuvent être négatifs ou nuls
- ✅ Support des décimales (virgule ou point)

**Finalisation**

1. Vérifiez que tous les champs sont remplis
2. Vérifiez la cohérence des totaux calculés
3. Cliquez sur **"Valider"**
4. Le chantier est créé en base de données
5. Vous êtes automatiquement redirigé vers l'étape suivante du workflow global : **Création de facture**

**Messages système**

- ✅ Succès : "Chantier créé avec succès"
- ❌ Erreur : "Le nombre de jours/homme doit être supérieur à 0"
- ❌ Erreur : "Le taux journalier ne peut être vide"

---

### 4.2 Consultation de la liste des chantiers

**Contexte fonctionnel**

La liste des chantiers permet de visualiser l'ensemble des missions enregistrées dans le système avec des capacités de recherche et de filtrage.

**Accès à la liste**

1. Depuis le menu principal, cliquez sur **"Chantiers"** dans la barre latérale gauche
2. La liste complète des chantiers s'affiche sous forme de tableau

**Structure du tableau**

- **Référence** : Référence unique du chantier - Exemple : O00002A131025
- **Client** : Nom du client - Exemple : UNION DES MECK
- **Objet** : Résumé de la mission - Exemple : Audit SI
- **Type mission** : Catégorie de prestation - Exemple : Audit
- **Date début** : Date de démarrage - Exemple : 15/10/2025
- **Date fin** : Date de fin prévue - Exemple : 30/11/2025
- **Statut** : État de complétude - Valeurs : En cours / Complet
- **Actions** : Boutons Détails / Modifier / Supprimer - Icônes

**Fonctionnalités disponibles**

- **Barre de recherche** : Filtre global sur toutes les colonnes
- **Tri des colonnes** : Cliquez sur les en-têtes pour trier
- **Pagination** : Navigation par pages
- **Filtres avancés** : Par statut, par client, par période

**Statuts possibles**

- **En cours** : Chantier actif, non clôturé - Badge bleu
- **Complet** : Chantier clôturé, toutes factures payées - Badge vert

### 4.3 Modification d'un chantier

La modification d'un chantier permet de mettre à jour les informations après création. Le processus suit les mêmes 4 étapes que la création.

**Accès** : Bouton "Modifier" dans la liste des chantiers ou dans la fiche détaillée.

> **Important** : La modification d'un chantier ayant des factures associées peut impacter les montants. Vérifiez la cohérence avec les factures existantes.

### 4.4 Suppression d'un chantier

La suppression est soumise aux mêmes contraintes d'intégrité référentielle que les clients.

**Contraintes** : Un chantier avec des factures ou encaissements ne peut être supprimé.

---

## 5. Module Gestion de la Facturation

Le module Gestion de la Facturation couvre les **étapes 6 et 7** du workflow global. Il permet de créer des factures avec gestion de tranches multiples, d'émettre les factures et de suivre les prévisions de recouvrement.

> **Rappel workflow** : Étapes 6-7/10 - La création de factures nécessite un chantier existant avec budget validé.

### 5.1 Création d'une facture et gestion des tranches

**Contexte fonctionnel**

La facturation permet de définir les modalités de paiement d'un chantier en créant une ou plusieurs tranches de facturation. Cette fonctionnalité supporte le paiement échelonné sur plusieurs périodes.

**Processus de création**

La création d'une facture se déroule en 2 sous-étapes :

- **Sous-étape 1/2** : Définir les débours et le nombre de tranches - Données : Débours décaissables/non décaissables, nombre de tranches
- **Sous-étape 2/2** : Détailler chaque tranche de paiement - Données : Pourcentages, dates, taxes

---

#### 5.1.1 Sous-étape 1/2 - Définition des débours

**Accès**

- **Après création d'un chantier** : Redirection automatique vers la création de facture
- **Accès manuel** : Menu "Factures" > "Nouvelle Facture" > Sélection du chantier

**Champs du formulaire**

- **Débours décaissables** : Type Numérique - ⚪ Non obligatoire - Montant des dépenses remboursables - Exemple : 1500000
- **Débours non décaissables** : Type Numérique - ⚪ Non obligatoire - Montant des dépenses non remboursables - Exemple : 500000
- **Total débours** : Calcul automatique - Somme des deux types de débours - Exemple : 2000000
- **Nombre de tranches** : Type Liste déroulante - ✅ Obligatoire - Nombre de tranches de paiement - Exemple : 3

**Règles de calcul**

```
Total débours = Débours décaissables + Débours non décaissables
```

**Navigation**

- Bouton **"Suivant"** : Validation et passage à la gestion des tranches

---

#### 5.1.2 Sous-étape 2/2 - Gestion des tranches de facturation

**Contexte**

Cette étape permet de répartir le montant total (honoraires + débours) sur plusieurs tranches de paiement avec des dates d'émission et de recouvrement distinctes.

**Tableau de gestion des tranches**

Pour chaque tranche (sauf la dernière), saisissez :

- **Nom de la tranche** : Type Texte - Saisie manuelle - Libellé de la tranche - Exemple : Tranche 1
- **% Honoraire** : Type Numérique - Saisie manuelle - Pourcentage des honoraires - Exemple : 30 - Contrainte : Σ = 100%
- **Montant Honoraire** : Calcul automatique - % × Total honoraires budget - Exemple : 2250000
- **% Débours** : Type Numérique - Saisie manuelle - Pourcentage des débours - Exemple : 30 - Contrainte : Σ = 100%
- **Montant Débours** : Calcul automatique - % × Total débours - Exemple : 600000
- **Date prévisionnelle facture** : Type Date - Saisie manuelle - Date prévue d'émission - Exemple : 15/11/2025
- **Date de recouvrement** : Type Date - Saisie manuelle - Date prévue de paiement - Exemple : 30/11/2025

**Règle de gestion - Dernière tranche**

Pour la dernière tranche, le système applique une règle automatique :

```
% Honoraire dernière tranche = 100% - Σ(% Honoraires tranches précédentes)
% Débours dernière tranche = 100% - Σ(% Débours tranches précédentes)
```

> **Important** : Pour la dernière tranche, seules les **dates** sont à saisir. Les pourcentages et montants sont calculés automatiquement pour atteindre exactement 100%.

**Validation de la répartition à 100%**

Le système vérifie automatiquement :
- ✅ La somme des % honoraires doit égaler 100%
- ✅ La somme des % débours doit égaler 100%
- ❌ Si total ≠ 100% → Message d'erreur + blocage de la validation

**Sélection des taxes**

Avant validation finale, cochez les taxes applicables :

- **TVA** : Taxe sur la Valeur Ajoutée - Taux variable selon pays - Application sur honoraires
- **IMP** : Impôt sur les montants perçus - Taux variable selon pays - Application sur honoraires

**Finalisation**

1. Vérifiez la répartition des pourcentages
2. Vérifiez la cohérence des dates
3. Sélectionnez les taxes applicables
4. Cliquez sur **"Valider"**
5. La facture et ses tranches sont enregistrées en base
6. Statut initial : **Facture à émettre** (non encore émise)

**Messages système**

- ✅ Succès : "Facture créée avec succès"
- ❌ Erreur : "La somme des pourcentages d'honoraires doit égaler 100%"
- ❌ Erreur : "La date de recouvrement doit être postérieure à la date de facture"

---

### 5.2 Liste des factures à émettre

**Contexte fonctionnel**

Cette liste présente toutes les factures créées mais non encore émises officiellement. L'émission officielle génère le numéro de facture définitif.

**Accès**

Menu **"Factures"** > **"Factures à émettre"**

**Actions disponibles**

- **Voir facture** : Prévisualiser la facture avant émission - Résultat : Affichage modal
- **Modifier tranches** : Modifier les tranches avant émission - Résultat : Formulaire éditable
- **Émettre la facture** : Émettre officiellement la facture - Résultat : Génération n° facture + passage en "Émises"

**Procédure d'émission d'une facture**

1. Repérez la facture à émettre dans la liste
2. Cliquez sur **"Voir facture"**
3. Une prévisualisation s'affiche (modal ou page)
4. Vérifiez attentivement les informations
5. Cliquez sur **"Facturer"**
6. Un popup s'affiche demandant la **date réelle de facturation**
7. Saisissez la date d'émission effective
8. Validez
9. Le système génère automatiquement le **numéro de facture** selon le pattern : `n°[Trigramme]-[Séquence]`
10. La facture passe du statut "À émettre" au statut "Émise"
11. Elle disparaît de cette liste et apparaît dans "Factures émises"

**Règle de génération du numéro de facture**

Pattern : `n°[Trigramme]-[Séquence]`

Exemple : `n°ABC-00001`
- ABC = Trigramme du personnel responsable
- 00001 = Numéro séquentiel

---

### 5.3 Liste des factures émises

**Contexte fonctionnel**

Cette liste présente toutes les factures officiellement émises avec leur numéro définitif. Ces factures peuvent être exportées en PDF et envoyées aux clients.

**Accès**

Menu **"Factures"** > **"Factures émises"**

**Fonctionnalités disponibles**

- **Visualisation détaillée** : Affichage de toutes les informations de la facture
- **Exportation PDF** : Génération du document PDF officiel
- **Recherche** : Par numéro de facture, date, client, montant
- **Filtrage** : Par période, par statut de paiement
- **Tri** : Par toutes les colonnes du tableau

**Colonnes du tableau**

- **N° Facture** : Numéro unique généré
- **Client** : Nom du client facturé
- **Chantier** : Référence du chantier
- **Date émission** : Date d'émission officielle
- **Montant total** : Total honoraires + débours + taxes
- **Statut paiement** : Non payé / Partiel / Totalement payé
- **Actions** : PDF / Détails / Encaissement

---

### 5.4 Exportation de factures en PDF

**Contexte fonctionnel**

L'exportation PDF permet de générer un document officiel de facture conforme pour envoi au client.

**Procédure d'exportation**

1. Depuis la liste des factures émises, repérez la facture à exporter
2. Cliquez sur le bouton **"PDF"** (icône ou bouton rouge)
3. Le système génère le document PDF
4. Le fichier est téléchargé automatiquement dans le dossier de téléchargements de votre navigateur
5. Nom du fichier : `Facture_[N°Facture]_[Date].pdf`

**Contenu du document PDF**

Le PDF généré contient les sections suivantes :

- **En-tête** : Logo société, informations société (RCCM, adresse, contact)
- **Informations client** : Raison sociale, adresse, pays
- **Références** : Numéro de facture, date d'émission, référence chantier
- **Objet** : Description de la mission facturée
- **Tableau récapitulatif** : Lignes : Honoraires, Débours, Sous-total, Taxes, **Total général**
- **Montants en lettres** : Conversion automatique du total en toutes lettres
- **Modalités de paiement** : Coordonnées bancaires, modes de paiement acceptés
- **Conditions** : Délai de paiement, pénalités de retard

**Conversion montants en lettres**

Le système utilise la bibliothèque `kwn/number-to-words` pour convertir automatiquement les montants en toutes lettres en français.

Exemple : `7 850 000 Ariary` → `Sept millions huit cent cinquante mille Ariary`

---

### 5.5 Prévisions de recouvrement

**Contexte fonctionnel**

Le module de prévisions de recouvrement permet d'anticiper les encaissements futurs basés sur les dates prévisionnelles saisies lors de la création des tranches.

**Accès**

Menu **"Factures"** > **"Prévisions de recouvrement"**

**Informations affichées**

- **Factures à recouvrer** : Liste des tranches non encore payées - Utilité : Suivi des impayés
- **Dates limites** : Dates de recouvrement prévisionnelles - Utilité : Planification trésorerie
- **Montants dus** : Montants restant à encaisser - Utilité : Prévisions financières
- **État du recouvrement** : Pourcentage encaissé / Total - Utilité : Indicateur de performance
- **Retards** : Tranches dépassant la date prévue - Utilité : Identification des retards

**Filtrage par période**

- Vue mensuelle
- Vue trimestrielle
- Vue annuelle
- Période personnalisée

**Export des prévisions**

Les prévisions peuvent être exportées en :
- Excel (XLSX)
- CSV
- PDF

---

## 6. Module Gestion de l'Encaissement

Le module Gestion de l'Encaissement couvre les **étapes 8 et 9** du workflow global. Il permet d'enregistrer les paiements reçus pour chaque tranche de facture et de suivre l'évolution du recouvrement.

> **Rappel workflow** : Étapes 8-9/10 - L'encaissement nécessite une facture émise et le choix préalable d'une banque.

### 6.1 Création d'un encaissement

**Contexte fonctionnel**

La création d'un encaissement permet d'enregistrer un paiement reçu pour une tranche de facture spécifique. Cette opération met à jour automatiquement le statut de la facture et peut déclencher la clôture automatique du chantier si toutes les tranches sont payées.

**Accès à la fonctionnalité**

- **Accès rapide** : Après export PDF > Bouton "Créer l'encaissement" - Depuis la visualisation de facture
- **Accès menu** : Menu "Encaissements" > "Nouvel encaissement" - Accès direct depuis le menu
- **Accès facture** : Liste des factures émises > Bouton "Encaissement" - Depuis la liste des factures

**Sélection de la tranche à encaisser**

1. Le système affiche la liste des tranches de la facture sélectionnée
2. Repérez la tranche concernée par le paiement reçu
3. Sélectionnez la tranche via radio button ou liste déroulante
4. Le formulaire d'encaissement s'affiche

**Formulaire d'encaissement**

- **Date d'encaissement probable** : Type Date - ⚪ Non obligatoire - Date prévue du paiement (renseignée lors de la création de tranche) - Exemple : 30/11/2025
- **Date d'encaissement réel** : Type Date - ✅ Obligatoire - Date effective de réception du paiement - Exemple : 02/12/2025
- **Mode de paiement** : Type Liste déroulante - ✅ Obligatoire - Moyen de paiement utilisé - Exemples : Chèque, Virement, Espèces, Carte bancaire
- **Banque** : Type Liste déroulante - ✅ Obligatoire - Banque de réception (choix préalable requis) - Exemples : BMOI, BNI-CL, BOA
- **Type de chèque** : Type Liste déroulante dynamique - ⚪ Conditionnel - Type si mode = Chèque (chargement automatique) - Exemples : Chèque barré, Chèque certifié
- **Numéro de référence** : Type Texte - ⚪ Non obligatoire - Numéro de chèque ou de virement - Exemples : CHQ123456, VIR789012
- **Montant encaissé** : Affichage - Montant de la tranche (lecture seule) - Exemple : 2 850 000

**Règle de chargement dynamique**

```
Si Mode de paiement = "Chèque"
Alors
    → Chargement AJAX des types de chèques depuis la table choix_banque
    → Affichage de la liste déroulante "Type de chèque"
    → Champ devient obligatoire
Sinon
    → Champ "Type de chèque" masqué
Fin Si
```

**Validation et enregistrement**

1. Vérifiez les informations saisies
2. Cliquez sur **"Valider"**
3. Le système enregistre l'encaissement en base de données
4. **Mise à jour automatique du statut de la facture** (méthode `updateFactureStatus()`)

**Mécanisme de mise à jour automatique du statut**

Le système applique la logique suivante :

- **Aucune tranche payée** : Statut facture "Non payé" - Valeur `etat` : 0 - Impact : Aucun changement
- **Au moins 1 tranche payée (mais pas toutes)** : Statut facture "Partiellement payé" - Valeur `etat` : 1 - Impact : Badge orange
- **Toutes les tranches payées** : Statut facture "Totalement payé" - Valeur `etat` : 2 - Impact : Badge vert + Vérification clôture chantier

**Déclenchement de la clôture automatique**

Lorsqu'une facture passe au statut "Totalement payé", le système vérifie :

```
Si toutes les factures du chantier sont "Totalement payées"
Alors
    → statut_completion du chantier = "complet"
    → etat du chantier = false (clôturé)
    → Déclenchement automatique de la clôture (étape 10)
Fin Si
```

**Messages système**

- ✅ Succès : "Encaissement enregistré avec succès"
- ✅ Info : "Facture marquée comme totalement payée"
- ✅ Info : "Chantier clôturé automatiquement"
- ❌ Erreur : "La date d'encaissement réel est obligatoire"

---

## 7. Clôture des Missions

La clôture des missions est l'**étape 10** (finale) du workflow de facturation. Elle intervient automatiquement lorsque toutes les factures d'un chantier sont totalement payées.

> **Rappel workflow** : Étape 10/10 - La clôture est automatique et système. Aucune action manuelle n'est requise.

### 7.1 Mécanisme de clôture automatique

**Conditions de déclenchement**

Une mission est automatiquement clôturée lorsque **toutes les conditions suivantes** sont remplies :

- **Toutes les tranches encaissées** : Vérification - `etat` de toutes les tranches = `true` (payé)
- **Toutes les factures payées** : Vérification - `etat` de toutes les factures du chantier = 2 (totalement payé)
- **Recouvrement 100%** : Vérification - Somme des encaissements = Montant total facturé

**Modifications système lors de la clôture**

- **Champ `statut_completion`** : Table chantier - Ancienne valeur "en_cours" - Nouvelle valeur "complet"
- **Champ `etat`** : Table chantier - Ancienne valeur true (actif) - Nouvelle valeur false (clôturé)
- **Champ `date_cloture`** : Table chantier - Ancienne valeur null - Nouvelle valeur Date/heure automatique

### 7.2 Consultation des missions clôturées

**Accès**

Menu **"Chantiers"** > **"Missions clôturées"**

**Liste des missions clôturées**

Le tableau affiche les missions avec statut `statut_completion = "complet"` :

- **Référence** : Référence unique du chantier
- **Client** : Nom du client
- **Objet** : Description de la mission
- **Date clôture** : Date de clôture automatique
- **Montant total** : Montant total facturé et encaissé
- **Actions** : Détails / Rapport final

**Fonctionnalités disponibles**

- Consultation en lecture seule (aucune modification possible)
- Accès aux rapports finaux
- Exportation des données de synthèse
- Archivage long terme

### 7.3 Rapport final de mission

**Génération automatique**

Le rapport final est généré automatiquement lors de la clôture et contient :

**Section 1 : Informations générales**
- Référence chantier
- Client
- Type de mission
- Dates (début, fin prévue, clôture effective)

**Section 2 : Équipe**
- Liste des membres ayant travaillé sur la mission
- Grades
- Jours/homme par membre

**Section 3 : Budget vs Réalisé**

- **Total jours/homme** : Budget prévisionnel (du budget) - Réalisé (du réalisé) - Écart ± %
- **Total honoraires** : Budget prévisionnel (du budget) - Réalisé (facturé) - Écart ± %
- **Débours** : Budget prévisionnel (prévu) - Réalisé (facturé) - Écart ± %

**Section 4 : Facturation et encaissement**
- Nombre de factures émises
- Nombre de tranches
- Total encaissé
- Dates limites vs dates réelles de paiement
- Taux de ponctualité des paiements

**Exportation du rapport**

1. Depuis la fiche d'une mission clôturée, cliquez sur **"Rapport final"**
2. Le rapport s'affiche à l'écran
3. Cliquez sur **"Exporter en PDF"**
4. Le fichier `Rapport_Final_[Reference]_[Date].pdf` est téléchargé

---

## 8. Reporting et Statistiques

Le module de reporting permet d'analyser l'activité selon différents axes : ligne métier, secteur d'activité, zone géographique, et jours/homme.

### 8.1 Décomposition par ligne métier

**Contexte**

Ce rapport présente les performances financières par type de prestation (Audit, Conseil, Expertise comptable, etc.).

**Accès**

Menu **"Statistiques"** > **"Par ligne métier"**

**Données affichées**

- **Nombre de chantiers** : Nombre total de missions par ligne métier
- **Montant total facturé** : Somme des factures émises par ligne
- **Montant encaissé** : Somme des encaissements réels
- **Taux de recouvrement** : (Encaissé / Facturé) × 100
- **Jours/homme moyens** : Moyenne des jours/homme par mission

**Représentations graphiques**

- Graphique en camembert (répartition du CA par ligne métier)
- Graphique en barres (montants comparatifs)
- Tableau récapitulatif détaillé

### 8.2 Décomposition par secteur d'activité

**Contexte**

Analyse des performances par secteur client (Banque, Assurance, Industrie, Services, etc.).

**Accès**

Menu **"Statistiques"** > **"Par secteur d'activité"**

**Utilité**

- Identifier les secteurs les plus rentables
- Orienter la stratégie commerciale
- Évaluer la diversification du portefeuille clients

### 8.3 Décomposition par zone géographique

**Contexte**

Performance par zone d'intervention (Afrique, Europe, Asie, Amérique).

**Accès**

Menu **"Statistiques"** > **"Par zone géographique"**

**Indicateurs clés**

- Chiffre d'affaires par zone
- Nombre de missions par zone
- Taux de croissance annuel par zone

### 8.4 Jours/Homme et taux moyen

**Contexte**

Suivi de l'activité en termes de jours/homme consommés et taux journaliers moyens pratiqués.

**Accès**

Menu **"Statistiques"** > **"Jours-Homme"**

**Filtrage par période**

- **Semaine** : Affichage des 7 derniers jours
- **Mois** : Mois en cours
- **Année** : Année en cours
- **Personnalisé** : Sélection de dates de début et fin

**Données affichées**

- **Total jours/homme** : Calcul Σ jours/homme de tous les budgets - Utilité : Charge de travail globale
- **Taux journalier moyen** : Calcul Σ montants / Σ jours/homme - Utilité : Tarification moyenne
- **Répartition par grade** : Calcul Jours/homme par grade - Utilité : Allocation des ressources

**Graphique de tendance**

Courbe d'évolution des jours/homme sur la période sélectionnée permettant d'identifier :
- Pics d'activité
- Périodes creuses
- Tendance générale (croissance / décroissance)

---

## 9. Système d'Alertes

Le système d'alertes permet de notifier automatiquement les utilisateurs des échéances à venir et des retards.

### 9.1 Types d'alertes

**Alertes factures à émettre**

- **Déclenchement** : 7 jours avant la date prévisionnelle de facture
- **Objet** : Rappel d'émission de facture
- **Action attendue** : Émettre la facture avant la date prévue

**Alertes factures à recouvrer**

- **Déclenchement** : 7 jours avant la date de recouvrement
- **Objet** : Rappel de paiement à recevoir
- **Action attendue** : Relancer le client si nécessaire

**Alertes de retard**

- **Déclenchement** : Dès dépassement de la date prévue
- **Objet** : Retard constaté
- **Niveau de gravité** : Critique (rouge)

### 9.2 Consultation des alertes

**Affichage tableau de bord**

- Les alertes s'affichent automatiquement sur le tableau de bord à chaque connexion
- Badge numérique indiquant le nombre d'alertes actives
- Tri par priorité (retards en premier)

**Accès via menu**

Menu **"Notifications"** ou icône cloche dans la barre de navigation

**Classification visuelle**

- **Retard** : Couleur Rouge 🔴 - Icône ⚠️ - Urgence Critique
- **À venir (< 7j)** : Couleur Orange 🟡 - Icône ⏰ - Urgence Importante
- **À venir (7-14j)** : Couleur Jaune 🟡 - Icône 📅 - Urgence Normale

### 9.3 Paramétrage des alertes

**Accès**

Menu **"Paramètres"** > **"Gestion des alertes"**

**Paramètres modifiables**

- **Délai alerte facture à émettre** : Valeur par défaut 7 jours - Plage autorisée 1-30 jours
- **Délai alerte recouvrement** : Valeur par défaut 7 jours - Plage autorisée 1-30 jours
- **Notifications email** : Valeur par défaut Activé - Options Activé / Désactivé
- **Fréquence récapitulatif** : Valeur par défaut Quotidien - Options Quotidien / Hebdomadaire / Mensuel

---

## 10. Baromètre de Facturation

Le baromètre de facturation offre une vue d'ensemble de l'activité de facturation et d'encaissement sur une période donnée.

### 10.1 Accès au baromètre

Menu **"Rapports"** > **"Baromètre de facturation"**

### 10.2 Sélection de la période

**Filtres disponibles**

- **Par année** : Sélection dans une liste déroulante des années disponibles
- **Comparaison annuelle** : Affichage de plusieurs années côte à côte

### 10.3 Indicateurs affichés

- **Total honoraires** : Somme des honoraires facturés - Calcul Σ montants honoraires
- **Total débours** : Somme des débours facturés - Calcul Σ montants débours
- **Taux moyen annuel** : Taux journalier moyen - Calcul Total honoraires / Total jours/homme
- **Factures émises** : Nombre de factures générées - Calcul Count(factures émises)
- **Factures à émettre** : Nombre de factures en attente - Calcul Count(factures non émises)
- **Taux d'émission** : Pourcentage de factures émises - Calcul (Émises / Total) × 100

### 10.4 Répartition mensuelle

**Graphique mensuel**

Histogramme affichant pour chaque mois :
- Montant des factures émises
- Montant des encaissements reçus
- Écart facturé vs encaissé

**Tableau détaillé - Exemple**

- **Janvier** : Factures émises 5 000 000 - Encaissements 4 500 000 - Écart -500 000 - Statut 🟡
- **Février** : Factures émises 7 000 000 - Encaissements 7 200 000 - Écart +200 000 - Statut 🟢

### 10.5 Tableau de bord interactif

**Technologies utilisées**

L'application utilise **Chart.js** pour générer des graphiques interactifs permettant :
- Survol pour afficher les détails
- Zoom sur les périodes
- Export en image PNG

**Widgets du tableau de bord**

**Widget 1 : Synthèse globale**
- Nombre total de clients actifs
- Nombre de chantiers en cours
- Total des jours/homme budgétés
- Nombre de factures émises dans l'année

**Widget 2 : Statut des chantiers par année**
- Graphique en anneau : Chantiers actifs vs Complets
- Sélecteur d'année
- Drill-down vers la liste détaillée

**Widget 3 : Statut des factures par année**
- Graphique en barres empilées :
  - Factures totalement payées (vert)
  - Factures partiellement payées (orange)
  - Factures non payées (rouge)

**Widget 4 : Budget et Jours/Homme**
- Évolution mensuelle des jours/homme
- Comparaison budget prévisionnel vs réalisé
- Taux d'utilisation des ressources

---

## 11. Bonnes Pratiques

Cette section présente les recommandations d'utilisation pour optimiser l'efficacité et la fiabilité du système.

### 11.1 Saisie des données

- **Vérification avant validation** : Pourquoi : Éviter les erreurs et corrections ultérieures - Comment : Relire systématiquement les informations saisies
- **Utilisation de la recherche** : Pourquoi : Éviter les doublons de clients/chantiers - Comment : Rechercher avant de créer
- **Complétion des champs obligatoires** : Pourquoi : Garantir l'intégrité des données - Comment : Renseigner tous les champs marqués d'un astérisque
- **Cohérence des dates** : Pourquoi : Logique temporelle - Comment : Vérifier Date début < Date fin < Date facturation
- **Nomenclature uniforme** : Pourquoi : Faciliter les recherches futures - Comment : Adopter une convention de nommage

### 11.2 Gestion de la facturation

- **Vérification des montants calculés** : Contrôler systématiquement les totaux automatiques avant validation
- **Respect des délais d'émission** : Émettre les factures dans les 48h de la date prévisionnelle
- **Consultation régulière des alertes** : Vérifier le tableau de bord quotidiennement
- **Validation de la règle des 100%** : S'assurer que la somme des % de tranches = 100% exactement
- **Archivage des PDF** : Conserver une copie locale des factures émises

### 11.3 Suivi des encaissements

- **Enregistrement immédiat** : Saisir l'encaissement dès réception du paiement (délai max 24h)
- **Vérification mode de paiement** : S'assurer de la correspondance avec le paiement réel
- **Conservation des références** : Noter systématiquement les numéros de chèque/virement
- **Rapprochement bancaire** : Vérifier mensuellement la cohérence avec les relevés bancaires
- **Relance proactive** : Relancer le client 3 jours après dépassement de la date prévue

### 11.4 Reporting et analyse

- **Export régulier des rapports** : Exporter les rapports statistiques en fin de mois
- **Analyse des tendances** : Utiliser les graphiques pour identifier patterns et anomalies
- **Utilisation du baromètre** : Consulter le baromètre hebdomadairement pour la planification
- **Comparaisons annuelles** : Analyser l'évolution d'une année sur l'autre
- **Partage avec direction** : Communiquer les KPIs mensuellement

### 11.5 Sécurité et confidentialité

- **Mots de passe** : Utiliser des mots de passe forts (min 12 caractères, majuscules, chiffres, symboles)
- **Déconnexion** : Se déconnecter systématiquement en quittant le poste de travail
- **Confidentialité** : Ne pas partager les identifiants entre utilisateurs
- **Sauvegarde** : Faire des exports réguliers pour backup externe

---

## 12. Support et Assistance

Cette section indique les procédures à suivre en cas de difficulté ou de question.

### 12.1 Ressources de support

**Niveau 1 : Auto-assistance**

1. **Consulter ce guide utilisateur**
   - Utilisez la table des matières pour trouver la section concernée
   - Recherchez par mot-clé (Ctrl+F dans le PDF)

2. **Vérifier les messages d'erreur**
   - Lire attentivement le message affiché
   - Vérifier les champs signalés en rouge
   - Consulter la section correspondante du guide

3. **Consulter la FAQ** (si disponible)
   - Document FAQ dans le dossier docs/
   - Questions fréquentes et réponses

**Niveau 2 : Support utilisateur**

Contacter l'administrateur système avec les informations suivantes :

- **Contexte** : Que tentiez-vous de faire ?
- **Action** : Quelle manipulation avez-vous effectuée ?
- **Résultat attendu** : Que devait-il se passer ?
- **Résultat obtenu** : Qu'est-il arrivé réellement ?
- **Message d'erreur** : Copie exacte du message (screenshot si possible)
- **Navigateur** : Quel navigateur utilisez-vous (nom + version) ?
- **Heure** : Date et heure précise de l'incident

**Niveau 3 : Support technique**

Pour les problèmes techniques complexes :
- Contacter l'équipe de développement
- Fournir les logs système si demandés
- Décrire précisément le scénario de reproduction

### 12.2 Canaux de contact

- **Email administrateur** : Usage Questions générales, demandes de formation - Délai de réponse 24-48h ouvrées
- **Support technique** : Usage Problèmes techniques, bugs - Délai de réponse 4-8h ouvrées
- **Urgence** : Usage Blocage critique empêchant le travail - Délai de réponse Immédiat (téléphone)

### 12.3 Signalement de bugs

Si vous identifiez un dysfonctionnement :

1. Vérifier que c'est bien un bug (pas une erreur de manipulation)
2. Tenter de reproduire le bug
3. Noter précisément les étapes de reproduction
4. Prendre des screenshots si possible
5. Contacter le support technique avec le rapport détaillé

**Template de rapport de bug** :

```
Titre : [Description courte du problème]
Priorité : [Bloquante / Haute / Moyenne / Basse]
Étapes de reproduction :
1. [Première action]
2. [Deuxième action]
3. [Action déclenchant le bug]

Résultat attendu : [Ce qui devrait se passer]
Résultat obtenu : [Ce qui se passe réellement]

Environnement :
- Navigateur : [Chrome 120 / Firefox 121 / etc.]
- Système : [Windows 11 / macOS 14 / etc.]
- URL : [URL de la page]
- Date/Heure : [JJ/MM/AAAA HH:MM]

Pièces jointes : [Screenshots, logs, etc.]
```

### 12.4 Demandes d'évolution

Pour proposer de nouvelles fonctionnalités :

1. Vérifier que la fonctionnalité n'existe pas déjà
2. Décrire précisément le besoin métier
3. Expliquer la valeur ajoutée attendue
4. Soumettre la demande à l'administrateur

Les demandes sont évaluées trimestriellement et priorisées selon :
- Valeur métier
- Complexité technique
- Nombre d'utilisateurs impactés

### 12.5 Formation et accompagnement

**Sessions de formation**

Des sessions de formation sont organisées :
- Formation initiale pour les nouveaux utilisateurs (2h)
- Formation de perfectionnement (1h)
- Sessions thématiques (reporting, alertes, etc.)

**Documentation complémentaire**

- Guide technique (pour développeurs)
- Cahier des charges (spécifications fonctionnelles)
- Vidéos tutorielles (si disponibles)

---

## Informations de version

**Version du guide** : 2.0
**Date de publication** : Janvier 2025
**Statut** : Production
**Plateforme** : https://factures-mazars-app.onrender.com/
**Framework** : Laravel 11.x
**Base de données** : PostgreSQL 14+

---

**Fin du Guide Utilisateur**
