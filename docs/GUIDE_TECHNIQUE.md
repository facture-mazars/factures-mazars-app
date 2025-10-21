# Guide Technique Complet - Application de Gestion de Factures

## À PROPOS DE CE GUIDE

Ce guide est destiné à un développeur qui va reprendre ce projet. Même si vous êtes débutant, ce guide vous expliquera TOUT ce que vous devez savoir, étape par étape, sans supposer aucune connaissance préalable.

**Objectif** : Vous permettre de comprendre, maintenir et faire évoluer cette application de gestion de factures.

---

## TABLE DES MATIÈRES

1. [Qu'est-ce que cette application ?](#1-quest-ce-que-cette-application)
2. [Installation complète de A à Z](#2-installation-complète-de-a-à-z)
3. [Comprendre la structure du projet](#3-comprendre-la-structure-du-projet)
4. [La base de données expliquée simplement](#4-la-base-de-données-expliquée-simplement)
5. [Les modèles (Models) - La logique métier](#5-les-modèles-models---la-logique-métier)
6. [Les contrôleurs (Controllers) - Le cerveau de l'application](#6-les-contrôleurs-controllers---le-cerveau-de-lapplication)
7. [Les routes - Comment l'application répond aux URLs](#7-les-routes---comment-lapplication-répond-aux-urls)
8. [Les vues (Views) - Ce que l'utilisateur voit](#8-les-vues-views---ce-que-lutilisateur-voit)
9. [Fonctionnalités importantes du projet](#9-fonctionnalités-importantes-du-projet)
10. [Comment ajouter une nouvelle fonctionnalité](#10-comment-ajouter-une-nouvelle-fonctionnalité)
11. [Débogage et résolution de problèmes](#11-débogage-et-résolution-de-problèmes)
12. [Déploiement en production](#12-déploiement-en-production)

---

## 1. QU'EST-CE QUE CETTE APPLICATION ?

### 1.1 Vue d'ensemble

Cette application est un **système de gestion de factures** pour un cabinet d'expertise comptable (Cabinet Mazars). Elle permet de :

- Gérer les clients
- Créer et suivre des missions (chantiers)
- Établir des budgets pour chaque mission
- Créer des factures avec plusieurs tranches de paiement
- Enregistrer les encaissements (paiements reçus)
- Générer des rapports et statistiques

### 1.2 Le flux de travail complet (de A à Z)

Voici comment l'application fonctionne dans la vraie vie :

```
ÉTAPE 1 : Créer un client
   ↓
ÉTAPE 2 : Créer un chantier (mission) pour ce client
   ↓
ÉTAPE 3 : Définir les dates du chantier
   ↓
ÉTAPE 4 : Affecter une équipe au chantier
   ↓
ÉTAPE 5 : Créer le budget (combien de jours-homme, quel taux horaire)
   ↓
ÉTAPE 6 : Créer une facture pour ce chantier
   ↓
ÉTAPE 7 : Diviser la facture en tranches (par exemple : 30% à l'avance, 70% à la fin)
   ↓
ÉTAPE 8 : Émettre chaque tranche de facture
   ↓
ÉTAPE 9 : Enregistrer les encaissements (quand le client paie)
   ↓
ÉTAPE 10 : Choisir les banques pour le chantier
   ↓
ÉTAPE 11 : Clôturer le chantier (quand tout est payé à 100%)
   ↓
ÉTAPE 12 : Générer des rapports et statistiques
```

### 1.3 Technologies utilisées

**Ne vous inquiétez pas si vous ne connaissez pas ces termes, nous les expliquerons :**

- **PHP 8.2** : Le langage de programmation côté serveur
- **Laravel 11** : Le framework PHP qui structure l'application
- **PostgreSQL** : La base de données qui stocke toutes les informations
- **Blade** : Le moteur de templates pour générer le HTML
- **Bootstrap** : Le framework CSS pour le design
- **Vite** : L'outil qui compile les fichiers JavaScript et CSS
- **Chart.js** : Pour créer des graphiques
- **Select2** : Pour les listes déroulantes avec recherche

### 1.4 Concepts clés à comprendre

#### Qu'est-ce qu'un Client ?
Un client est une entreprise ou une personne qui fait appel au cabinet pour une mission.

#### Qu'est-ce qu'un Chantier (Mission) ?
C'est un projet/mandat réalisé pour un client. Par exemple : "Audit comptable 2024" ou "Conseil fiscal".

#### Qu'est-ce qu'une Facture ?
C'est le document qui indique combien le client doit payer pour le chantier.

#### Qu'est-ce qu'une Tranche de Facture ?
Une facture peut être divisée en plusieurs paiements. Par exemple :
- Tranche 1 : 30% à payer au début
- Tranche 2 : 40% à payer à mi-parcours
- Tranche 3 : 30% à payer à la fin

#### Qu'est-ce qu'un Encaissement ?
C'est l'enregistrement du paiement reçu du client (par chèque ou virement bancaire).

---

## 2. INSTALLATION COMPLÈTE DE A À Z

### 2.1 Prérequis : Ce que vous devez installer sur votre ordinateur

#### 2.1.1 Installer PHP (version 8.2 minimum)

**PHP** est le langage dans lequel l'application est écrite.

##### Sur Windows :
1. Téléchargez XAMPP : https://www.apachefriends.org/fr/index.html
2. Installez XAMPP (cochez PHP et MySQL/MariaDB)
3. Ouvrez le panneau de contrôle XAMPP
4. Démarrez Apache et MySQL

##### Sur macOS :
```bash
# Ouvrez le Terminal et tapez :
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Installez PHP 8.2
brew install php@8.2

# Vérifiez que PHP est bien installé
php -v
```

Vous devriez voir quelque chose comme : `PHP 8.2.x`

##### Sur Linux (Ubuntu/Debian) :
```bash
# Ouvrez le Terminal et tapez :
sudo add-apt-repository ppa:ondrej/php
sudo apt update

# Installez PHP 8.2 et ses extensions
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-pgsql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-intl

# Vérifiez l'installation
php -v
```

#### 2.1.2 Installer Composer (gestionnaire de dépendances PHP)

**Composer** télécharge et gère toutes les bibliothèques PHP dont Laravel a besoin.

##### Installation globale :

**Windows** : Téléchargez l'installateur depuis https://getcomposer.org/download/

**macOS/Linux** :
```bash
# Téléchargez Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# Rendez-le accessible globalement
sudo mv composer.phar /usr/local/bin/composer

# Vérifiez l'installation
composer --version
```

#### 2.1.3 Installer Node.js et NPM (version 18+)

**Node.js** et **NPM** sont nécessaires pour compiler les fichiers CSS et JavaScript.

1. Allez sur https://nodejs.org/
2. Téléchargez la version LTS (Long Term Support)
3. Installez Node.js

**Vérification** :
```bash
node -v
npm -v
```

#### 2.1.4 Installer PostgreSQL (base de données)

**PostgreSQL** stocke toutes les données de l'application.

##### Sur Windows :
1. Téléchargez depuis https://www.postgresql.org/download/windows/
2. Installez PostgreSQL
3. Notez bien le mot de passe que vous définissez pour l'utilisateur `postgres`

##### Sur macOS :
```bash
brew install postgresql@15
brew services start postgresql@15
```

##### Sur Linux :
```bash
sudo apt install postgresql postgresql-contrib
sudo systemctl start postgresql
sudo systemctl enable postgresql
```

**Vérification** :
```bash
psql --version
```

#### 2.1.5 Installer Git

**Git** permet de gérer les versions du code.

- **Windows** : https://git-scm.com/download/win
- **macOS** : `brew install git`
- **Linux** : `sudo apt install git`

**Vérification** :
```bash
git --version
```

#### 2.1.6 Installer un éditeur de code

Nous recommandons **Visual Studio Code** (gratuit) : https://code.visualstudio.com/

**Extensions VS Code recommandées** (à installer depuis l'onglet Extensions) :
1. PHP Intelephense
2. Laravel Blade Snippets
3. Laravel Extra Intellisense
4. GitLens

### 2.2 Cloner le projet

Une fois tous les outils installés :

```bash
# Ouvrez un terminal et naviguez vers votre dossier de projets
cd ~/Documents/projets

# Clonez le dépôt Git (remplacez l'URL par la vraie URL du projet)
git clone https://github.com/votre-organisation/factures-app.git

# Entrez dans le dossier du projet
cd factures-app
```

### 2.3 Installer les dépendances

#### Étape 1 : Dépendances PHP (via Composer)

```bash
# Dans le dossier du projet
composer install
```

**Ce que fait cette commande** :
- Lit le fichier `composer.json` qui liste toutes les bibliothèques nécessaires
- Télécharge Laravel, les bibliothèques d'import Excel, etc.
- Les installe dans le dossier `vendor/`

**Durée** : 2-5 minutes selon votre connexion internet

#### Étape 2 : Dépendances JavaScript (via NPM)

```bash
npm install
```

**Ce que fait cette commande** :
- Lit le fichier `package.json`
- Télécharge Vite, Axios, etc.
- Les installe dans le dossier `node_modules/`

**Durée** : 2-5 minutes

### 2.4 Configurer l'environnement

#### Étape 1 : Créer le fichier .env

Le fichier `.env` contient toutes les configurations sensibles (mots de passe de base de données, etc.).

```bash
# Copiez le fichier exemple
cp .env.example .env
```

**Sur Windows** :
```bash
copy .env.example .env
```

#### Étape 2 : Générer la clé d'application

```bash
php artisan key:generate
```

**Ce que fait cette commande** : Génère une clé de cryptage unique pour votre application.

#### Étape 3 : Créer la base de données

```bash
# Connectez-vous à PostgreSQL
psql -U postgres

# Une fois connecté, créez la base de données
CREATE DATABASE factures_app;

# Sortez de PostgreSQL
\q
```

**Si vous avez une erreur de connexion**, essayez :
```bash
sudo -u postgres psql
```

#### Étape 4 : Configurer le fichier .env

Ouvrez le fichier `.env` avec votre éditeur de code et modifiez ces lignes :

```env
# Informations générales
APP_NAME="Gestion Factures"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Configuration de la base de données PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=factures_app
DB_USERNAME=postgres
DB_PASSWORD=votre_mot_de_passe_postgresql
```

**⚠️ IMPORTANT** : Remplacez `votre_mot_de_passe_postgresql` par le mot de passe que vous avez défini lors de l'installation de PostgreSQL.

### 2.5 Créer la structure de la base de données

```bash
# Exécuter les migrations (créer les tables)
php artisan migrate
```

**Ce que fait cette commande** :
- Lit tous les fichiers dans `database/migrations/`
- Crée toutes les tables nécessaires dans PostgreSQL

**Résultat attendu** :
```
Migration table created successfully.
Migrating: 2024_01_01_create_clients_table
Migrated:  2024_01_01_create_clients_table (50.23ms)
Migrating: 2024_01_02_create_chantiers_table
Migrated:  2024_01_02_create_chantiers_table (45.12ms)
...
```

### 2.6 Peupler la base de données avec des données de test

```bash
# Insérer des données de base (pays, devises, types de mission, etc.)
php artisan db:seed
```

### 2.7 Compiler les assets (CSS et JavaScript)

```bash
# Mode développement (recompile automatiquement à chaque modification)
npm run dev
```

**Laissez cette commande tourner dans un terminal** pendant que vous développez.

### 2.8 Démarrer le serveur de développement

**Ouvrez un NOUVEAU terminal** (l'autre terminal doit toujours avoir `npm run dev` qui tourne) :

```bash
# Démarrer le serveur Laravel
php artisan serve
```

**Résultat** :
```
Starting Laravel development server: http://127.0.0.1:8000
```

### 2.9 Accéder à l'application

Ouvrez votre navigateur et allez sur : **http://localhost:8000**

🎉 **Félicitations !** L'application devrait maintenant être accessible.

### 2.10 Vérification que tout fonctionne

**Checklist** :
- ✅ La page d'accueil s'affiche sans erreur
- ✅ Vous pouvez vous connecter
- ✅ Le terminal `npm run dev` est toujours actif
- ✅ Le terminal `php artisan serve` est toujours actif

**En cas d'erreur**, consultez la section [11. Débogage et résolution de problèmes](#11-débogage-et-résolution-de-problèmes).

---

## 3. COMPRENDRE LA STRUCTURE DU PROJET

### 3.1 Introduction : Comment est organisé un projet Laravel ?

Laravel suit une structure bien définie. Chaque fichier a sa place et son rôle. Voici l'organisation complète du projet :

```
factures-app/
│
├── app/                          # Le cœur de votre application
│   ├── Http/
│   │   ├── Controllers/          # Les contrôleurs (logique métier)
│   │   └── Middleware/           # Middleware (filtres de requêtes)
│   ├── Models/                   # Les modèles (représentent les tables)
│   └── Imports/                  # Classes pour importer des fichiers Excel
│
├── config/                       # Fichiers de configuration
│   ├── app.php                   # Configuration générale
│   ├── database.php              # Configuration base de données
│   └── ...
│
├── database/                     # Tout ce qui concerne la base de données
│   ├── migrations/               # Structure des tables (schéma BDD)
│   ├── seeders/                  # Données de démarrage/test
│   └── factories/                # Génération de données fictives
│
├── public/                       # Fichiers accessibles publiquement
│   ├── index.php                 # Point d'entrée de l'application
│   └── assetsfacture/            # Images, CSS, JS statiques
│
├── resources/                    # Ressources non compilées
│   ├── views/                    # Templates Blade (HTML)
│   ├── js/                       # Fichiers JavaScript (à compiler)
│   └── css/                      # Fichiers CSS (à compiler)
│
├── routes/                       # Définition des URLs
│   ├── web.php                   # Routes web principales
│   ├── api.php                   # Routes API (si vous en avez)
│   └── console.php               # Commandes Artisan personnalisées
│
├── storage/                      # Stockage de fichiers
│   ├── app/                      # Fichiers uploadés par les utilisateurs
│   ├── framework/                # Fichiers du framework (cache, sessions)
│   └── logs/                     # Fichiers de logs (laravel.log)
│
├── tests/                        # Tests automatisés
│   ├── Feature/                  # Tests fonctionnels
│   └── Unit/                     # Tests unitaires
│
├── vendor/                       # Dépendances PHP (NE JAMAIS MODIFIER)
├── node_modules/                 # Dépendances JS (NE JAMAIS MODIFIER)
│
├── .env                          # Configuration d'environnement (SECRET)
├── .env.example                  # Exemple de fichier .env
├── composer.json                 # Dépendances PHP
├── package.json                  # Dépendances JavaScript
├── vite.config.js                # Configuration de Vite
└── artisan                       # Ligne de commande Laravel
```

### 3.2 Les dossiers importants expliqués EN DÉTAIL

#### 3.2.1 Le dossier `app/` - Le cœur de l'application

C'est ici que vous passerez 90% de votre temps. Voici ce qu'il contient :

##### `app/Http/Controllers/` - Les contrôleurs (20 fichiers)

**Qu'est-ce qu'un contrôleur ?** C'est le "cerveau" qui décide quoi faire quand un utilisateur visite une page.

**Les contrôleurs principaux de notre application** :

1. **ClientController.php** (app/Http/Controllers/ClientController.php:1)
   - Gère tout ce qui concerne les clients
   - Créer un client, modifier un client, voir la liste des clients, etc.
   - Génère automatiquement le code client (ex: U00001, M00002)

2. **ChantierController.php** (app/Http/Controllers/ChantierController.php:1)
   - Gère les missions/chantiers
   - Créer un chantier, modifier, lister
   - Gère les types et sous-types de mission

3. **FactureController.php** (app/Http/Controllers/FactureController.php:1)
   - Gère les factures
   - Créer une facture pour un chantier
   - Calculer les débours (frais) et honoraires

4. **TrancheFactureController.php** (app/Http/Controllers/TrancheFactureController.php:1)
   - Gère les tranches de facturation
   - Diviser une facture en plusieurs paiements
   - Valider qu'une facture fait bien 100% au total
   - Émettre les factures

5. **EncaissementController.php** (app/Http/Controllers/EncaissementController.php:1)
   - Gère les paiements reçus
   - Enregistrer un encaissement (par chèque ou virement)
   - Mettre à jour automatiquement le statut de la facture

6. **BudgetController.php** (app/Http/Controllers/BudgetController.php:1)
   - Gère les budgets des chantiers
   - Calculer les jours-homme (nombre de jours de travail)
   - Calculer le taux moyen

7. **DashboardController.php** (app/Http/Controllers/DashboardController.php:1)
   - Page d'accueil avec statistiques
   - Graphiques (factures par mois, budgets, etc.)
   - Nombre de chantiers en cours

8. **RapportController.php** (app/Http/Controllers/RapportController.php:1)
   - Génère les rapports
   - Baromètre de facturation
   - Clôture des missions (quand tout est payé à 100%)
   - Détails finaux avec TVA

9. **ConsultantController.php** (app/Http/Controllers/ConsultantController.php:1)
   - Vue spéciale pour les consultants (accès restreint)
   - Ne peut voir que certaines informations

10. **ChoixBanqueController.php** (app/Http/Controllers/ChoixBanqueController.php:1)
    - Choisir les banques pour chaque facture
    - Gérer les chèques

11. **GetDateController.php** - Gère les dates des chantiers
12. **EquipeController.php** - Gère les équipes affectées aux chantiers
13. **ImportController.php** - Importe des données depuis Excel
14. **AuthController.php** - Authentification (connexion/déconnexion)
15. **SocieteChequePersonnelTauxController.php** - Administration (société, personnel, taux)
16. **ConversionController.php** - Convertit les nombres en lettres
17. **MissionController.php** - Gère les types de mission
18. **SousMissionController.php** - Gère les sous-types de mission
19. **ContratController.php** - Gère les contrats
20. **Autres contrôleurs** pour diverses fonctionnalités

##### `app/Models/` - Les modèles (38 fichiers)

**Qu'est-ce qu'un modèle ?** C'est la représentation d'une table de la base de données en PHP.

**Les modèles principaux** :

1. **Client.php** (app/Models/Client.php:1)
   - Représente la table `clients`
   - Clé primaire : `id_client` (et NON `id` !)
   - Relations : un client a plusieurs chantiers

2. **Chantier.php** (app/Models/Chantier.php:1)
   - Représente la table `chantiers`
   - Clé primaire : `id_chantier`
   - Relations : appartient à un client, a plusieurs factures

3. **Facture.php** (app/Models/Facture.php:1)
   - Représente la table `factures`
   - Clé primaire : `id_facture`
   - Contient la méthode **TRÈS IMPORTANTE** : `updateFactureStatus()`

4. **TrancheFacture.php** (app/Models/TrancheFacture.php:1)
   - Représente la table `tranche_factures`
   - Clé primaire : `id_tranche_facture`
   - Une tranche = un paiement partiel de la facture

5. **Encaissement.php** (app/Models/Encaissement.php:1)
   - Représente la table `encaissements`
   - Enregistre les paiements reçus

6. **Budget.php**, **Equipe.php**, **GetDate.php**, etc.

**⚠️ IMPORTANT** : Ce projet utilise des clés primaires personnalisées !
- Au lieu de `id`, c'est `id_client`, `id_chantier`, `id_facture`, etc.
- Vous devez toujours le spécifier dans le modèle :
  ```php
  protected $primaryKey = 'id_client';
  ```

##### `app/Imports/` - Import Excel (1 fichiers)

 **ClientImport.php** - Importer des clients depuis Excel


#### 3.2.2 Le dossier `database/` - Structure et données

##### `database/migrations/` - Le schéma de la base de données

**Qu'est-ce qu'une migration ?** C'est un fichier qui décrit comment créer ou modifier une table.

**Exemple** : La migration pour créer la table `clients` :
```php
Schema::create('clients', function (Blueprint $table) {
    $table->id('id_client');  // Clé primaire
    $table->string('code_client')->unique();
    $table->string('nom_client');
    $table->text('adresse_client')->nullable();
    $table->timestamps();  // created_at, updated_at
});
```

**Commandes utiles** :
```bash
# Créer les tables
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Tout supprimer et recréer
php artisan migrate:fresh
```

##### `database/seeders/` - Données de démarrage

**Qu'est-ce qu'un seeder ?** C'est un fichier qui insère des données de base.

**Exemple** : Insérer les pays, devises, types de mission, etc.

```bash
# Exécuter tous les seeders
php artisan db:seed
```

#### 3.2.3 Le dossier `resources/views/` - Les templates HTML

**Qu'est-ce qu'une vue ?** C'est un fichier HTML avec des morceaux de code PHP (Blade).

**Organisation** (32 dossiers) :

```
resources/views/
├── layouts/                      # Layouts de base
│   ├── app.blade.php             # Layout principal (navbar + sidebar)
│   ├── navbar.blade.php          # Barre de navigation standard
│   ├── sidebar.blade.php         # Menu latéral standard
│   ├── navbarConsultant.blade.php # Navbar pour consultants
│   └── sidebarConsultant.blade.php # Sidebar pour consultants
│
├── auth/                         # Pages d'authentification
│   ├── login.blade.php           # Page de connexion
│   └── register.blade.php        # Page d'inscription
│
├── client/                       # Pages clients
│   ├── listClients.blade.php     # Liste de tous les clients
│   ├── insertClient.blade.php    # Formulaire de création
│   ├── editClient.blade.php      # Formulaire de modification
│   ├── detailsClient.blade.php   # Détails d'un client
│   ├── clients_par_secteur.blade.php
│   └── clients_par_zone.blade.php
│
├── chantier/                     # Pages chantiers
│   ├── listeChantier.blade.php
│   ├── insertChantier.blade.php
│   ├── edit.blade.php
│   └── details.blade.php
│
├── facture/                      # Pages factures
│   ├── listeFacture.blade.php
│   ├── insertFacture.blade.php
│   └── editFacture.blade.php
│
├── tranche_facture/              # Pages tranches de facturation
│   ├── insertTrancheFacture.blade.php
│   ├── modifierTrancheFacture.blade.php
│   ├── listeTrancheFacture.blade.php
│   ├── voirTrancheFacture.blade.php
│   ├── emises.blade.php
│   ├── detailsTrancheFacture.blade.php
│   ├── detailsTrancheFactureSansEncaissement.blade.php
│   ├── detailsTrancheFactureAnnuler.blade.php
│   └── prevision.blade.php
│
├── encaissement/                 # Pages encaissements
│   ├── insertEncaissement.blade.php
│   ├── ListeEncaissement.blade.php
│   └── encaissement.blade.php
│
├── budget/                       # Pages budgets
│   ├── insertBudget.blade.php
│   ├── editBudget.blade.php
│   └── jour_homme_par_periode.blade.php
│
├── equipe/                       # Pages équipes
├── getdate/                      # Pages dates
│
├── rapport_final/                # Pages rapports
│   ├── cloture.blade.php         # Clôture des missions
│   ├── detailsFinal.blade.php    # Rapport final
│   ├── barometre.blade.php       # Baromètre de facturation
│   └── suivi.blade.php
│
├── import/                       # Pages import Excel
│   ├── clientImport.blade.php
│   ├── chantierImport.blade.php
│   └── budgetfactureImport.blade.php
│
├── ad/                           # Pages administration
│   ├── ad.blade.php              # Hub principal
│   ├── liste_cheque.blade.php
│   ├── liste_perso.blade.php
│   └── liste_taux.blade.php
│
├── choix_banque/                 # Pages choix banques
├── consultant/                   # Pages vue consultant
└── mission/                      # Pages types de mission
```

#### 3.2.4 Le dossier `routes/` - Définition des URLs

**Fichier principal** : `routes/web.php` (201 routes !)

**Qu'est-ce qu'une route ?** C'est le lien entre une URL et un contrôleur.

**Exemple** :
```php
// Quand l'utilisateur va sur /clients
Route::get('/clients', [ClientController::class, 'index']);
// Laravel appelle la méthode "index" du ClientController
```

#### 3.2.5 Le dossier `public/` - Fichiers accessibles publiquement

```
public/
├── index.php                     # Point d'entrée (NE JAMAIS MODIFIER)
├── assetsfacture/                # Assets statiques
│   ├── css/                      # Styles CSS
│   ├── js/                       # Scripts JavaScript
│   └── icons/                    # Bootstrap Icons
└── build/                        # Fichiers compilés par Vite
```

#### 3.2.6 Le dossier `storage/` - Stockage de fichiers

```
storage/
├── app/                          # Fichiers uploadés
├── framework/                    # Cache, sessions, vues compilées
│   ├── cache/
│   ├── sessions/
│   └── views/
└── logs/                         # Fichiers de logs
    └── laravel.log               # Log principal (TRÈS UTILE pour déboguer)
```

**⚠️ IMPORTANT** : Si vous avez une erreur, regardez TOUJOURS `storage/logs/laravel.log` !

#### 3.2.7 Les fichiers de configuration

##### `.env` - Configuration d'environnement (SECRET !)

**⚠️ NE JAMAIS COMMITER CE FICHIER SUR GIT !**

Ce fichier contient :
- Les identifiants de la base de données
- La clé de cryptage de l'application
- Les configurations sensibles

##### `composer.json` - Dépendances PHP

Liste toutes les bibliothèques PHP nécessaires :
```json
{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^11.9",
    "maatwebsite/excel": "*",           // Import/Export Excel
    "consoletvs/charts": "^6.7",        // Graphiques
    "kwn/number-to-words": "^2.9",      // Conversion en lettres
    "phpoffice/phpspreadsheet": "^1.29" // Manipulation Excel
  }
}
```

##### `package.json` - Dépendances JavaScript

```json
{
  "devDependencies": {
    "vite": "^5.0",                     // Build tool
    "laravel-vite-plugin": "^1.0",
    "axios": "^1.6.4"                   // Requêtes HTTP
  }
}
```

### 3.3 Le pattern MVC (Model-View-Controller)

**MVC** est l'architecture de Laravel. Voici comment ça fonctionne :

```
1. L'utilisateur visite une URL : /clients

2. Laravel regarde dans routes/web.php
   Route::get('/clients', [ClientController::class, 'index']);

3. Laravel appelle le contrôleur ClientController
   public function index() {
       $clients = Client::all();  // Récupère tous les clients
       return view('client.listClients', compact('clients'));
   }

4. Le contrôleur utilise le modèle Client
   Client::all() → SELECT * FROM clients;

5. Le contrôleur passe les données à la vue
   resources/views/client/listClients.blade.php

6. Laravel génère le HTML et l'envoie au navigateur
```

**Schéma visuel** :
```
Navigateur → URL → Route → Contrôleur → Modèle → Base de données
                               ↓
                             Vue
                               ↓
                          HTML ← Navigateur
```

### 3.4 Conventions de nommage importantes

#### Clés primaires personnalisées

**⚠️ TRÈS IMPORTANT** : Ce projet N'utilise PAS les conventions Laravel standard !

**Laravel standard** :
- Clé primaire : `id`
- Exemple : `clients.id`

**Ce projet** :
- Clé primaire : `id_{nom_table}`
- Exemple : `clients.id_client`, `chantiers.id_chantier`

**Conséquence** : Vous devez TOUJOURS spécifier la clé primaire dans le modèle :
```php
class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id_client';  // ← OBLIGATOIRE !
}
```

#### Noms de fichiers

- **Contrôleurs** : `NomController.php` (avec majuscule)
- **Modèles** : `Nom.php` (avec majuscule, singulier)
- **Vues** : `nomFichier.blade.php` (minuscule ou camelCase)
- **Migrations** : `2024_01_01_000000_create_nom_table.php`

---

## 4. LA BASE DE DONNÉES EXPLIQUÉE SIMPLEMENT

### 4.1 Introduction : Qu'est-ce qu'une base de données ?

Une base de données, c'est comme un **grand classeur** qui contient plusieurs **tiroirs** (tables), et chaque tiroir contient des **fiches** (lignes/enregistrements).

**Exemple concret** :
- **Tiroir "clients"** : contient toutes les fiches de vos clients
- **Tiroir "chantiers"** : contient toutes les fiches de vos missions
- **Tiroir "factures"** : contient toutes les factures

### 4.2 PostgreSQL : La base de données utilisée

Ce projet utilise **PostgreSQL**, une base de données relationnelle très puissante.

**Pourquoi PostgreSQL ?**
- Plus robuste que MySQL pour les grosses applications
- Supporte bien les requêtes complexes
- Excellente gestion des types de données

### 4.3 La hiérarchie des données (de haut en bas)

Voici comment les données sont organisées dans cette application :

```
CLIENT
  └── CHANTIER (Mission)
       ├── GET_DATE (Dates du chantier)
       ├── ÉQUIPE (Personnel affecté)
       ├── BUDGET (Jours-homme et honoraires)
       │    └── TOTAL_BUDGET (Agrégat des budgets)
       └── FACTURE
            ├── TRANCHE_FACTURE (Paiements échelonnés)
            │    ├── ENCAISSEMENT (Paiements reçus)
            │    └── TRANCHE_FACTURE_HISTORIQUE (Audit)
            └── CHOIX_BANQUE (Banques pour ce chantier)
```

**Expliqué simplement** :
1. Un **CLIENT** peut avoir plusieurs **CHANTIERS**
2. Chaque **CHANTIER** a des **DATES**, une **ÉQUIPE**, un **BUDGET**, et des **FACTURES**
3. Chaque **FACTURE** est divisée en **TRANCHES**
4. Chaque **TRANCHE** peut avoir plusieurs **ENCAISSEMENTS** (paiements reçus)

### 4.4 Points importants à retenir

**✅ TOUJOURS SE RAPPELER** :

1. **Clés primaires personnalisées** : `id_client`, `id_chantier`, pas juste `id`

2. **États de facture** :
   - `0` = Non payée
   - `1` = Partiellement payée
   - `2` = Totalement payée

3. **État de tranche** :
   - `true` = Payée
   - `false` = Non payée

4. **Validation des tranches** :
   - La somme des `taux_honoraire` doit faire 100%
   - La somme des `taux_debours` doit faire 100%

5. **Workflow** : Un chantier passe par plusieurs étapes dans l'ordre

6. **Soft delete** : Le personnel n'est pas supprimé, juste marqué `actif = false`

7. **Timestamps** : Presque toutes les tables ont `created_at` et `updated_at`

---

## 5. LES MODÈLES (MODELS) - LA LOGIQUE MÉTIER

### 5.1 Introduction : Qu'est-ce qu'un modèle Eloquent ?

Un **modèle** est une classe PHP qui représente une table de la base de données. Avec Eloquent (l'ORM de Laravel), vous pouvez interagir avec la base de données **sans écrire de SQL**.

**Exemple simple** :
```php
// Au lieu d'écrire du SQL :
$result = DB::query("SELECT * FROM clients WHERE id_client = 1");

// Vous pouvez simplement faire :
$client = Client::find(1);
```

### 5.2 Anatomie d'un modèle

Voici à quoi ressemble un modèle dans ce projet :

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // 1. Nom de la table
    protected $table = 'clients';
    
    // 2. Clé primaire personnalisée (TRÈS IMPORTANT !)
    protected $primaryKey = 'id_client';
    
    // 3. La clé primaire s'auto-incrémente
    public $incrementing = true;
    
    // 4. Type de la clé primaire
    protected $keyType = 'int';
    
    // 5. Gestion automatique des timestamps (created_at, updated_at)
    public $timestamps = true;
    
    // 6. Champs modifiables (sécurité)
    protected $fillable = [
        'code_client',
        'nom_client',
        'sigle_client',
        'adresse_client',
        'id_pays',
        'id_pays_groupe',
        'id_forme_juridique',
        'id_secteur_activite'
    ];
    
    // 7. Champs cachés (ne jamais retourner au client)
    protected $hidden = [];
    
    // 8. Conversions de types automatiques
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // 9. Relations avec d'autres modèles
    
    /**
     * Un client a plusieurs chantiers
     */
    public function chantiers()
    {
        return $this->hasMany(Chantier::class, 'id_client', 'id_client');
    }
    
    /**
     * Un client appartient à un pays
     */
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays', 'id_pays');
    }
}
```

### 5.3 Les modèles principaux du projet

#### 5.3.1 Modèle Client (app/Models/Client.php)

**Rôle** : Représente un client (entreprise ou personne).

**Relations** :
- `chantiers()` : Un client a plusieurs chantiers (hasMany)
- `pays()` : Un client appartient à un pays (belongsTo)
- `paysGroupe()` : Un client appartient à un groupe de pays (belongsTo)
- `secteurActivite()` : Un client a un secteur d'activité (belongsTo)
- `formeJuridique()` : Un client a une forme juridique (belongsTo)

**Utilisation** :
```php
// Récupérer tous les clients
$clients = Client::all();

// Récupérer un client par ID
$client = Client::find(1);

// Créer un nouveau client
$client = new Client();
$client->nom_client = "UNICEF Madagascar";
$client->code_client = "U00001";
$client->save();

// Ou avec create() (masse assignment)
$client = Client::create([
    'nom_client' => 'UNICEF Madagascar',
    'code_client' => 'U00001',
    'id_pays' => 1
]);

// Accéder aux relations
$chantiers = $client->chantiers;  // Récupère tous les chantiers
$pays = $client->pays->nom_pays;  // Récupère le nom du pays
```

#### 5.3.2 Modèle Chantier (app/Models/Chantier.php)

**Rôle** : Représente une mission/projet pour un client.

**Relations** :
- `client()` : Un chantier appartient à un client (belongsTo)
- `factures()` : Un chantier a plusieurs factures (hasMany)
- `budgets()` : Un chantier a plusieurs budgets (hasMany)
- `totalBudget()` : Un chantier a un total budget (hasOne)
- `equipe()` : Un chantier a une équipe (hasOne)
- `getDate()` : Un chantier a des dates (hasOne)
- `monnaie()` : Un chantier a une monnaie (belongsTo)
- `typeMission()` : Un chantier a un type de mission (belongsTo)
- `sousTypeMission()` : Un chantier a un sous-type de mission (belongsTo)

**Méthodes importantes** :
```php
/**
 * Met à jour l'étape actuelle du workflow
 */
public function updateEtape($etape)
{
    $this->etape_actuelle = $etape;
    $this->save();
}

/**
 * Marque le chantier comme complet
 */
public function marquerComplet()
{
    $this->statut_completion = 'complet';
    $this->save();
}

/**
 * Vérifie si le chantier est complet
 */
public function estComplet()
{
    return $this->statut_completion === 'complet';
}
```

**Utilisation** :
```php
// Récupérer un chantier avec ses relations
$chantier = Chantier::with(['client', 'factures', 'budgets'])->find(1);

// Accéder au client
$nomClient = $chantier->client->nom_client;

// Accéder aux factures
$factures = $chantier->factures;

// Calculer le total des factures
$totalFactures = $chantier->factures->sum('montant_total_honoraire');
```

#### 5.3.3 Modèle Facture (app/Models/Facture.php)

**Rôle** : Représente une facture émise pour un chantier.

**Relations** :
- `chantier()` : Une facture appartient à un chantier (belongsTo)
- `tranches()` : Une facture a plusieurs tranches (hasMany)
- `budgets()` : Une facture est liée à plusieurs budgets (belongsToMany via pivot)
- `societes()` : Une facture appartient à une société (belongsTo)
- `choixBanques()` : Une facture a des banques choisies (hasMany)

**⚠️ MÉTHODE TRÈS IMPORTANTE** : `updateFactureStatus()`

Cette méthode met à jour automatiquement le statut de la facture en fonction des tranches payées.

```php
/**
 * Met à jour le statut de la facture (0, 1, ou 2)
 * Appelée automatiquement après un encaissement
 */
public function updateFactureStatus()
{
    // Récupérer toutes les tranches de cette facture
    $tranches = $this->tranches;
    
    // Si pas de tranches, statut = non payé
    if ($tranches->isEmpty()) {
        $this->etat = 0;
        $this->save();
        return;
    }
    
    // Compter les tranches payées (etat = true)
    $totalTranches = $tranches->count();
    $tranchesPayees = $tranches->where('etat', true)->count();
    
    // Déterminer le statut
    if ($tranchesPayees == 0) {
        $this->etat = 0;  // Non payé
    } elseif ($tranchesPayees == $totalTranches) {
        $this->etat = 2;  // Totalement payé
        
        // Vérifier si toutes les factures du chantier sont payées
        $chantier = $this->chantier;
        $toutesFacturesPayees = $chantier->factures->every(function($facture) {
            return $facture->etat == 2;
        });
        
        // Si oui, clôturer le chantier
        if ($toutesFacturesPayees) {
            $chantier->statut_completion = 'complet';
            $chantier->etat = false; // Fermé
            $chantier->save();
        }
    } else {
        $this->etat = 1;  // Partiellement payé
    }
    
    $this->save();
}
```

**Utilisation** :
```php
// Récupérer une facture
$facture = Facture::find(1);

// Mettre à jour le statut après un encaissement
$facture->updateFactureStatus();

// Vérifier le statut
if ($facture->etat == 2) {
    echo "Facture totalement payée !";
}
```

#### 5.3.4 Modèle TrancheFacture (app/Models/TrancheFacture.php)

**Rôle** : Représente une tranche de paiement d'une facture.

**Relations** :
- `facture()` : Une tranche appartient à une facture (belongsTo)
- `taux()` : Une tranche a un taux de TVA (belongsTo)
- `encaissements()` : Une tranche a plusieurs encaissements (hasMany)
- `historiques()` : Une tranche a un historique de modifications (hasMany)

**Champs importants** :
- `taux_honoraire` : Pourcentage des honoraires (ex: 30.00 pour 30%)
- `montant_honoraire` : Montant calculé des honoraires
- `taux_debours` : Pourcentage des débours
- `montant_debours` : Montant calculé des débours
- `etat` : true = payée, false = non payée

**Validation** :
```php
// Dans le contrôleur, avant de sauvegarder les tranches
$totalTauxHonoraire = TrancheFacture::where('id_facture', $id_facture)
    ->sum('taux_honoraire');

if ($totalTauxHonoraire != 100) {
    return back()->withErrors(['Le total des taux honoraires doit être 100%']);
}
```

#### 5.3.5 Modèle Encaissement (app/Models/Encaissement.php)

**Rôle** : Enregistre un paiement reçu du client.

**Relations** :
- `trancheFacture()` : Un encaissement appartient à une tranche (belongsTo)
- `modeEncaissement()` : Un encaissement a un mode de paiement (belongsTo)
- `chequeBanque()` : Un encaissement peut avoir un chèque (belongsTo, optionnel)

**Utilisation** :
```php
// Créer un encaissement
$encaissement = new Encaissement();
$encaissement->id_tranche_facture = 5;
$encaissement->datereel_encaissement = now();
$encaissement->montant_a_encaisse = 3250000;
$encaissement->reste_a_payer = 0;
$encaissement->id_mode_encaissement = 1; // Virement
$encaissement->save();

// Mettre à jour la tranche
$tranche = $encaissement->trancheFacture;
$tranche->etat = true; // Payée
$tranche->save();

// Mettre à jour le statut de la facture
$tranche->facture->updateFactureStatus();
```

#### 5.3.6 Modèle Budget (app/Models/Budget.php)

**Rôle** : Stocke les budgets par membre d'équipe.

**Relations** :
- `chantier()` : Un budget appartient à un chantier (belongsTo)
- `equipe()` : Un budget est lié à un membre d'équipe (belongsTo)

**Calcul** :
```php
// Total honoraires pour un membre
$totalHonoraires = $budget->nb_jour_homme * $budget->taux;

// Total pour tout le chantier
$totalChantier = Budget::where('id_chantier', $id_chantier)
    ->selectRaw('SUM(nb_jour_homme * taux) as total')
    ->first()
    ->total;
```

### 5.4 Les relations Eloquent expliquées

#### 5.4.1 Relation One-to-Many (Un-à-Plusieurs) - hasMany

**Exemple** : Un client a plusieurs chantiers.

```php
// Dans le modèle Client
public function chantiers()
{
    return $this->hasMany(Chantier::class, 'id_client', 'id_client');
    //                    ↑                  ↑            ↑
    //                    Modèle lié        Clé étrangère  Clé locale
}

// Utilisation
$client = Client::find(1);
$chantiers = $client->chantiers;  // Collection de tous les chantiers

// Compter les chantiers
$nombreChantiers = $client->chantiers()->count();

// Filtrer les chantiers
$chantiersOuverts = $client->chantiers()->where('etat', true)->get();
```

#### 5.4.2 Relation Inverse - belongsTo

**Exemple** : Un chantier appartient à un client.

```php
// Dans le modèle Chantier
public function client()
{
    return $this->belongsTo(Client::class, 'id_client', 'id_client');
}

// Utilisation
$chantier = Chantier::find(1);
$nomClient = $chantier->client->nom_client;
```

#### 5.4.3 Relation One-to-One (Un-à-Un) - hasOne

**Exemple** : Un chantier a une équipe.

```php
// Dans le modèle Chantier
public function equipe()
{
    return $this->hasOne(Equipe::class, 'id_chantier', 'id_chantier');
}

// Utilisation
$chantier = Chantier::find(1);
$equipe = $chantier->equipe;
```

#### 5.4.4 Relation Many-to-Many (Plusieurs-à-Plusieurs) - belongsToMany

**Exemple** : Une facture est liée à plusieurs budgets via une table pivot.

```php
// Dans le modèle Facture
public function budgets()
{
    return $this->belongsToMany(
        Budget::class,           // Modèle lié
        'facture_budget',        // Table pivot
        'id_facture',            // Clé étrangère de ce modèle
        'id_budget'              // Clé étrangère du modèle lié
    );
}

// Utilisation
$facture = Facture::find(1);
$budgets = $facture->budgets;

// Attacher un budget à une facture
$facture->budgets()->attach($id_budget);

// Détacher un budget
$facture->budgets()->detach($id_budget);

// Synchroniser (remplacer tous)
$facture->budgets()->sync([1, 2, 3]);
```

### 5.5 Eager Loading (Chargement anticipé)

**Problème N+1** : Évitez de faire trop de requêtes !

**Mauvais exemple** (problème N+1) :
```php
// Récupère 1 requête pour les clients
$clients = Client::all();

// Puis 1 requête par client pour les chantiers = N requêtes !
foreach ($clients as $client) {
    echo $client->chantiers;  // Requête à chaque fois !
}
// Total : 1 + N requêtes
```

**Bon exemple** (Eager Loading) :
```php
// Charge les clients ET leurs chantiers en 2 requêtes seulement
$clients = Client::with('chantiers')->get();

foreach ($clients as $client) {
    echo $client->chantiers;  // Pas de requête supplémentaire
}
// Total : 2 requêtes
```

**Charger plusieurs relations** :
```php
$chantiers = Chantier::with([
    'client',
    'factures.tranches',
    'budgets',
    'equipe'
])->get();
```

### 5.6 Opérations courantes sur les modèles

#### Créer (Create)
```php
// Méthode 1 : new + save
$client = new Client();
$client->nom_client = "Test Client";
$client->code_client = "T00001";
$client->save();

// Méthode 2 : create() (masse assignment)
$client = Client::create([
    'nom_client' => 'Test Client',
    'code_client' => 'T00001',
    'id_pays' => 1
]);
```

#### Lire (Read)
```php
// Tous les enregistrements
$clients = Client::all();

// Par ID
$client = Client::find(1);

// Par clé primaire ou exception
$client = Client::findOrFail(1);

// Premier résultat
$client = Client::where('code_client', 'U00001')->first();

// Avec conditions
$clients = Client::where('id_pays', 1)
    ->where('actif', true)
    ->get();

// Avec tri
$clients = Client::orderBy('nom_client', 'asc')->get();

// Avec pagination
$clients = Client::paginate(20);
```

#### Mettre à jour (Update)
```php
// Méthode 1 : find + save
$client = Client::find(1);
$client->nom_client = "Nouveau nom";
$client->save();

// Méthode 2 : update() direct
Client::where('id_client', 1)->update([
    'nom_client' => 'Nouveau nom'
]);

// Méthode 3 : findOrFail + update
$client = Client::findOrFail(1);
$client->update([
    'nom_client' => 'Nouveau nom'
]);
```

#### Supprimer (Delete)
```php
// Méthode 1 : find + delete
$client = Client::find(1);
$client->delete();

// Méthode 2 : destroy
Client::destroy(1);

// Méthode 3 : where + delete
Client::where('id_pays', 5)->delete();
```

### 5.7 Accessors et Mutators (Getters et Setters)

**Accessor** : Modifier une valeur AVANT de la retourner.

```php
// Dans le modèle TrancheFacture
public function getNumeroTrancheAttribute($value)
{
    // Extraire juste le numéro d'une tranche comme "1/3"
    return explode('/', $value)[0];
}

// Utilisation
$tranche = TrancheFacture::find(1);
echo $tranche->numero_tranche;  // Appelle automatiquement l'accessor
```

**Mutator** : Modifier une valeur AVANT de la sauvegarder.

```php
// Dans le modèle Client
public function setNomClientAttribute($value)
{
    // Toujours en majuscules
    $this->attributes['nom_client'] = strtoupper($value);
}

// Utilisation
$client = new Client();
$client->nom_client = "unicef";  // Sera sauvegardé comme "UNICEF"
```

### 5.8 Query Scopes (Requêtes réutilisables)

Les scopes permettent de créer des requêtes réutilisables.

```php
// Dans le modèle Chantier
public function scopeOuverts($query)
{
    return $query->where('etat', true);
}

public function scopeEnCours($query)
{
    return $query->where('statut_completion', 'en_cours');
}

// Utilisation
$chantiersOuverts = Chantier::ouverts()->get();
$chantiersEnCours = Chantier::enCours()->get();

// Chaînage
$chantiers = Chantier::ouverts()->enCours()->get();
```

### 5.9 Points importants à retenir

**✅ À TOUJOURS FAIRE** :

1. **Spécifier la clé primaire** dans chaque modèle :
   ```php
   protected $primaryKey = 'id_client';
   ```

2. **Utiliser `$fillable`** pour la sécurité :
   ```php
   protected $fillable = ['nom_client', 'code_client'];
   ```

3. **Utiliser Eager Loading** pour éviter le problème N+1 :
   ```php
   Client::with('chantiers')->get();
   ```

4. **Appeler `updateFactureStatus()`** après chaque encaissement

5. **Valider les données** avant de sauvegarder

**❌ À NE JAMAIS FAIRE** :

1. Ne jamais faire de requêtes dans une boucle
2. Ne jamais oublier `->save()` après modification
3. Ne jamais modifier directement la base de données sans passer par Eloquent

---

## 6. LES CONTRÔLEURS (CONTROLLERS) - LE CERVEAU DE L'APPLICATION

### 6.1 Introduction : Qu'est-ce qu'un contrôleur ?

Un **contrôleur** est une classe PHP qui contient la **logique métier** de votre application. C'est le "cerveau" qui décide quoi faire quand un utilisateur visite une page.

**Flux simplifié** :
```
1. Utilisateur clique sur "Liste des clients"
2. Laravel appelle ClientController@index
3. Le contrôleur récupère les clients depuis la base de données
4. Le contrôleur passe les données à la vue
5. La vue génère le HTML
6. L'utilisateur voit la liste des clients
```

### 6.2 Structure d'un contrôleur

Voici un contrôleur typique avec les opérations CRUD :

```php
<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Afficher la liste des clients (READ)
     */
    public function index()
    {
        // 1. Récupérer les données
        $clients = Client::with(['pays', 'paysGroupe'])->get();
        
        // 2. Passer les données à la vue
        return view('client.listClients', compact('clients'));
    }
    
    /**
     * Afficher le formulaire de création (CREATE - Formulaire)
     */
    public function create()
    {
        // Récupérer les données pour les listes déroulantes
        $pays = Pays::all();
        $formesJuridiques = FormeJuridique::all();
        
        return view('client.insertClient', compact('pays', 'formesJuridiques'));
    }
    
    /**
     * Enregistrer un nouveau client (CREATE - Traitement)
     */
    public function store(Request $request)
    {
        // 1. Valider les données
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'id_pays' => 'required|exists:pays,id_pays'
        ]);
        
        // 2. Générer le code client
        $validated['code_client'] = $this->generateCodeClient($validated['nom_client']);
        
        // 3. Créer le client
        Client::create($validated);
        
        // 4. Rediriger avec message de succès
        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès !');
    }
    
    /**
     * Afficher un client (READ - Détails)
     */
    public function show($id)
    {
        $client = Client::with(['chantiers'])->findOrFail($id);
        return view('client.detailsClient', compact('client'));
    }
    
    /**
     * Afficher le formulaire de modification (UPDATE - Formulaire)
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $pays = Pays::all();
        
        return view('client.editClient', compact('client', 'pays'));
    }
    
    /**
     * Mettre à jour un client (UPDATE - Traitement)
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'id_pays' => 'required|exists:pays,id_pays'
        ]);
        
        $client->update($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Client modifié avec succès !');
    }
    
    /**
     * Supprimer un client (DELETE)
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        
        // Vérifier s'il a des chantiers
        if ($client->chantiers()->count() > 0) {
            return redirect()->route('clients.index')
                ->with('error', 'Impossible de supprimer ce client car il a des missions.');
        }
        
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }
    
    /**
     * Méthode privée : Générer le code client
     */
    private function generateCodeClient($nomClient)
    {
        $premiereLettre = strtoupper(substr($nomClient, 0, 1));
        
        $dernierClient = Client::where('code_client', 'LIKE', $premiereLettre . '%')
            ->orderBy('code_client', 'desc')
            ->first();
        
        if ($dernierClient) {
            $numero = intval(substr($dernierClient->code_client, 1)) + 1;
        } else {
            $numero = 1;
        }
        
        return $premiereLettre . str_pad($numero, 5, '0', STR_PAD_LEFT);
    }
}
```

### 6.3 Les contrôleurs principaux du projet

#### 6.3.1 ClientController (app/Http/Controllers/ClientController.php)

**Rôle** : Gère tout ce qui concerne les clients.

**Méthodes principales** :
- `index()` : Liste tous les clients
- `create()` : Affiche le formulaire de création
- `store()` : Enregistre un nouveau client
- `show($id)` : Affiche les détails d'un client
- `edit($id)` : Affiche le formulaire de modification
- `update($id)` : Met à jour un client
- `destroy($id)` : Supprime un client
- `details($id)` : Affiche les détails complets (chantiers, factures)
- `search(Request $request)` : Recherche par nom client
- `generateCode()` : Génère automatiquement le code client
- `parSecteur()` : Liste les clients par secteur d'activité
- `parZone()` : Liste les clients par zone géographique (avec géocodage)

**Exemple d'utilisation** :
```php
// Dans routes/web.php
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
```

#### 6.3.2 ChantierController (app/Http/Controllers/ChantierController.php)

**Rôle** : Gère les missions/chantiers pour les clients.

**Méthodes principales** :
- `index()` : Liste tous les chantiers
- `create()` : Formulaire de création (étape 1 : infos générales)
- `store()` : Enregistre le chantier et redirige vers l'étape 2
- `show($id)` : Détails d'un chantier
- `edit($id)` : Modification d'un chantier
- `update($id)` : Met à jour un chantier
- `details($id)` : Détails complets avec budget, factures, etc.
- `parLigneMetier()` : Liste les chantiers par type de mission
- `getSousTypes($id_type)` : Récupère les sous-types de mission (AJAX)

**Workflow de création** :
```
1. create() → Formulaire général (client, type mission, objet)
2. store() → Sauvegarde + redirect vers GetDateController
3. GetDateController → Formulaire des dates
4. EquipeController → Formulaire de l'équipe
5. BudgetController → Formulaire du budget
6. Chantier complet !
```

**Exemple** :
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_client' => 'required|exists:clients,id_client',
        'id_type_mission' => 'required',
        'objet_chantier' => 'required'
    ]);
    
    // Créer le chantier
    $chantier = Chantier::create($validated);
    
    // Mettre à jour l'étape
    $chantier->etape_actuelle = 'date';
    $chantier->save();
    
    // Rediriger vers l'étape suivante (dates)
    return redirect()->route('getdate.create', $chantier->id_chantier);
}
```

#### 6.3.3 FactureController (app/Http/Controllers/FactureController.php)

**Rôle** : Gère la création et la gestion des factures.

**Méthodes principales** :
- `create($id_chantier)` : Formulaire de création de facture
- `store(Request $request)` : Enregistre une facture
- `edit($id)` : Formulaire de modification
- `update($id)` : Met à jour une facture
- `index()` : Liste toutes les factures
- `show($id)` : Détails d'une facture

**Logique importante** :
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_chantier' => 'required',
        'numero_facture' => 'required|unique:factures',
        'montant_total_honoraire' => 'required|numeric',
        'montant_total_debours' => 'nullable|numeric',
        'montant_debours_decaissable' => 'nullable|numeric',
        'montant_debours_non_decaissable' => 'nullable|numeric'
    ]);
    
    // Créer la facture
    $facture = Facture::create($validated);
    
    // Lier aux budgets
    if ($request->has('budgets')) {
        $facture->budgets()->attach($request->budgets);
    }
    
    // Rediriger vers création des tranches
    return redirect()->route('tranche.create', $facture->id_facture);
}
```

#### 6.3.4 TrancheFactureController (app/Http/Controllers/TrancheFactureController.php)

**Rôle** : Gère les tranches de facturation.

**Méthodes principales** :
- `create($id_facture)` : Formulaire de création des tranches
- `store(Request $request)` : Enregistre les tranches avec validation 100%
- `edit($id)` : Modification d'une tranche
- `update($id)` : Met à jour une tranche
- `show()` : Liste des tranches à émettre
- `listeEmise()` : Liste des tranches émises
- `voir($id)` : Détails d'une tranche
- `validerFacture($id)` : Valide et émet une tranche
- `annuler($id)` : Annule une tranche
- `checkNotifications()` : Vérifie les factures à émettre/recouvrer (AJAX)

**⚠️ VALIDATION TRÈS IMPORTANTE** :
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'tranches' => 'required|array',
        'tranches.*.taux_honoraire' => 'required|numeric|min:0|max:100',
        'tranches.*.taux_debours' => 'required|numeric|min:0|max:100'
    ]);
    
    // Vérifier que la somme des taux = 100%
    $totalTauxHonoraire = 0;
    $totalTauxDebours = 0;
    
    foreach ($validated['tranches'] as $tranche) {
        $totalTauxHonoraire += $tranche['taux_honoraire'];
        $totalTauxDebours += $tranche['taux_debours'];
    }
    
    if ($totalTauxHonoraire != 100) {
        return back()->withErrors([
            'error' => 'Le total des taux honoraires doit être exactement 100% (actuellement: ' . $totalTauxHonoraire . '%)'
        ]);
    }
    
    if ($totalTauxDebours != 100) {
        return back()->withErrors([
            'error' => 'Le total des taux débours doit être exactement 100% (actuellement: ' . $totalTauxDebours . '%)'
        ]);
    }
    
    // Créer les tranches
    foreach ($validated['tranches'] as $index => $trancheData) {
        TrancheFacture::create([
            'id_facture' => $request->id_facture,
            'numero_tranche' => ($index + 1),
            'taux_honoraire' => $trancheData['taux_honoraire'],
            'montant_honoraire' => ($trancheData['taux_honoraire'] / 100) * $facture->montant_total_honoraire,
            'taux_debours' => $trancheData['taux_debours'],
            'montant_debours' => ($trancheData['taux_debours'] / 100) * $facture->montant_total_debours,
            'date_previsionnelle' => $trancheData['date_previsionnelle'],
            'etat' => false
        ]);
    }
    
    return redirect()->route('tranche.show')->with('success', 'Tranches créées avec succès !');
}
```

#### 6.3.5 EncaissementController (app/Http/Controllers/EncaissementController.php)

**Rôle** : Gère les encaissements (paiements reçus).

**Méthodes principales** :
- `create($id_tranche)` : Formulaire d'encaissement
- `store(Request $request)` : Enregistre l'encaissement et met à jour les statuts
- `show()` : Liste tous les encaissements
- `liste(Request $request)` : Liste filtrée par client et dates
- `getChequeBanque($id_mode)` : Récupère les types de chèques (AJAX)

**⚠️ LOGIQUE CRITIQUE** :
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_tranche_facture' => 'required',
        'datereel_encaissement' => 'required|date',
        'id_mode_encaissement' => 'required',
        'montant_a_encaisse' => 'required|numeric'
    ]);
    
    // Créer l'encaissement
    $encaissement = Encaissement::create($validated);
    
    // Mettre à jour la tranche
    $tranche = TrancheFacture::find($validated['id_tranche_facture']);
    $tranche->etat = true; // Payée
    $tranche->save();
    
    // ⚠️ TRÈS IMPORTANT : Mettre à jour le statut de la facture
    $tranche->facture->updateFactureStatus();
    
    return redirect()->route('encaissement.show')
        ->with('success', 'Encaissement enregistré avec succès !');
}
```

#### 6.3.6 BudgetController (app/Http/Controllers/BudgetController.php)

**Rôle** : Gère les budgets des chantiers.

**Méthodes principales** :
- `create($id_chantier)` : Formulaire de budgétisation
- `store(Request $request)` : Enregistre les budgets
- `edit($id_chantier)` : Modification du budget
- `update(Request $request, $id_chantier)` : Met à jour le budget
- `storeTotal(Request $request)` : Enregistre le total global
- `jourHommeParPeriode()` : Rapport jours-homme par période

**Calculs automatiques** :
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'budgets' => 'required|array',
        'budgets.*.id_equipe' => 'required',
        'budgets.*.nb_jour_homme' => 'required|numeric',
        'budgets.*.taux' => 'required|numeric'
    ]);
    
    $totalGlobal = 0;
    $totalJoursHomme = 0;
    
    foreach ($validated['budgets'] as $budgetData) {
        // Créer le budget
        $budget = Budget::create([
            'id_chantier' => $request->id_chantier,
            'id_equipe' => $budgetData['id_equipe'],
            'nb_jour_homme' => $budgetData['nb_jour_homme'],
            'taux' => $budgetData['taux']
        ]);
        
        // Calculer les totaux
        $montant = $budgetData['nb_jour_homme'] * $budgetData['taux'];
        $totalGlobal += $montant;
        $totalJoursHomme += $budgetData['nb_jour_homme'];
    }
    
    // Sauvegarder le total
    TotalBudget::updateOrCreate(
        ['id_chantier' => $request->id_chantier],
        [
            'total_global' => $totalGlobal,
            'total_jour_homme' => $totalJoursHomme,
            'taux_moyen' => $totalJoursHomme > 0 ? $totalGlobal / $totalJoursHomme : 0
        ]
    );
    
    return redirect()->route('facture.create', $request->id_chantier);
}
```

#### 6.3.7 DashboardController (app/Http/Controllers/DashboardController.php)

**Rôle** : Affiche le tableau de bord avec statistiques et graphiques.

**Méthodes principales** :
- `index()` : Page d'accueil avec tous les graphiques
- `getMissionStats()` : Statistiques des missions
- `getFactureStats()` : Statistiques des factures
- `getChartData()` : Données pour les graphiques

**Exemple** :
```php
public function index()
{
    // Statistiques générales
    $totalClients = Client::count();
    $totalChantiers = Chantier::count();
    $chantiersEnCours = Chantier::where('statut_completion', 'en_cours')->count();
    $chantiersComplets = Chantier::where('statut_completion', 'complet')->count();
    
    // Factures par état
    $facturesNonPayees = Facture::where('etat', 0)->count();
    $facturesPartielles = Facture::where('etat', 1)->count();
    $facturesTotalementPayees = Facture::where('etat', 2)->count();
    
    // Graphiques
    $facturesParMois = Facture::selectRaw('EXTRACT(MONTH FROM date_facture) as mois, COUNT(*) as total')
        ->whereYear('date_facture', date('Y'))
        ->groupBy('mois')
        ->get();
    
    $budgetsParMois = TotalBudget::selectRaw('EXTRACT(MONTH FROM created_at) as mois, SUM(total_global) as total')
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->get();
    
    return view('dashboard.index', compact(
        'totalClients',
        'totalChantiers',
        'chantiersEnCours',
        'chantiersComplets',
        'facturesNonPayees',
        'facturesPartielles',
        'facturesTotalementPayees',
        'facturesParMois',
        'budgetsParMois'
    ));
}
```

#### 6.3.8 RapportController (app/Http/Controllers/RapportController.php)

**Rôle** : Génère les rapports et analyses.

**Méthodes principales** :
- `barometre()` : Baromètre de facturation (vue SQL `v_barometre`)
- `barometreFiltre(Request $request)` : Baromètre filtré par année
- `cloture()` : Liste des missions clôturées (factures 100% payées)
- `detailsFinal($id_facture)` : Rapport final avec TVA
- `verif()` : Vérification de la complétude des tranches

**Exemple du baromètre** :
```php
public function barometre()
{
    // Utilise la vue SQL v_barometre
    $barometre = DB::table('v_barometre')
        ->whereYear('annee', date('Y'))
        ->get();
    
    return view('rapport_final.barometre', compact('barometre'));
}

public function barometreFiltre(Request $request)
{
    $annee = $request->input('annee', date('Y'));
    
    $barometre = DB::table('v_barometre')
        ->whereYear('annee', $annee)
        ->get();
    
    return view('rapport_final.barometre_filtre', compact('barometre', 'annee'));
}
```

### 6.4 Validation des données

Laravel offre un système de validation très puissant.

**Règles de validation courantes** :
```php
$request->validate([
    'nom_client' => 'required|string|max:255',
    'email' => 'required|email|unique:clients,email',
    'id_pays' => 'required|exists:pays,id_pays',
    'montant' => 'required|numeric|min:0',
    'date' => 'required|date|after:today',
    'fichier' => 'required|file|mimes:pdf,xlsx|max:2048', // 2 MB max
    'password' => 'required|min:8|confirmed', // password_confirmation doit exister
]);
```

**Messages d'erreur personnalisés** :
```php
$request->validate([
    'nom_client' => 'required|max:255'
], [
    'nom_client.required' => 'Le nom du client est obligatoire',
    'nom_client.max' => 'Le nom ne peut pas dépasser 255 caractères'
]);
```

**Validation personnalisée** :
```php
$request->validate([
    'taux' => [
        'required',
        'numeric',
        function ($attribute, $value, $fail) {
            if ($value < 0 || $value > 100) {
                $fail('Le taux doit être entre 0 et 100%');
            }
        }
    ]
]);
```

### 6.5 Redirection et messages flash

**Redirection simple** :
```php
return redirect()->route('clients.index');
```

**Avec message de succès** :
```php
return redirect()->route('clients.index')
    ->with('success', 'Client créé avec succès !');
```

**Avec message d'erreur** :
```php
return redirect()->back()
    ->with('error', 'Une erreur est survenue.');
```

**Avec données (old input)** :
```php
return redirect()->back()
    ->withInput()
    ->withErrors(['nom' => 'Le nom est invalide']);
```

### 6.6 Réponses JSON (pour AJAX)

**Retourner du JSON** :
```php
public function getSousTypes($id_type)
{
    $sousTypes = SousTypeMission::where('id_type_mission', $id_type)->get();
    return response()->json($sousTypes);
}
```

**Avec code HTTP** :
```php
return response()->json(['message' => 'Non trouvé'], 404);
return response()->json(['data' => $data], 200);
```

### 6.7 Points importants à retenir

**✅ À TOUJOURS FAIRE** :

1. **Valider toutes les données** avant de les sauvegarder
2. **Utiliser `findOrFail()`** au lieu de `find()` pour éviter les erreurs
3. **Rediriger après un POST** pour éviter les doubles soumissions
4. **Utiliser `with()` (Eager Loading)** pour optimiser les requêtes
5. **Retourner des messages flash** pour informer l'utilisateur

**❌ À NE JAMAIS FAIRE** :

1. Ne jamais faire confiance aux données utilisateur sans validation
2. Ne jamais retourner une vue après un POST (toujours rediriger)
3. Ne jamais hardcoder des valeurs (utiliser des configs)
4. Ne jamais exposer des données sensibles dans les réponses JSON

---

## 7. LES ROUTES - COMMENT L'APPLICATION RÉPOND AUX URLs

### 7.1 Introduction : Qu'est-ce qu'une route ?

Une **route** est la définition d'une URL et de l'action à exécuter quand un utilisateur visite cette URL.

**Exemple simple** :
```php
// Fichier : routes/web.php
Route::get('/clients', [ClientController::class, 'index']);
```

Cela signifie : "Quand l'utilisateur visite `/clients`, appelle la méthode `index` du `ClientController`".

### 7.2 Les types de routes HTTP

Laravel supporte toutes les méthodes HTTP :

```php
// GET : Récupérer des données (afficher une page)
Route::get('/clients', [ClientController::class, 'index']);

// POST : Envoyer des données (créer quelque chose)
Route::post('/clients', [ClientController::class, 'store']);

// PUT/PATCH : Mettre à jour des données
Route::put('/clients/{id}', [ClientController::class, 'update']);

// DELETE : Supprimer des données
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);
```

### 7.3 Routes avec paramètres

**Paramètre obligatoire** :
```php
Route::get('/clients/{id}', [ClientController::class, 'show']);
// URL : /clients/5
// Dans le contrôleur : public function show($id) { ... }
```

**Paramètre optionnel** :
```php
Route::get('/clients/{id?}', [ClientController::class, 'show']);
// URL : /clients/5 ou /clients
```

**Paramètre avec contrainte** :
```php
Route::get('/clients/{id}', [ClientController::class, 'show'])
    ->where('id', '[0-9]+'); // Seulement des chiffres
```

### 7.4 Routes nommées

Les routes peuvent avoir des **noms** pour faciliter leur utilisation :

```php
// Définir une route nommée
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

// Utiliser dans un contrôleur
return redirect()->route('clients.index');

// Utiliser dans une vue Blade
<a href="{{ route('clients.index') }}">Liste des clients</a>

// Avec paramètres
<a href="{{ route('clients.show', $client->id_client) }}">Voir le client</a>
```

### 7.5 Resource Routes (Routes CRUD automatiques)

Laravel peut générer automatiquement 7 routes pour un CRUD complet :

```php
Route::resource('clients', ClientController::class);
```

**Génère automatiquement** :

- **Méthode HTTP** : GET - URL : /clients - Action : index - Nom de route : clients.index - Description : Liste
- **Méthode HTTP** : GET - URL : /clients/create - Action : create - Nom de route : clients.create - Description : Formulaire création
- **Méthode HTTP** : POST - URL : /clients - Action : store - Nom de route : clients.store - Description : Enregistrer
- **Méthode HTTP** : GET - URL : /clients/{id} - Action : show - Nom de route : clients.show - Description : Détails
- **Méthode HTTP** : GET - URL : /clients/{id}/edit - Action : edit - Nom de route : clients.edit - Description : Formulaire édition
- **Méthode HTTP** : PUT/PATCH - URL : /clients/{id} - Action : update - Nom de route : clients.update - Description : Mettre à jour
- **Méthode HTTP** : DELETE - URL : /clients/{id} - Action : destroy - Nom de route : clients.destroy - Description : Supprimer


### 7.6 Groupes de routes

Pour appliquer des configurations à plusieurs routes :

**Middleware** :
```php
// Toutes ces routes nécessitent une authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('clients', ClientController::class);
    Route::resource('chantiers', ChantierController::class);
});
```

**Préfixe** :
```php
// Toutes les URLs commenceront par /admin
Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'users']); // URL : /admin/users
    Route::get('/settings', [AdminController::class, 'settings']); // URL : /admin/settings
});
```

**Namespace** :
```php
// Préfixe de nom pour toutes les routes
Route::name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users'); 
    // Nom complet : admin.users
});
```

### 7.7 Les routes du projet (routes/web.php)

Ce projet contient **201 routes** organisées par domaine. Voici les principales :

#### 7.7.1 Routes d'authentification

```php
use App\Http\Controllers\AuthController;

// Formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Traiter la connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Déconnexion
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
```

#### 7.7.2 Routes protégées (nécessitent authentification)

```php
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Clients
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/insert', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::post('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/clients/details/{id_client}', [ClientController::class, 'details'])->name('clients.details');
    Route::get('/client/secteur', [ClientController::class, 'parSecteur'])->name('client.secteur');
    Route::get('/client/zone', [ClientController::class, 'parZone'])->name('client.zone');
    
    // Chantiers
    Route::get('/chantier', [ChantierController::class, 'index'])->name('chantier.index');
    Route::get('/chantier/insert', [ChantierController::class, 'create'])->name('chantier.create');
    Route::post('/chantier/store', [ChantierController::class, 'store'])->name('chantier.store');
    Route::get('/chantier/edit/{id}', [ChantierController::class, 'edit'])->name('chantier.edit');
    Route::post('/chantier/update/{id}', [ChantierController::class, 'update'])->name('chantier.update');
    Route::get('/chantiers/details/{id_chantier}', [ChantierController::class, 'details'])->name('chantiers.details');
    Route::get('/chantiers/lignemetier', [ChantierController::class, 'parLigneMetier'])->name('chantiers.lignemetier');
    
    // AJAX - Sous-types de mission
    Route::get('/get-sous-types/{id_type_mission}', [ChantierController::class, 'getSousTypes'])->name('get.sous.types');
    
    // Dates (GetDate)
    Route::get('/getdate/create/{id_chantier}', [GetDateController::class, 'create'])->name('getdate.create');
    Route::post('/getdate/store', [GetDateController::class, 'store'])->name('getdate.store');
    Route::get('/getdate/modifier/{id_chantier}', [GetDateController::class, 'edit'])->name('getdate.edit');
    Route::post('/getdate/update/{id_chantier}', [GetDateController::class, 'update'])->name('getdate.update');
    
    // Équipes
    Route::get('/equipe/create/{id_chantier}', [EquipeController::class, 'create'])->name('equipe.create');
    Route::post('/equipe/store', [EquipeController::class, 'store'])->name('equipe.store');
    Route::get('/equipe/modifier/{id_chantier}', [EquipeController::class, 'edit'])->name('equipe.edit');
    Route::post('/equipe/update/{id_chantier}', [EquipeController::class, 'update'])->name('equipe.update');
    
    // Budgets
    Route::get('/budget/create/{id_chantier}', [BudgetController::class, 'create'])->name('budget.create');
    Route::post('/budget/store', [BudgetController::class, 'store'])->name('budget.store');
    Route::get('/budget/modifier/{id_chantier}', [BudgetController::class, 'edit'])->name('budget.edit');
    Route::post('/budget/update/{id_chantier}', [BudgetController::class, 'update'])->name('budget.update');
    Route::post('/budget/storetotal', [BudgetController::class, 'storeTotal'])->name('budget.storetotal');
    Route::get('/budget/jour-homme', [BudgetController::class, 'jourHommeParPeriode'])->name('budget.jourhomme');
    
    // Factures
    Route::get('/facture/create/{id_chantier}', [FactureController::class, 'create'])->name('facture.create');
    Route::post('/facture/store', [FactureController::class, 'store'])->name('facture.store');
    Route::get('/facture/modifier/{id_facture}', [FactureController::class, 'edit'])->name('facture.edit');
    Route::post('/facture/update/{id_facture}', [FactureController::class, 'update'])->name('facture.update');
    Route::get('/facture', [FactureController::class, 'index'])->name('facture.index');
    
    // Tranches de facturation
    Route::get('/tranche/create/{id_facture}', [TrancheFactureController::class, 'create'])->name('tranche.create');
    Route::post('/tranche/store', [TrancheFactureController::class, 'store'])->name('tranche.store');
    Route::get('/tranche/modifier/{id_tranche_facture}', [TrancheFactureController::class, 'edit'])->name('tranche.edit');
    Route::post('/tranche/update/{id_tranche_facture}', [TrancheFactureController::class, 'update'])->name('tranche.update');
    Route::get('/tranche/show', [TrancheFactureController::class, 'show'])->name('tranche.show');
    Route::get('/tranche/liste_emise', [TrancheFactureController::class, 'listeEmise'])->name('tranche.emise');
    Route::get('/tranche/voir/{id}', [TrancheFactureController::class, 'voir'])->name('tranche.voir');
    Route::get('/tranche/details/{id}', [TrancheFactureController::class, 'details'])->name('tranche.details');
    Route::post('/valider-facture/{id}', [TrancheFactureController::class, 'validerFacture'])->name('tranche.valider');
    Route::post('/facturer-tranche-annuler/{id}', [TrancheFactureController::class, 'annuler'])->name('tranche.annuler');
    
    // AJAX - Notifications
    Route::get('/notifications/check', [TrancheFactureController::class, 'checkNotifications'])->name('notifications.check');
    
    // Encaissements
    Route::get('/encaissement/create/{id_tranche_facture}', [EncaissementController::class, 'create'])->name('encaissement.create');
    Route::post('/encaissement/insert', [EncaissementController::class, 'store'])->name('encaissement.store');
    Route::get('/encaissement/show', [EncaissementController::class, 'show'])->name('encaissement.show');
    Route::post('/encaissement/liste', [EncaissementController::class, 'liste'])->name('encaissement.liste');
    
    // AJAX - Types de chèques
    Route::get('/get-cheque-banque/{id_mode_encaissement}', [EncaissementController::class, 'getChequeBanque'])->name('get.cheque.banque');
    
    // Choix Banques
    Route::get('/choix/create/{id_facture}', [ChoixBanqueController::class, 'create'])->name('choix.create');
    Route::post('/choix-banque/{id_facture}', [ChoixBanqueController::class, 'store'])->name('choix.store');
    Route::get('/banques/create', [ChoixBanqueController::class, 'createBanque'])->name('banques.create');
    Route::post('/banques', [ChoixBanqueController::class, 'storeBanque'])->name('banques.store');
    Route::get('/liste/banque', [ChoixBanqueController::class, 'listeBanque'])->name('banques.liste');
    
    // Rapports
    Route::get('/rapport/barometre', [RapportController::class, 'barometre'])->name('rapport.barometre');
    Route::post('/barometre-filtre', [RapportController::class, 'barometreFiltre'])->name('barometre.filtre');
    Route::get('/cloture/show', [RapportController::class, 'cloture'])->name('cloture.show');
    Route::get('/rapport/details/{id_facture}', [RapportController::class, 'detailsFinal'])->name('rapport.details');
    Route::get('/verif', [RapportController::class, 'verif'])->name('verif');
    
    // Administration
    Route::get('/enregistrement', [SocieteChequePersonnelTauxController::class, 'index'])->name('admin.index');
    Route::get('/personnel', [SocieteChequePersonnelTauxController::class, 'personnel'])->name('admin.personnel');
    Route::post('/personnel/store', [SocieteChequePersonnelTauxController::class, 'storePersonnel'])->name('admin.personnel.store');
    Route::get('/taux', [SocieteChequePersonnelTauxController::class, 'taux'])->name('admin.taux');
    
    // Import Excel
    Route::get('/importclient', [ClientController::class, 'showImportForm'])->name('import.client.form');
    Route::post('/import/clients', [ClientController::class, 'import'])->name('import.clients');
    Route::get('/importchantier', [ChantierController::class, 'showImportForm'])->name('import.chantier.form');
    Route::post('/import/chantiers', [ChantierController::class, 'import'])->name('import.chantiers');
    Route::get('/importbudgetfacture', [ImportController::class, 'showForm'])->name('import.budget.form');
    Route::post('/import', [ImportController::class, 'import'])->name('import.budget');
});
```

#### 7.7.3 Routes Consultant (accès restreint)

```php
Route::prefix('consultant')->middleware(['auth'])->group(function () {
    Route::get('/home', [ConsultantController::class, 'home'])->name('consultant.home');
    Route::get('/listeClient', [ConsultantController::class, 'listeClient'])->name('consultant.clients');
    Route::get('/trancheConsultant/show', [ConsultantController::class, 'showTranches'])->name('consultant.tranches');
    Route::post('/trancheConsultant/liste', [ConsultantController::class, 'listeTranches'])->name('consultant.tranches.liste');
});
```

### 7.8 Middleware : Protéger les routes

**Qu'est-ce qu'un middleware ?** C'est un "filtre" qui s'exécute avant qu'une route soit accessible.

**Middleware d'authentification** :
```php
// Dans routes/web.php
Route::middleware(['auth'])->group(function () {
    // Ces routes nécessitent une connexion
});
```

**Créer un middleware personnalisé** :
```bash
php artisan make:middleware CheckRole
```

```php
// app/Http/Middleware/CheckRole.php
public function handle($request, Closure $next, $role)
{
    if (auth()->user()->role !== $role) {
        abort(403, 'Accès interdit');
    }
    
    return $next($request);
}
```

**Utiliser le middleware** :
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Seulement pour les admins
});
```

### 7.9 Redirection de routes

**Redirection simple** :
```php
Route::redirect('/ancienne-url', '/nouvelle-url');
```

**Redirection permanente (301)** :
```php
Route::redirect('/ancienne-url', '/nouvelle-url', 301);
```

**Redirection vers une route nommée** :
```php
Route::get('/home', function () {
    return redirect()->route('dashboard');
});
```

### 7.10 Commandes utiles pour les routes

```bash
# Lister toutes les routes
php artisan route:list

# Lister avec filtres
php artisan route:list --name=client  # Routes contenant "client"
php artisan route:list --method=GET   # Seulement les GET

# Vider le cache des routes
php artisan route:clear

# Mettre en cache les routes (production)
php artisan route:cache
```

### 7.11 Points importants à retenir

**✅ À TOUJOURS FAIRE** :

1. **Nommer toutes vos routes** pour faciliter les redirections et liens
2. **Grouper les routes** avec middleware pour éviter la répétition
3. **Utiliser resource()** pour les CRUD complets
4. **Protéger les routes sensibles** avec des middleware
5. **Utiliser des contraintes** pour les paramètres quand nécessaire

**❌ À NE JAMAIS FAIRE** :

1. Ne jamais hardcoder les URLs (utiliser `route()`)
2. Ne jamais exposer des routes d'administration sans protection
3. Ne jamais oublier la méthode CSRF sur les formulaires POST
4. Ne jamais créer trop de routes sans organisation (utilisez des groupes)

**Exemple de bonne pratique** :
```php
// ❌ Mauvais
<form action="/clients/5/update" method="POST">

// ✅ Bon
<form action="{{ route('clients.update', $client->id_client) }}" method="POST">
    @csrf
    @method('PUT')
</form>
```

---


---

## 8. LES VUES (VIEWS) - CE QUE L'UTILISATEUR VOIT

### 8.1 Qu'est-ce qu'une vue ?

**Une vue, c'est la page HTML que l'utilisateur voit dans son navigateur.**

Imaginez que vous construisez une maison :
- **Le modèle** = les plans et la structure (les données)
- **Le contrôleur** = les ouvriers qui font le travail (la logique)
- **La vue** = la décoration finale que les visiteurs voient (l'affichage)

**Dans Laravel, les vues utilisent le moteur de template "Blade".**

### 8.2 Qu'est-ce que Blade ?

**Blade est un langage de template qui facilite l'écriture de HTML avec des données dynamiques.**

Au lieu d'écrire du PHP mélangé avec du HTML (ce qui est illisible), Blade offre une syntaxe claire et élégante.

**Exemple simple :**

```blade
<!-- Sans Blade (PHP pur) - DIFFICILE À LIRE -->
<?php if ($user->age >= 18): ?>
    <p>Bienvenue <?php echo $user->name; ?></p>
<?php endif; ?>

<!-- Avec Blade - CLAIR ET LISIBLE -->
@if($user->age >= 18)
    <p>Bienvenue {{ $user->name }}</p>
@endif
```

**Tous les fichiers de vue se terminent par `.blade.php`** et se trouvent dans `resources/views/`

### 8.3 Structure des vues dans le projet

Voici l'organisation des dossiers de vues :

```
resources/views/
├── layouts/                    # Templates de base (navbar, sidebar, etc.)
│   ├── app.blade.php          # Layout principal utilisé par toutes les pages
│   ├── navbar.blade.php       # Barre de navigation standard
│   ├── sidebar.blade.php      # Menu latéral standard
│   ├── navbarConsultant.blade.php  # Navigation pour consultants
│   ├── sidebarConsultant.blade.php # Menu pour consultants
│   ├── foot.blade.php         # Pied de page
│   └── footConsultant.blade.php
│
├── client/                     # Vues pour les clients
│   ├── listClients.blade.php  # Liste de tous les clients
│   ├── insertClient.blade.php # Formulaire création client
│   ├── editClient.blade.php   # Formulaire modification client
│   ├── detailsClient.blade.php # Détails d'un client
│   ├── clients_par_zone.blade.php
│   └── clients_par_secteur.blade.php
│
├── chantier/                   # Vues pour les chantiers
│   ├── listChantier.blade.php
│   ├── insertChantier.blade.php
│   ├── editChantier.blade.php
│   └── detailsChantier.blade.php
│
├── facture/                    # Vues pour les factures
│   ├── listeFacture.blade.php
│   ├── insertFacture.blade.php
│   └── editFacture.blade.php
│
├── tranche_facture/            # Vues pour les tranches
│   ├── insertTrancheFacture.blade.php
│   └── editTrancheFacture.blade.php
│
├── encaissement/               # Vues pour les encaissements
│   ├── insertEncaissement.blade.php
│   └── editEncaissement.blade.php
│
├── budget/                     # Vues pour les budgets
├── equipe/                     # Vues pour les équipes
├── getdate/                    # Vues pour les dates chantier
├── choix_banque/              # Vues pour choix banque
├── import/                     # Vues pour imports Excel
├── rapport_final/             # Vues pour les rapports
├── auth/                       # Vues d'authentification
│   ├── login.blade.php
│   ├── register.blade.php
│   └── verify-code.blade.php
│
└── consultant/                 # Vues spécifiques consultants
    ├── dashboardConsultant.blade.php
    ├── clientsConsultant.blade.php
    └── ...
```

**Total : 32 dossiers de vues organisés par domaine métier.**

### 8.4 Le layout principal : app.blade.php

**C'est le template de base utilisé par TOUTES les pages de l'application.**

Voici sa structure :

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Facture</title>

    <!-- CSS : Bootstrap, LineIcons, Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}" />

    <!-- JavaScript : jQuery, Select2 -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js')}}"></script>
</head>
<body>
    <!-- SIDEBAR (Menu latéral) -->
    @if (Auth::user()->role === 'Admin')
        @include('layouts.sidebar')
    @elseif (Auth::user()->role === 'Consultant')
        @include('layouts.sidebarConsultant')
    @endif

    <!-- MAIN WRAPPER -->
    <main class="main-wrapper">
        <!-- NAVBAR (Barre de navigation) -->
        @if (Auth::user()->role === 'Admin')
            @include('layouts.navbar')
        @elseif (Auth::user()->role === 'Consultant')
            @include('layouts.navbarConsultant')
        @endif

        <!-- SECTION CONTENT (C'est ici que le contenu de chaque page s'affiche) -->
        <section class="section">
            <div class="container-fluid">
                @yield('content')  <!-- ← Le contenu de chaque page s'insère ICI -->
            </div>
        </section>

        <!-- FOOTER (Pied de page) -->
        @if (Auth::user()->role === 'Admin')
            @include('layouts.foot')
        @elseif (Auth::user()->role === 'Consultant')
            @include('layouts.footConsultant')
        @endif
    </main>

    <!-- JavaScript : Bootstrap, Chart.js, etc. -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Avertissement avant de quitter le processus de création -->
    <script>
        const urlPath = window.location.pathname;
        const isCreationProcess = urlPath.includes('/chantier/create') ||
                                 urlPath.includes('/facture/create') ||
                                 urlPath.includes('/tranche/create');

        if (isCreationProcess) {
            window.addEventListener('beforeunload', function (e) {
                e.preventDefault();
                e.returnValue = '';
                return 'Vous avez un processus de création en cours...';
            });
        }
    </script>
</body>
</html>
```

**Explication détaillée :**

1. **`{{ csrf_token() }}`** : Token de sécurité Laravel (obligatoire pour les formulaires)
2. **`{{ asset('assets/css/...') }}`** : Charge les fichiers CSS depuis le dossier `public/assets/`
3. **`@if (Auth::user()->role === 'Admin')`** : Vérifie le rôle de l'utilisateur connecté
4. **`@include('layouts.sidebar')`** : Inclut le fichier `layouts/sidebar.blade.php`
5. **`@yield('content')`** : Zone où le contenu de chaque page sera injecté
6. **Script beforeunload** : Avertit l'utilisateur avant de quitter un processus de création

### 8.5 Les directives Blade les plus importantes

**Les directives Blade commencent toujours par `@`**

#### 8.5.1 Afficher des données : `{{ }}` et `{!! !!}`

```blade
<!-- Affichage SÉCURISÉ (échappe le HTML) - TOUJOURS UTILISER CECI -->
<p>Nom du client : {{ $client->nom_client }}</p>

<!-- Si $client->nom_client = "<script>alert('Hack')</script>" -->
<!-- Blade va afficher : &lt;script&gt;alert('Hack')&lt;/script&gt; -->
<!-- Le script ne s'exécute PAS = SÉCURISÉ -->

<!-- Affichage NON SÉCURISÉ (n'échappe pas le HTML) - ATTENTION DANGER -->
<p>Description : {!! $description !!}</p>
<!-- Si $description contient du HTML, il sera exécuté -->
<!-- Utilisez SEULEMENT si vous êtes SÛR que le contenu est sûr -->
```

**Règle d'or : TOUJOURS utiliser `{{ }}` sauf si vous avez une TRÈS bonne raison.**

#### 8.5.2 Conditions : `@if`, `@elseif`, `@else`, `@endif`

```blade
<!-- Exemple simple -->
@if($client->actif)
    <span class="badge bg-success">Actif</span>
@else
    <span class="badge bg-danger">Inactif</span>
@endif

<!-- Exemple avec plusieurs conditions -->
@if($facture->etat == 0)
    <span class="text-danger">Non payée</span>
@elseif($facture->etat == 1)
    <span class="text-warning">Partiellement payée</span>
@else
    <span class="text-success">Totalement payée</span>
@endif

<!-- Vérifier si une variable existe -->
@if(isset($message))
    <div class="alert alert-info">{{ $message }}</div>
@endif

<!-- Vérifier si une variable n'est pas nulle -->
@if($client->sigle_client)
    <p>Sigle : {{ $client->sigle_client }}</p>
@endif
```

#### 8.5.3 Conditions spéciales : `@isset`, `@empty`, `@auth`

```blade
<!-- Vérifier si une variable est définie -->
@isset($client)
    <p>Client : {{ $client->nom_client }}</p>
@endisset

<!-- Vérifier si une variable est vide -->
@empty($clients)
    <p>Aucun client trouvé.</p>
@endempty

<!-- Vérifier si l'utilisateur est connecté -->
@auth
    <p>Bienvenue {{ Auth::user()->name }}</p>
@endauth

<!-- Vérifier si l'utilisateur n'est PAS connecté -->
@guest
    <p>Veuillez vous connecter</p>
@endguest
```

#### 8.5.4 Boucles : `@foreach`, `@for`, `@while`

```blade
<!-- FOREACH : Parcourir une collection (LE PLUS UTILISÉ) -->
@foreach($clients as $client)
    <tr>
        <td>{{ $client->code_client }}</td>
        <td>{{ $client->nom_client }}</td>
        <td>{{ $client->pays->nom_pays ?? '-' }}</td>
    </tr>
@endforeach

<!-- Si la collection est vide, afficher un message -->
@forelse($clients as $client)
    <tr>
        <td>{{ $client->nom_client }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3">Aucun client trouvé</td>
    </tr>
@endforelse

<!-- FOR : Boucle classique avec un compteur -->
@for($i = 0; $i < $facture->nb_tranche_facture; $i++)
    <h3>Tranche {{ $i + 1 }}</h3>
    <input type="text" name="tranches[{{ $i }}][taux_honoraire]">
@endfor

<!-- WHILE : Boucle tant qu'une condition est vraie (rarement utilisé) -->
@while($count < 10)
    <p>Itération {{ $count }}</p>
    @php $count++; @endphp
@endwhile
```

**Dans une boucle, vous avez accès à la variable `$loop` :**

```blade
@foreach($clients as $client)
    <!-- Numéro de l'itération (commence à 1) -->
    <p>Client #{{ $loop->iteration }}</p>

    <!-- Index de l'itération (commence à 0) -->
    <p>Index : {{ $loop->index }}</p>

    <!-- Est-ce la première itération ? -->
    @if($loop->first)
        <h2>Premier client</h2>
    @endif

    <!-- Est-ce la dernière itération ? -->
    @if($loop->last)
        <hr>
    @endif

    <!-- Nombre total d'éléments -->
    <p>Total : {{ $loop->count }}</p>
@endforeach
```

#### 8.5.5 Héritage et inclusion de templates

```blade
<!-- ÉTENDRE un layout -->
@extends('layouts.app')
<!-- Cette vue va utiliser le layout app.blade.php -->

<!-- DÉFINIR une section -->
@section('content')
    <h1>Liste des clients</h1>
    <p>Contenu de la page...</p>
@endsection

<!-- INCLURE un autre fichier Blade -->
@include('layouts.sidebar')
<!-- Inclut le fichier layouts/sidebar.blade.php -->

<!-- INCLURE avec des données -->
@include('components.alert', ['type' => 'success', 'message' => 'Opération réussie'])
```

**Comment ça marche ?**

1. Vous créez un layout de base (ex: `app.blade.php`) avec `@yield('content')`
2. Vos pages étendent ce layout avec `@extends('layouts.app')`
3. Vous remplissez la zone `content` avec `@section('content')`

### 8.6 Exemple complet : Liste des clients

Voici le fichier `resources/views/client/listClients.blade.php` :

```blade
@extends('layouts.app')

@section('content')
    <!-- Afficher le message de succès après une action -->
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Titre de la page -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Liste des Clients</h2>
            </div>
            
            <!-- Barre de recherche -->
            <div class="col-md-6">
                <form action="{{ route('clients.search') }}" method="GET">
                    <button><i class="lni lni-search-alt"></i></button>
                    <input type="text" name="nom_client" placeholder="Recherche client..." />
                </form>
            </div>
        </div>
    </div>

    <!-- Tableau des clients -->
    @if($clients->isEmpty())
        <p>Aucun client trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Code Client</th>
                    <th>Nom Client</th>
                    <th>Sigle</th>
                    <th>Type</th>
                    <th>Mission</th>
                    <th>Adresse</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr id="client-row-{{ $client->id_client }}">
                        <td>{{ $client->code_client }}</td>
                        <td>{{ $client->nom_client }}</td>
                        <td>{{ $client->sigle_client ?? '-' }}</td>
                        <td>{{ $client->type ?? '-' }}</td>
                        <td>{{ $client->secteurActivite->nom_secteur_activite ?? '-' }}</td>
                        <td>{{ $client->adresse_client ?? '-' }}</td>
                        <td>{{ $client->pays->nom_pays ?? '-' }}</td>
                        <td>
                            <!-- Bouton dropdown pour les actions -->
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="lni lni-more-alt"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('client.modifier', ['id_client' => $client->id_client]) }}">
                                        Modifier
                                    </a>
                                </li>
                                <li>
                                    <a class="btn-delete-client" data-id_client="{{ $client->id_client }}">
                                        Supprimer
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- JavaScript pour la suppression AJAX -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.btn-delete-client').click(function(e) {
                e.preventDefault();
                
                var clientId = $(this).data('id_client');
                var token = $('meta[name="csrf-token"]').attr('content');
                
                if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
                    $.ajax({
                        url: '/client/' + clientId,
                        type: 'DELETE',
                        data: {"_token": token},
                        success: function(response) {
                            if (response.success) {
                                $('#client-row-' + clientId).remove();
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            alert('Erreur lors de la suppression.');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Masquer le message de succès après 3 secondes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endsection
```

**Explication ligne par ligne :**

1. **Ligne 1** : On étend le layout principal `app.blade.php`
2. **Ligne 3** : On définit le contenu de la section `content`
3. **Lignes 5-8** : Affichage conditionnel d'un message de succès (flashé depuis le contrôleur)
4. **Ligne 21** : Vérifier si la collection `$clients` est vide
5. **Ligne 37** : Boucle `@foreach` pour parcourir tous les clients
6. **Ligne 43** : `{{ $client->sigle_client ?? '-' }}` affiche le sigle OU '-' si null
7. **Ligne 45** : Accès à la relation `secteurActivite` (eager loading)
8. **Ligne 52** : Route nommée avec paramètre `id_client`
9. **Ligne 68** : JavaScript jQuery pour suppression AJAX sans recharger la page
10. **Ligne 75** : Récupération du CSRF token pour la requête AJAX DELETE

**Points clés de cet exemple :**

- ✅ Utilisation du layout (DRY = Don't Repeat Yourself)
- ✅ Affichage de messages flash (session)
- ✅ Boucle foreach pour afficher une liste
- ✅ Opérateur null-coalescing `??` pour valeurs par défaut
- ✅ Routes nommées avec `route()`
- ✅ JavaScript pour interactions (suppression AJAX)
- ✅ CSRF token pour sécurité

### 8.7 Les formulaires dans Blade

**Les formulaires sont PARTOUT dans l'application.**

Chaque fois que l'utilisateur doit entrer des données (créer un client, une facture, etc.), on utilise un formulaire.

#### 8.7.1 Structure de base d'un formulaire

```blade
<form action="{{ route('client.store') }}" method="POST">
    @csrf  <!-- OBLIGATOIRE : Token de sécurité Laravel -->
    
    <div class="input-style-1">
        <label for="nom_client">Nom du client :</label>
        <input type="text" id="nom_client" name="nom_client" required>
    </div>
    
    <button type="submit">Créer le client</button>
</form>
```

**Explication :**

1. **`action="{{ route('client.store') }}"`** : URL où envoyer les données (route Laravel)
2. **`method="POST"`** : Méthode HTTP (POST pour création, PUT pour modification)
3. **`@csrf`** : Directive Blade qui génère un token de sécurité (protection contre CSRF)
4. **`name="nom_client"`** : Le nom du champ (c'est ce que le contrôleur reçoit dans `$request`)
5. **`required`** : Validation HTML5 côté client

#### 8.7.2 Formulaire de modification (PUT/PATCH)

```blade
<form action="{{ route('client.update', $client->id_client) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Laravel va interpréter cette requête comme PUT -->
    
    <div class="input-style-1">
        <label for="nom_client">Nom du client :</label>
        <input type="text" 
               id="nom_client" 
               name="nom_client" 
               value="{{ old('nom_client', $client->nom_client) }}" 
               required>
    </div>
    
    <button type="submit">Mettre à jour</button>
</form>
```

**Points importants :**

- **`@method('PUT')`** : Indique à Laravel que c'est une requête PUT (modification)
- **`value="{{ old('nom_client', $client->nom_client) }}"`** :
  - `old('nom_client')` : Valeur précédemment saisie (si erreur de validation)
  - Si pas d'erreur, utilise `$client->nom_client` (valeur actuelle en BDD)

#### 8.7.3 Afficher les erreurs de validation

```blade
<!-- Afficher TOUTES les erreurs en haut du formulaire -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- OU afficher l'erreur spécifique à un champ -->
<div class="input-style-1">
    <label for="nom_client">Nom du client :</label>
    <input type="text" 
           id="nom_client" 
           name="nom_client" 
           class="@error('nom_client') is-invalid @enderror"
           value="{{ old('nom_client') }}">
    
    @error('nom_client')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
```

**Comment ça marche ?**

1. Le contrôleur valide les données avec `$request->validate([...])`
2. Si validation échoue, Laravel redirige AUTOMATIQUEMENT vers le formulaire
3. Les erreurs sont disponibles dans la variable `$errors`
4. `old('nom_client')` conserve la valeur saisie par l'utilisateur

#### 8.7.4 Select (liste déroulante) avec Select2

```blade
<div class="select-style-1">
    <label for="id_client">Sélectionner un client :</label>
    <select id="id_client" name="id_client" class="select2" required>
        <option value="">-- Choisir un client --</option>
        @foreach($clients as $client)
            <option value="{{ $client->id_client }}" 
                    {{ old('id_client') == $client->id_client ? 'selected' : '' }}>
                {{ $client->code_client }} - {{ $client->nom_client }}
            </option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Rechercher un client...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
```

**Select2 est une bibliothèque JavaScript qui améliore les `<select>` :**
- Barre de recherche dans la liste
- Meilleure UX (User Experience)
- Support de sélections multiples

#### 8.7.5 Exemple complet : Création d'une facture

Fichier : `resources/views/facture/insertFacture.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <!-- Afficher message de succès -->
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Titre -->
    <div class="title-wrapper pt-30">
        <h2>Facture de {{ $chantier->client->nom_client }} : {{ $chantier->client->code_client }}</h2>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('facture.store') }}" method="POST">
        @csrf
        
        <!-- Afficher les erreurs de validation -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Cartes récapitulatives -->
        <div class="row">
            <div class="col-xl-3">
                <div class="icon-card mb-30">
                    <h6 class="mb-10">Total Honoraire</h6>
                    <p class="text-bold text-success">
                        {{ number_format($totalHonoraire, 0, ',', ' ') }}
                        <span class="text-gray">{{ $chantier->monnaie->nom_monnaie }}</span>
                    </p>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="icon-card mb-30">
                    <h6 class="mb-10">Total Débours</h6>
                    <p id="total_debours" class="text-bold text-success">0</p>
                    <span class="text-gray">{{ $chantier->monnaie->nom_monnaie }}</span>
                </div>
            </div>
        </div>

        <!-- Formulaire de saisie -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card-style mb-30">
                    <!-- Champ caché pour l'ID du chantier -->
                    <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">

                    <!-- Référence chantier (lecture seule) -->
                    <div class="col-xxl-6">
                        <label>Référence chantier :</label>
                        <a class="main-btn deactive-btn">
                            {{ $getdates->reference_chantier }}
                        </a>
                    </div>

                    <!-- Débours décaissable -->
                    <div class="col-xxl-6">
                        <label for="debours_decaissable">Débours décaissable :</label>
                        <input type="number" 
                               id="debours_decaissable" 
                               name="debours_decaissable" 
                               oninput="calculateTotal()">
                        <span>{{ $chantier->monnaie->nom_monnaie }}</span>
                    </div>

                    <!-- Débours non décaissable -->
                    <div class="col-xxl-6">
                        <label for="debours_non_decaissable">Débours non décaissable :</label>
                        <input type="number" 
                               id="debours_non_decaissable" 
                               name="debours_non_decaissable" 
                               oninput="calculateTotal()">
                        <span>{{ $chantier->monnaie->nom_monnaie }}</span>
                    </div>

                    <!-- Nombre de tranches -->
                    <div class="col-xxl-4">
                        <label for="nb_tranche_facture">Nombre de tranches :</label>
                        <input type="number" 
                               id="nb_tranche_facture" 
                               name="nb_tranche_facture" 
                               required>
                    </div>

                    <!-- Boutons de navigation -->
                    <div class="col-12">
                        @if($budgets->count() > 0)
                            <a href="{{ route('budget.modifier', ['id_chantier' => $chantier->id_chantier]) }}" 
                               class="main-btn primary-btn">
                                Précédent
                            </a>
                        @endif

                        <button style="float:inline-end;" 
                                class="main-btn primary-btn" 
                                type="submit">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- JavaScript pour calcul automatique -->
    <script>
        function calculateTotal() {
            var deboursDecaissable = parseFloat(document.getElementById('debours_decaissable').value) || 0;
            var deboursNonDecaissable = parseFloat(document.getElementById('debours_non_decaissable').value) || 0;
            var total = deboursDecaissable + deboursNonDecaissable;
            
            document.getElementById('total_debours').textContent = 
                total.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }
    </script>
@endsection
```

**Points clés de cet exemple :**

1. **Ligne 13** : Affichage des relations `$chantier->client->nom_client` (eager loading)
2. **Ligne 36** : `number_format()` pour formater les nombres (espaces comme séparateurs de milliers)
3. **Ligne 56** : `<input type="hidden">` pour envoyer des données non visibles
4. **Ligne 68** : `oninput="calculateTotal()"` appelle la fonction JS à chaque saisie
5. **Ligne 107** : JavaScript vanilla pour calcul en temps réel
6. **Ligne 110** : `toLocaleString('fr-FR')` pour format français (espace pour milliers)

### 8.8 JavaScript dans les vues

**Le projet utilise beaucoup de JavaScript pour améliorer l'expérience utilisateur.**

#### 8.8.1 Calculs automatiques en temps réel

**Exemple : Calcul des tranches de facture**

```javascript
function calculateTauxEtMontants(index) {
    const totalTranches = {{ $facture->nb_tranche_facture }};
    let totalTauxHonoraire = 0;
    let totalTauxDebours = 0;
    const totalHonoraire = @json($totalHonoraire);  // ← Passer données PHP vers JS
    const totalDebours = @json($totalDebours);

    // Parcourir toutes les tranches SAUF la dernière
    for (let i = 0; i < totalTranches - 1; i++) {
        const tauxHonoraire = parseFloat(document.getElementById(`taux_honoraire_${i}`).value) || 0;
        const tauxDebours = parseFloat(document.getElementById(`taux_debours_${i}`).value) || 0;

        totalTauxHonoraire += tauxHonoraire;
        totalTauxDebours += tauxDebours;

        // Calculer le montant
        const montantHonoraire = ((totalHonoraire * tauxHonoraire) / 100).toFixed(0);
        const montantDebours = ((totalDebours * tauxDebours) / 100).toFixed(0);

        // Mettre à jour les champs
        document.getElementById(`montant_honoraire_${i}`).value = montantHonoraire;
        document.getElementById(`montant_debours_${i}`).value = montantDebours;
    }

    // Calcul automatique de la dernière tranche (pour arriver à 100%)
    const tauxHonoraireFinal = 100 - totalTauxHonoraire;
    const tauxDeboursFinal = 100 - totalTauxDebours;

    document.getElementById(`taux_honoraire_${totalTranches - 1}`).value = tauxHonoraireFinal.toFixed(2);
    document.getElementById(`taux_debours_${totalTranches - 1}`).value = tauxDeboursFinal.toFixed(2);
}
```

**Points importants :**

- **`@json($totalHonoraire)`** : Convertit une variable PHP en JSON pour JavaScript
- **`parseFloat()`** : Convertit une chaîne en nombre décimal
- **`|| 0`** : Si la valeur est vide/undefined, utilise 0
- **`.toFixed(0)`** : Arrondir à 0 décimales
- **Template literals** : `taux_honoraire_${i}` pour générer des IDs dynamiques

#### 8.8.2 Validation côté client

```javascript
// Validation avant soumission du formulaire
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        let hasError = false;

        // Vérifier que tous les taux sont entre 0 et 100
        for (let i = 0; i < totalTranches; i++) {
            const tauxHonoraire = parseFloat(document.getElementById(`taux_honoraire_${i}`).value) || 0;
            const tauxDebours = parseFloat(document.getElementById(`taux_debours_${i}`).value) || 0;

            if (tauxHonoraire < 0 || tauxHonoraire > 100) {
                hasError = true;
                alert(`Le taux honoraire de la tranche ${i + 1} doit être entre 0 et 100%`);
                break;
            }

            if (tauxDebours < 0 || tauxDebours > 100) {
                hasError = true;
                alert(`Le taux débours de la tranche ${i + 1} doit être entre 0 et 100%`);
                break;
            }
        }

        // Si erreur, empêcher la soumission
        if (hasError) {
            e.preventDefault();
        }
    });
});
```

**Explication :**

1. **`DOMContentLoaded`** : Attend que la page soit complètement chargée
2. **`querySelector('form')`** : Sélectionne le premier formulaire de la page
3. **`addEventListener('submit')`** : Écoute l'événement de soumission
4. **`e.preventDefault()`** : Empêche la soumission si erreur détectée

#### 8.8.3 Suppression AJAX (sans recharger la page)

```javascript
$(document).ready(function() {
    $('.btn-delete-client').click(function(e) {
        e.preventDefault();  // Empêcher le comportement par défaut du lien

        var clientId = $(this).data('id_client');  // Récupérer l'ID du client
        var token = $('meta[name="csrf-token"]').attr('content');  // CSRF token

        // Demander confirmation
        if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
            $.ajax({
                url: '/client/' + clientId,  // URL de la route DELETE
                type: 'DELETE',
                data: {"_token": token},  // Envoyer le CSRF token
                success: function(response) {
                    if (response.success) {
                        // Supprimer la ligne du tableau sans recharger
                        $('#client-row-' + clientId).remove();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Erreur lors de la suppression. Veuillez réessayer.');
                }
            });
        }
    });
});
```

**Avantages de l'AJAX :**
- ✅ Pas de rechargement de page (meilleure UX)
- ✅ Plus rapide
- ✅ Peut afficher des messages personnalisés
- ✅ Peut mettre à jour plusieurs éléments en même temps

#### 8.8.4 Select2 pour les listes déroulantes

```javascript
$(document).ready(function() {
    // Initialiser Select2 sur tous les éléments avec la classe .select2
    $('.select2').select2({
        placeholder: "Rechercher...",
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Aucun résultat trouvé";
            },
            searching: function() {
                return "Recherche en cours...";
            }
        }
    });

    // Réinitialiser le select quand on efface
    $('.select2').on('select2:clear', function() {
        $(this).val(null).trigger('change');
    });
});
```

### 8.9 Les vues spécifiques consultants

**L'application a deux types d'utilisateurs : Admin et Consultant.**

Les consultants ont des vues SÉPARÉES avec des restrictions :

```
resources/views/consultant/
├── dashboardConsultant.blade.php    # Dashboard limité
├── clientsConsultant.blade.php      # Liste clients (lecture seule)
├── chantiersConsultant.blade.php    # Liste chantiers (lecture seule)
└── facturesConsultant.blade.php     # Liste factures (sans modification)
```

**Différences clés :**

1. **Navbar et sidebar différents** :
   - `layouts/navbarConsultant.blade.php`
   - `layouts/sidebarConsultant.blade.php`

2. **Pas de boutons de modification/suppression** :

```blade
<!-- Vue ADMIN -->
<a href="{{ route('client.modifier', $client->id_client) }}">Modifier</a>
<a href="{{ route('client.supprimer', $client->id_client) }}">Supprimer</a>

<!-- Vue CONSULTANT (boutons masqués) -->
<!-- Pas de boutons de modification -->
```

3. **Menu restreint** :
   - ❌ Pas d'accès aux paramètres
   - ❌ Pas d'accès aux imports
   - ❌ Pas d'accès à la gestion du personnel
   - ✅ Accès en lecture aux clients/chantiers/factures
   - ✅ Accès au dashboard (données limitées)

### 8.10 Bonnes pratiques pour les vues

#### ✅ À FAIRE

1. **Toujours étendre le layout principal**
   ```blade
   @extends('layouts.app')
   ```

2. **Utiliser les routes nommées**
   ```blade
   <a href="{{ route('client.show', $client->id_client) }}">Voir</a>
   ```

3. **Échapper les données utilisateur avec `{{ }}`**
   ```blade
   <p>{{ $client->nom_client }}</p>
   ```

4. **Vérifier les valeurs nullables avec `??`**
   ```blade
   <p>{{ $client->sigle ?? 'N/A' }}</p>
   ```

5. **Afficher les erreurs de validation**
   ```blade
   @error('nom_client')
       <span class="error">{{ $message }}</span>
   @enderror
   ```

6. **Utiliser `old()` dans les formulaires**
   ```blade
   <input type="text" name="nom" value="{{ old('nom', $client->nom) }}">
   ```

7. **Commenter les sections complexes**
   ```blade
   {{-- Ce bloc gère l'affichage conditionnel du statut de paiement --}}
   ```

#### ❌ À NE PAS FAIRE

1. **Ne PAS mettre de logique métier dans les vues**
   ```blade
   <!-- MAUVAIS -->
   @php
       $total = 0;
       foreach ($factures as $facture) {
           $total += $facture->montant;
       }
   @endphp
   
   <!-- BON : Faire le calcul dans le contrôleur et passer $total -->
   ```

2. **Ne PAS faire de requêtes SQL dans les vues**
   ```blade
   <!-- MAUVAIS -->
   @php
       $clients = DB::table('clients')->get();
   @endphp
   
   <!-- BON : Faire la requête dans le contrôleur -->
   ```

3. **Ne PAS utiliser `{!! !!}` sans raison**
   ```blade
   <!-- DANGEREUX -->
   {!! $userInput !!}
   
   <!-- SÉCURISÉ -->
   {{ $userInput }}
   ```

4. **Ne PAS répéter du code HTML**
   ```blade
   <!-- MAUVAIS : Code dupliqué -->
   <div class="card">...</div>
   <div class="card">...</div>
   
   <!-- BON : Créer un composant réutilisable -->
   @include('components.card', ['data' => $data])
   ```

### 8.11 Commandes utiles pour les vues

```bash
# Vider le cache des vues compilées
php artisan view:clear

# Lister toutes les vues (pas de commande native, mais vous pouvez faire)
find resources/views -name "*.blade.php"

# Compter le nombre de vues
find resources/views -name "*.blade.php" | wc -l
```

### 8.12 Résumé de la section Vues

**Ce qu'il faut retenir :**

1. **Les vues sont dans `resources/views/`** et se terminent par `.blade.php`
2. **Blade est le moteur de template de Laravel** avec une syntaxe simple
3. **Le layout principal est `layouts/app.blade.php`** utilisé par toutes les pages
4. **Les directives Blade commencent par `@`** : `@if`, `@foreach`, `@extends`, etc.
5. **`{{ $var }}` affiche des données de façon SÉCURISÉE** (échappe le HTML)
6. **Les formulaires doivent avoir `@csrf`** pour la sécurité
7. **JavaScript améliore l'UX** : calculs automatiques, AJAX, Select2, etc.
8. **Les consultants ont des vues séparées** avec des restrictions
9. **Toujours valider les données** côté serveur (contrôleur) ET côté client (JavaScript)
10. **Ne JAMAIS mettre de logique métier dans les vues** (responsabilité du contrôleur)

**Workflow typique d'une vue :**

```
1. L'utilisateur clique sur un lien (/clients)
   ↓
2. Laravel trouve la route correspondante (routes/web.php)
   ↓
3. La route appelle le contrôleur (ClientController@index)
   ↓
4. Le contrôleur récupère les données (Client::all())
   ↓
5. Le contrôleur passe les données à la vue (return view('client.listClients', ['clients' => $clients]))
   ↓
6. Blade compile la vue (remplace @foreach, {{ }}, etc.)
   ↓
7. Le HTML final est envoyé au navigateur
   ↓
8. L'utilisateur voit la page
```

**Dans la prochaine section, nous verrons les FONCTIONNALITÉS IMPORTANTES du projet (workflow complet, imports Excel, rapports, etc.).**


---

## 9. FONCTIONNALITÉS IMPORTANTES DU PROJET

Cette section explique les fonctionnalités clés qui rendent cette application puissante et complexe.

### 9.1 Le workflow complet : de la création du client à l'encaissement

**C'est LA fonctionnalité centrale de l'application.**

L'application guide l'utilisateur à travers un processus en **8 étapes obligatoires** pour créer une facture et enregistrer un encaissement.

#### 9.1.1 Vue d'ensemble du processus

```
ÉTAPE 1 : Client
    ↓
ÉTAPE 2 : Chantier (projet/mission)
    ↓
ÉTAPE 3 : Dates du chantier (GetDate)
    ↓
ÉTAPE 4 : Équipe affectée
    ↓
ÉTAPE 5 : Budget (honoraires calculés)
    ↓
ÉTAPE 6 : Facture (débours)
    ↓
ÉTAPE 7 : Tranches de facture (répartition du paiement)
    ↓
ÉTAPE 8 : Choix de la banque
    ↓
RÉSULTAT : Facture PDF générée
    ↓
ÉTAPE FINALE : Encaissement (enregistrement des paiements reçus)
```

**Caractéristiques importantes :**

1. **Processus linéaire obligatoire** : On ne peut pas créer une facture sans avoir créé le client, le chantier, etc.
2. **Validation à chaque étape** : Si les données sont invalides, on ne peut pas passer à l'étape suivante
3. **Boutons "Précédent" et "Suivant"** : Navigation entre les étapes
4. **Avertissement avant de quitter** : Un script JavaScript empêche de quitter accidentellement le processus

#### 9.1.2 Détail de chaque étape

**ÉTAPE 1 : Créer le client**

Route : `/client/create` (GET) → `/client` (POST)  
Contrôleur : `ClientController@create` et `ClientController@store`  
Vue : `resources/views/client/insertClient.blade.php`

**Données requises :**
- Code client (unique)
- Nom du client
- Secteur d'activité (relation avec `secteur_activite`)
- Pays (relation avec `pays`)
- Zone géographique (optionnel)
- Adresse, contact, email, etc.

**Code du contrôleur (création) :**

```php
public function store(Request $request)
{
    // 1. Valider les données
    $validated = $request->validate([
        'code_client' => 'required|unique:client,code_client',
        'nom_client' => 'required',
        'id_pays' => 'required|exists:pays,id_pays',
        'id_secteur_activite' => 'required|exists:secteur_activite,id_secteur_activite',
        // ... autres champs
    ]);

    // 2. Créer le client
    $client = Client::create($validated);

    // 3. Rediriger vers la liste des clients
    return redirect()->route('listClients')->with('success', 'Client créé avec succès');
}
```

**Après création :** L'utilisateur peut maintenant créer un chantier pour ce client.

---

**ÉTAPE 2 : Créer le chantier**

Route : `/chantier/create/{id_client}` (GET) → `/chantier` (POST)  
Contrôleur : `ChantierController@create` et `ChantierController@store`  
Vue : `resources/views/chantier/insertChantier.blade.php`

**Données requises :**
- ID du client (passé en paramètre)
- Type de mission (relation avec `type_mission`)
- Sous-type de mission (relation avec `sous_type_mission`)
- Monnaie (relation avec `monnaie`)
- Statut initial : `statut_completion = 'en_cours'`, `etat = false`

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_client' => 'required|exists:client,id_client',
        'id_type_mission' => 'required|exists:type_mission,id_type_mission',
        'id_sous_type_mission' => 'required|exists:sous_type_mission,id_sous_type_mission',
        'id_monnaie' => 'required|exists:monnaie,id_monnaie',
    ]);

    // Créer le chantier avec des valeurs par défaut
    $chantier = Chantier::create([
        'id_client' => $validated['id_client'],
        'id_type_mission' => $validated['id_type_mission'],
        'id_sous_type_mission' => $validated['id_sous_type_mission'],
        'id_monnaie' => $validated['id_monnaie'],
        'statut_completion' => 'en_cours',  // En cours par défaut
        'etat' => false,                     // Non terminé
    ]);

    // Rediriger vers l'étape suivante (dates)
    return redirect()->route('getdate.create', ['id_chantier' => $chantier->id_chantier]);
}
```

**Point clé :** La redirection emmène directement à l'étape suivante (`getdate.create`).

---

**ÉTAPE 3 : Définir les dates du chantier (GetDate)**

Route : `/getdate/create/{id_chantier}` (GET) → `/getdate` (POST)  
Contrôleur : `GetDateController@create` et `GetDateController@store`  
Vue : `resources/views/getdate/insertDate.blade.php`

**Données requises :**
- ID du chantier (passé en paramètre)
- Date d'initialisation
- Date de fin prévisionnelle
- Référence du chantier (code unique pour identifier le chantier)

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_chantier' => 'required|exists:chantier,id_chantier',
        'date_initialisation' => 'required|date',
        'date_fin_prevision' => 'required|date|after:date_initialisation',
        'reference_chantier' => 'required|unique:get_date,reference_chantier',
    ]);

    GetDate::create($validated);

    // Rediriger vers l'étape suivante (équipe)
    return redirect()->route('equipe.create', ['id_chantier' => $request->id_chantier]);
}
```

---

**ÉTAPE 4 : Affecter une équipe**

Route : `/equipe/create/{id_chantier}` (GET) → `/equipe` (POST)  
Contrôleur : `EquipeController@create` et `EquipeController@store`  
Vue : `resources/views/equipe/insertEquipe.blade.php`

**Données requises :**
- ID du chantier
- Liste du personnel (relation avec `liste_personnel`)
- Grade du personnel (relation avec `grade`)

**Particularité :** On peut affecter plusieurs personnes à un chantier (création en boucle).

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_chantier' => 'required|exists:chantier,id_chantier',
        'equipes' => 'required|array',  // Tableau d'équipes
        'equipes.*.id_liste_personnel' => 'required|exists:liste_personnel,id_liste_personnel',
        'equipes.*.id_grade' => 'required|exists:grade,id_grade',
    ]);

    // Créer chaque membre de l'équipe
    foreach ($validated['equipes'] as $equipe) {
        Equipe::create([
            'id_chantier' => $validated['id_chantier'],
            'id_liste_personnel' => $equipe['id_liste_personnel'],
            'id_grade' => $equipe['id_grade'],
        ]);
    }

    // Rediriger vers l'étape suivante (budget)
    return redirect()->route('budget.create', ['id_chantier' => $request->id_chantier]);
}
```

---

**ÉTAPE 5 : Créer le budget**

Route : `/budget/create/{id_chantier}` (GET) → `/budget` (POST)  
Contrôleur : `BudgetController@create` et `BudgetController@store`  
Vue : `resources/views/budget/insertBudget.blade.php`

**Données requises :**
- ID du chantier
- Pour chaque équipe :
  - Nombre de jours-homme
  - Taux journalier

**Calcul automatique :** Total honoraire = Nombre jours × Taux

**Code du contrôleur :**

```php
public function store(Request $request)
{
    DB::transaction(function () use ($request) {
        $id_chantier = $request->id_chantier;
        
        // Récupérer toutes les équipes du chantier
        $equipes = Equipe::where('id_chantier', $id_chantier)->get();

        $totalJourHomme = 0;
        $totalGlobal = 0;

        foreach ($equipes as $equipe) {
            $nb_jour = $request->input('nb_jour_homme_' . $equipe->id_equipe);
            $taux = $request->input('taux_' . $equipe->id_equipe);

            // Calculer le montant
            $montant = $nb_jour * $taux;

            // Créer le budget
            Budget::create([
                'id_equipe' => $equipe->id_equipe,
                'id_chantier' => $id_chantier,
                'nb_jour_homme' => $nb_jour,
                'taux' => $taux,
            ]);

            $totalJourHomme += $nb_jour;
            $totalGlobal += $montant;
        }

        // Enregistrer les totaux dans la table total_budget
        TotalBudget::create([
            'id_chantier' => $id_chantier,
            'total_jour_homme' => $totalJourHomme,
            'total_global' => $totalGlobal,
        ]);
    });

    // Rediriger vers l'étape suivante (facture)
    return redirect()->route('facture.create', ['id_chantier' => $request->id_chantier]);
}
```

**Points importants :**
1. Utilise une **transaction** pour garantir la cohérence
2. Calcule automatiquement les **totaux**
3. Enregistre les totaux dans une table séparée (`total_budget`)

---

**ÉTAPE 6 : Créer la facture**

Route : `/facture/create/{id_chantier}` (GET) → `/facture` (POST)  
Contrôleur : `FactureController@create` et `FactureController@store`  
Vue : `resources/views/facture/insertFacture.blade.php`

**Données requises :**
- ID du chantier
- Débours décaissable (frais remboursables)
- Débours non décaissable (frais non remboursables)
- Nombre de tranches (ex: 3 pour paiement en 3 fois)

**Calcul automatique dans la vue :** Total débours = Décaissable + Non décaissable

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_chantier' => 'required|exists:chantier,id_chantier',
        'debours_decaissable' => 'required|numeric|min:0',
        'debours_non_decaissable' => 'required|numeric|min:0',
        'nb_tranche_facture' => 'required|integer|min:1',
    ]);

    // Créer la facture
    $facture = Facture::create([
        'id_chantier' => $validated['id_chantier'],
        'debours_decaissable' => $validated['debours_decaissable'],
        'debours_non_decaissable' => $validated['debours_non_decaissable'],
        'nb_tranche_facture' => $validated['nb_tranche_facture'],
        'etat' => 0,  // 0 = non payé par défaut
    ]);

    // Créer la relation avec les budgets (table pivot facture_budget)
    $budgets = Budget::where('id_chantier', $validated['id_chantier'])->pluck('id_budget');
    $facture->budgets()->attach($budgets);

    // Rediriger vers l'étape suivante (tranches)
    return redirect()->route('tranche.create', ['id_facture' => $facture->id_facture]);
}
```

---

**ÉTAPE 7 : Créer les tranches de facture**

Route : `/tranche/create/{id_facture}` (GET) → `/tranche` (POST)  
Contrôleur : `TrancheFactureController@create` et `TrancheFactureController@store`  
Vue : `resources/views/tranche_facture/insertTrancheFacture.blade.php`

**C'est la partie LA PLUS COMPLEXE du processus.**

**Données requises (pour chaque tranche) :**
- Taux honoraire (% du total honoraire)
- Taux débours (% du total débours)
- Date de prévision facture
- Date de prévision recouvrement

**Contrainte CRITIQUE :**
- La somme de tous les `taux_honoraire` doit être **EXACTEMENT 100%**
- La somme de tous les `taux_debours` doit être **EXACTEMENT 100%**

**Exemple :** Facture avec 3 tranches

```
Tranche 1 : 30% honoraire, 30% débours
Tranche 2 : 30% honoraire, 30% débours
Tranche 3 : 40% honoraire, 40% débours
            ----           ----
TOTAL     : 100%           100%  ✅ VALIDE
```

**Code du contrôleur avec validation :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_facture' => 'required|exists:facture,id_facture',
        'tranches' => 'required|array',
        'tranches.*.taux_honoraire' => 'required|numeric|min:0|max:100',
        'tranches.*.taux_debours' => 'required|numeric|min:0|max:100',
        'tranches.*.date_prevision_facture' => 'required|date',
        'tranches.*.date_prevision_recouvrement' => 'required|date',
    ]);

    // VALIDATION CRITIQUE : Vérifier que les taux = 100%
    $totalTauxHonoraire = 0;
    $totalTauxDebours = 0;

    foreach ($validated['tranches'] as $tranche) {
        $totalTauxHonoraire += $tranche['taux_honoraire'];
        $totalTauxDebours += $tranche['taux_debours'];
    }

    // Si les totaux ne sont pas 100%, renvoyer une erreur
    if ($totalTauxHonoraire != 100) {
        return back()->withErrors([
            'error' => 'Le total des taux honoraires doit être exactement 100%. Actuellement : ' . $totalTauxHonoraire . '%'
        ])->withInput();
    }

    if ($totalTauxDebours != 100) {
        return back()->withErrors([
            'error' => 'Le total des taux débours doit être exactement 100%. Actuellement : ' . $totalTauxDebours . '%'
        ])->withInput();
    }

    // Récupérer la facture et les totaux
    $facture = Facture::with('chantier')->findOrFail($validated['id_facture']);
    $totalHonoraire = BudgetController::getTotalGlobalHonoraire($facture->id_chantier);
    $totalDebours = FactureController::getTotalGlobalDebours($facture->id_chantier);

    // Créer les tranches
    foreach ($validated['tranches'] as $index => $trancheData) {
        TrancheFacture::create([
            'id_facture' => $validated['id_facture'],
            'nom_tranche' => 'Tranche ' . ($index + 1),
            'taux_honoraire' => $trancheData['taux_honoraire'],
            'taux_debours' => $trancheData['taux_debours'],
            'montant_honoraire' => ($totalHonoraire * $trancheData['taux_honoraire']) / 100,
            'montant_debours' => ($totalDebours * $trancheData['taux_debours']) / 100,
            'date_prevision_facture' => $trancheData['date_prevision_facture'],
            'date_prevision_recouvrement' => $trancheData['date_prevision_recouvrement'],
            'etat' => false,  // Non payée par défaut
        ]);
    }

    // Rediriger vers l'étape suivante (choix banque)
    return redirect()->route('choix.create', ['id_facture' => $facture->id_facture]);
}
```

**JavaScript dans la vue pour calcul automatique :**

La vue contient un script JavaScript qui :
1. Calcule automatiquement la **dernière tranche** pour arriver à 100%
2. Calcule les montants en temps réel
3. Affiche des messages d'erreur si les taux dépassent 100%
4. Bloque le bouton "Suivant" si erreur

---

**ÉTAPE 8 : Choix de la banque**

Route : `/choix/create/{id_facture}` (GET) → `/choix` (POST)  
Contrôleur : `ChoixBanqueController@create` et `ChoixBanqueController@store`  
Vue : `resources/views/choix_banque/insertChoixBanque.blade.php`

**Données requises :**
- ID de la facture
- Banque choisie (relation avec `banque`)
- Société émettrice (relation avec `societes`)

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_facture' => 'required|exists:facture,id_facture',
        'id_banque' => 'required|exists:banque,id_banque',
        'id_societe' => 'required|exists:societes,id_societe',
    ]);

    ChoixBanque::create($validated);

    // Rediriger vers la génération de la facture PDF
    return redirect()->route('facture.pdf', ['id_facture' => $validated['id_facture']]);
}
```

**Après cette étape :** Une facture PDF est générée et peut être téléchargée.

---

**ÉTAPE FINALE : Encaisser les paiements**

Route : `/encaissement/create/{id_tranche}` (GET) → `/encaissement` (POST)  
Contrôleur : `EncaissementController@create` et `EncaissementController@store`  
Vue : `resources/views/encaissement/insertEncaissement.blade.php`

**Données requises :**
- ID de la tranche
- Montant encaissé
- Date d'encaissement
- Moyen de paiement (chèque, virement, espèces, etc.)
- Référence (numéro de chèque, référence virement, etc.)

**Code du contrôleur :**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'id_tranche' => 'required|exists:tranche_facture,id_tranche',
        'montant_encaissement' => 'required|numeric|min:0',
        'date_encaissement' => 'required|date',
        'moyen_paiement' => 'required|in:chèque,virement,espèces,carte',
        'reference_paiement' => 'nullable|string',
    ]);

    // Créer l'encaissement
    Encaissement::create($validated);

    // Récupérer la tranche pour mettre à jour son état
    $tranche = TrancheFacture::findOrFail($validated['id_tranche']);

    // Vérifier si la tranche est totalement payée
    $totalEncaisse = Encaissement::where('id_tranche', $tranche->id_tranche)
                                  ->sum('montant_encaissement');
    $montantTotal = $tranche->montant_honoraire + $tranche->montant_debours;

    if ($totalEncaisse >= $montantTotal) {
        $tranche->etat = true;  // Tranche totalement payée
        $tranche->save();

        // Mettre à jour l'état de la facture parent
        $facture = $tranche->facture;
        $facture->updateFactureStatus();
    }

    return redirect()->route('tranche.index')->with('success', 'Encaissement enregistré');
}
```

**Point TRÈS important :** Après chaque encaissement, on vérifie si la tranche est totalement payée, ce qui déclenche la mise à jour en cascade du statut de la facture et du chantier.

---

### 9.2 La méthode magique : `updateFactureStatus()`

**C'est la méthode LA PLUS IMPORTANTE du projet.**

Elle se trouve dans le modèle `Facture` et est responsable de **la mise à jour en cascade des statuts**.

**Localisation :** `app/Models/Facture.php`

**Code complet avec explications :**

```php
/**
 * Met à jour le statut de la facture en fonction de l'état des tranches
 * ET met à jour le statut du chantier parent si toutes les factures sont payées
 */
public function updateFactureStatus()
{
    // 1. Récupérer toutes les tranches de cette facture
    $tranches = $this->tranches;
    
    // 2. Si aucune tranche n'existe, la facture est non payée
    if ($tranches->isEmpty()) {
        $this->etat = 0;  // Non payé
        $this->save();
        return;
    }
    
    // 3. Compter le nombre total de tranches et le nombre de tranches payées
    $totalTranches = $tranches->count();
    $tranchesPayees = $tranches->where('etat', true)->count();
    
    // 4. Déterminer l'état de la facture
    if ($tranchesPayees == 0) {
        // Aucune tranche payée
        $this->etat = 0;  // Non payé
    } 
    elseif ($tranchesPayees == $totalTranches) {
        // TOUTES les tranches sont payées
        $this->etat = 2;  // Totalement payé
        
        // 5. CASCADE : Vérifier si TOUTES les factures du chantier sont payées
        $chantier = $this->chantier;
        $toutesFacturesPayees = $chantier->factures->every(function($facture) {
            return $facture->etat == 2;
        });
        
        // 6. Si toutes les factures du chantier sont payées, marquer le chantier comme complet
        if ($toutesFacturesPayees) {
            $chantier->statut_completion = 'complet';
            $chantier->etat = true;  // Chantier terminé
            $chantier->save();
        }
    } 
    else {
        // Certaines tranches payées, mais pas toutes
        $this->etat = 1;  // Partiellement payé
    }
    
    // 7. Sauvegarder l'état de la facture
    $this->save();
}
```

**Workflow de la cascade :**

```
Encaissement créé
    ↓
Tranche marquée comme payée (etat = true)
    ↓
updateFactureStatus() appelé
    ↓
Vérification de TOUTES les tranches de la facture
    ↓
Si toutes payées : Facture.etat = 2
    ↓
Vérification de TOUTES les factures du chantier
    ↓
Si toutes payées : Chantier.statut_completion = 'complet'
                   Chantier.etat = true
```

**États possibles d'une facture :**

- **`etat = 0`** : Aucune tranche payée (rouge)
- **`etat = 1`** : Partiellement payée (orange)
- **`etat = 2`** : Totalement payée (vert)

**États possibles d'un chantier :**

- **`statut_completion = 'en_cours'`** : Chantier en cours
- **`statut_completion = 'complet'`** : Chantier terminé (toutes factures payées)
- **`etat = false`** : Chantier actif
- **`etat = true`** : Chantier clôturé

---

### 9.3 Les imports Excel

**L'application permet d'importer des données en masse depuis des fichiers Excel.**

**Bibliothèque utilisée :** `maatwebsite/excel`

**Localisation des classes d'import :** `app/Imports/`

#### 9.3.1 Import de clients

**Classe :** `ClientImport.php`

**Format Excel attendu :**

- **code_client** : CLI001 - nom_client : Entreprise X - sigle_client : EX - type : Public - adresse_client : 123 Rue A - id_pays : 1 - id_secteur_activite : 2
- **code_client** : CLI002 - nom_client : Entreprise Y - sigle_client : EY - type : Privé - adresse_client : 456 Rue B - id_pays : 2 - id_secteur_activite : 3


**Route :** `/import/client`  
**Contrôleur :** `ImportController@importClient`

**Utilisation :**

```php
use App\Imports\ClientImport;
use Maatwebsite\Excel\Facades\Excel;

public function importClient(Request $request)
{
    $file = $request->file('excel_file');
    
    Excel::import(new ClientImport, $file);
    
    return redirect()->back()->with('success', 'Import réussi');
}
```

#### 9.3.2 Import de chantiers

**Classe :** `ChantierImport.php`

**Format Excel attendu :**

- **id_client** : 1 - id_type_mission : 2 - id_sous_type_mission : 5 - id_monnaie : 1
- **id_client** : 2 - id_type_mission : 3 - id_sous_type_mission : 7 - id_monnaie : 2


#### 9.3.3 Import de budgets et factures

**Classe :** `BudgetFactureImport.php`

**PARTICULARITÉ :** Cet import travaille sur **deux feuilles Excel** en même temps.

**Feuille 1 : Budget**

- **code_chantier** : CH001 - nb_jour_homme : 10 - taux : 500
- **code_chantier** : CH002 - nb_jour_homme : 15 - taux : 600


**Feuille 2 : Facture**

- **code_chantier** : CH001 - numero_facture : F001-n°ABC - debours_decaissable : 1000 - debours_non_decaissable : 500 - taux_honoraire : 100 - montant_honoraire : 5000 - taux_debours : 100 - montant_debours : 1500


**Code de l'import (extrait) :**

```php
public function collection(Collection $rows)
{
    DB::transaction(function () use ($rows) {
        $budgetRows = $rows[0];  // Première feuille : Budget
        $factureRows = $rows[1]; // Deuxième feuille : Facture

        // Étape 1 : Insérer les budgets
        foreach ($budgetRows as $budget) {
            $idChantier = $this->getIdChantier($budget['code_chantier']);
            
            // Créer l'équipe
            $equipe = Equipe::create([
                'id_chantier' => $idChantier,
                'id_liste_personnel' => $this->getPersonnel($budget['trigramme']),
                'id_grade' => 1,
            ]);

            // Créer le budget
            Budget::create([
                'id_equipe' => $equipe->id_equipe,
                'nb_jour_homme' => $budget['nb_jour_homme'],
                'taux' => $budget['taux'],
                'id_chantier' => $idChantier,
            ]);
        }

        // Étape 2 : Insérer les factures et tranches
        foreach ($factureRows as $facture) {
            $idChantier = $this->getIdChantier($facture['code_chantier']);
            
            // Créer la facture
            $factureModel = Facture::create([
                'id_chantier' => $idChantier,
                'debours_decaissable' => $facture['debours_decaissable'],
                'debours_non_decaissable' => $facture['debours_non_decaissable'],
                'nb_tranche_facture' => 1,
                'etat' => 0,
            ]);

            // Créer la tranche
            TrancheFacture::create([
                'id_facture' => $factureModel->id_facture,
                'taux_honoraire' => $facture['taux_honoraire'],
                'montant_honoraire' => $facture['montant_honoraire'],
                'taux_debours' => $facture['taux_debours'],
                'montant_debours' => $facture['montant_debours'],
                'date_prevision_facture' => $facture['date_prevision_facture'],
                'nom_tranche' => 'Tranche 1',
                'etat' => false,
            ]);
        }
    });
}
```

**Points importants :**

1. **Transaction DB** : Tout est annulé si une erreur survient
2. **Extraction de trigramme** : Utilise une regex pour extraire le code personnel
3. **Création automatique** : Crée automatiquement les équipes manquantes

---

### 9.4 Le Dashboard et les statistiques

**Le dashboard affiche une vue d'ensemble de l'activité.**

**Route :** `/dashboard`  
**Contrôleur :** `DashboardController@chartSuivi`  
**Vue :** `resources/views/dashboard.blade.php`

#### 9.4.1 Statistiques affichées

**1. Nombre de clients**
```php
$clientCount = Client::count();
```

**2. Nombre de chantiers en cours**
```php
$chantierCount = Chantier::where('etat', false)->count();
```

**3. Total jours-homme**
```php
$totalAllJourHomme = DB::table('total_budget')->sum('total_jour_homme');
```

**4. Nombre de factures**
```php
$facCount = Facture::count();
```

**5. Chantiers incomplets (en cours)**
```php
$chantiersIncomplets = Chantier::where('statut_completion', 'en_cours')
                                ->with(['client', 'typeMission'])
                                ->orderBy('updated_at', 'desc')
                                ->take(10)
                                ->get();
```

#### 9.4.2 Graphiques

**Le dashboard utilise Chart.js pour afficher des graphiques.**

**Graphique 1 : Chantiers par mois**

```php
$chantiersParMois = DB::table('get_date')
    ->select(
        DB::raw("to_char(date_initialisation, 'YYYY-MM') as mois"), 
        DB::raw('count(id_chantier) as nombre_chantiers')
    )
    ->whereYear('date_initialisation', $selectedYear)
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();
```

**Graphique 2 : Factures par état**

```php
$factures = DB::table('tranche_facture')
    ->join('facture', 'tranche_facture.id_facture', '=', 'facture.id_facture')
    ->select(
        DB::raw('COUNT(CASE WHEN facture.etat = 2 THEN 1 END) as payees'),
        DB::raw('COUNT(CASE WHEN facture.etat = 0 THEN 1 END) as non_payees'),
        DB::raw('COUNT(CASE WHEN facture.etat = 1 THEN 1 END) as partiellement_payees')
    )
    ->whereYear('tranche_facture.date_prevision_facture', $selectedYear)
    ->first();
```

**Graphique 3 : Budgets par mois (deux courbes)**

```php
// Courbe 1 : Total global
$budgetsGlobal = DB::table('total_budget')
    ->select(
        DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
        DB::raw('SUM(total_global) as total_budget')
    )
    ->whereYear('created_at', $selectedYear)
    ->groupBy('mois')
    ->get();

// Courbe 2 : Total jours-homme
$budgetsJourHomme = DB::table('total_budget')
    ->select(
        DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
        DB::raw('SUM(total_jour_homme) as total_jour_homme')
    )
    ->whereYear('created_at', $selectedYear)
    ->groupBy('mois')
    ->get();
```

---

### 9.5 Les rapports avancés

**L'application génère trois types de rapports complexes.**

#### 9.5.1 Rapport de clôture

**Route :** `/rapports/cloture`  
**Contrôleur :** `RapportController@getEncaissements100`  
**Vue :** `resources/views/rapport_final/cloture.blade.php`

**Objectif :** Afficher toutes les factures dont **toutes les tranches sont à 100%** (honoraire ET débours).

**Requête SQL (avec CTE - Common Table Expression) :**

```sql
WITH FactureDetails AS (
    SELECT 
        id_facture, 
        SUM(taux_honoraire) AS total_taux_honoraire, 
        SUM(taux_debours) AS total_taux_debours,
        SUM(montant_honoraire) AS total_montant_honoraire,
        SUM(montant_debours) AS total_montant_debours,
        COUNT(*) AS total_tranches,
        SUM(CASE WHEN etat = true THEN 1 ELSE 0 END) AS tranches_valides
    FROM tranche_facture
    WHERE etat = true
    GROUP BY id_facture
    HAVING SUM(taux_honoraire) = 100 
       AND SUM(taux_debours) = 100
)
SELECT 
    f.id_facture,
    c.nom_client,
    c.code_client,
    ch.id_chantier,
    g.reference_chantier,
    f.total_taux_honoraire,
    f.total_taux_debours,
    f.total_montant_honoraire,
    f.total_montant_debours
FROM FactureDetails f
JOIN facture fac ON f.id_facture = fac.id_facture
JOIN chantier ch ON fac.id_chantier = ch.id_chantier
JOIN client c ON ch.id_client = c.id_client
LEFT JOIN get_date g ON ch.id_chantier = g.id_chantier
```

**Explication de la requête :**

1. **CTE `FactureDetails`** : Groupe les tranches par facture et calcule les totaux
2. **`HAVING SUM(taux_honoraire) = 100`** : Filtre uniquement les factures à 100%
3. **`JOIN`** : Récupère les informations client et chantier associées

**Fonctionnalité de recherche :**

```php
public function getEncaissements100AvecRecherche(Request $request)
{
    $search = $request->input('search');
    
    // Requête de base...
    if (!empty($search)) {
        $query .= ' WHERE c.nom_client ILIKE :search';
    }
    
    $encaissements = DB::select($query, ['search' => '%' . $search . '%']);
    
    session()->put('cloture', $encaissements);
    
    return redirect()->route('listesCloture');
}
```

#### 9.5.2 Rapport de vérification

**Route :** `/rapports/verification`  
**Contrôleur :** `RapportController@getVerification`  
**Vue :** `resources/views/rapport_final/suivi.blade.php`

**Objectif :** Afficher **toutes les factures** avec leurs totaux pour vérifier les incohérences.

**Requête SQL :**

```sql
SELECT 
    id_facture, 
    SUM(taux_honoraire) AS total_taux_honoraire, 
    SUM(taux_debours) AS total_taux_debours,
    COUNT(*) AS total_tranches,
    SUM(CASE WHEN etat = true THEN 1 ELSE 0 END) AS tranches_valides
FROM tranche_facture
GROUP BY id_facture
```

**Utilisation :** Permet de repérer les factures dont les taux ne totalisent pas 100%.

#### 9.5.3 Rapport Baromètre (le plus complexe)

**Route :** `/rapports/barometre`  
**Contrôleur :** `RapportController@barometre`  
**Vue :** `resources/views/rapport_final/barometre.blade.php`

**Objectif :** Afficher un tableau croisé dynamique avec :
- Lignes : Chantiers
- Colonnes : Mois-Année
- Valeurs : Montants facturés par mois

**Exemple de rendu :**

- **Chantier** : Projet Alpha - Jan 2024 : 10 000 - Feb 2024 : 15 000 - Mar 2024 : 20 000 - Total Annuel : 45 000
- **Chantier** : Projet Beta - Jan 2024 : 5 000 - Feb 2024 : 8 000 - Mar 2024 : 12 000 - Total Annuel : 25 000
- **Total mois** - Jan 2024 : 15 000 - Feb 2024 : 23 000 - Mar 2024 : 32 000 - Total Annuel : 70 000


**Logique du contrôleur (simplifié) :**

```php
public function barometre()
{
    // 1. Récupérer les données depuis la vue SQL v_barometre
    $barometres = Barometre::all();
    
    $chantiers = [];
    $moisAnnees = [];
    $totauxAnnuelParMois = [];
    
    // 2. Réorganiser les données en structure pivotée
    foreach ($barometres as $barometre) {
        $moisAnnees[$barometre->mois_annee_facture] = true;
        
        if (!isset($chantiers[$barometre->id_chantier])) {
            $chantiers[$barometre->id_chantier] = [
                'reference_chantier' => $barometre->reference_chantier,
                'nom_client' => $barometre->nom_client,
                'total_jour_homme' => $barometre->total_jour_homme,
                'total_global' => $barometre->total_global,
                'factures_par_mois' => [],
                'total_annuel' => 0,
            ];
        }
        
        // Ajouter le montant dans le mois correspondant
        $chantiers[$barometre->id_chantier]['factures_par_mois'][$barometre->mois_annee_facture] = $barometre->total_facture;
        $chantiers[$barometre->id_chantier]['total_annuel'] += $barometre->total_facture;
        
        // Ajouter au total mensuel
        if (!isset($totauxAnnuelParMois[$barometre->mois_annee_facture])) {
            $totauxAnnuelParMois[$barometre->mois_annee_facture] = 0;
        }
        $totauxAnnuelParMois[$barometre->mois_annee_facture] += $barometre->total_facture;
    }
    
    // 3. Trier les mois chronologiquement
    $moisAnnees = array_keys($moisAnnees);
    $moisOrdre = [
        'Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4,
        'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8,
        'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12,
    ];
    
    usort($moisAnnees, function ($a, $b) use ($moisOrdre) {
        [$moisA, $anneeA] = explode(' ', $a);
        [$moisB, $anneeB] = explode(' ', $b);
        
        if ($anneeA !== $anneeB) {
            return $anneeA <=> $anneeB;
        }
        
        return $moisOrdre[$moisA] <=> $moisOrdre[$moisB];
    });
    
    return view('rapport_final.barometre', compact('chantiers', 'moisAnnees', 'totauxAnnuelParMois'));
}
```

**Fonctionnalité de filtrage par année :**

```php
public function barometreFiltre(Request $request)
{
    $selectedYear = $request->input('year');
    
    $barometres = DB::table('v_barometre')
        ->whereRaw("EXTRACT(YEAR FROM TO_DATE(mois_annee_facture, 'Mon YY')) = ?", [$selectedYear])
        ->get();
    
    // Même logique de traitement...
}
```

**Vue SQL `v_barometre` :** Cette vue est créée dans PostgreSQL et agrège les données de plusieurs tables.

---

### 9.6 Gestion multi-rôles (Admin vs Consultant)

**L'application a deux rôles d'utilisateur avec des permissions différentes.**

#### 9.6.1 Vérification du rôle dans les vues

```blade
@if(Auth::user()->role === 'Admin')
    <!-- Afficher le menu complet -->
    @include('layouts.sidebar')
@elseif(Auth::user()->role === 'Consultant')
    <!-- Afficher le menu restreint -->
    @include('layouts.sidebarConsultant')
@endif
```

#### 9.6.2 Permissions par rôle

**Admin :**
- ✅ Créer, modifier, supprimer clients/chantiers/factures
- ✅ Accès aux imports Excel
- ✅ Accès aux paramètres (gestion banques, taux, personnel, sociétés)
- ✅ Générer tous les rapports
- ✅ Accès complet au dashboard

**Consultant :**
- ✅ Voir la liste des clients (lecture seule)
- ✅ Voir la liste des chantiers (lecture seule)
- ✅ Voir la liste des factures (lecture seule)
- ✅ Dashboard avec données limitées
- ❌ **PAS** de modification/suppression
- ❌ **PAS** d'accès aux imports
- ❌ **PAS** d'accès aux paramètres

#### 9.6.3 Routes protégées par middleware

```php
// Routes Admin uniquement
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('client', ClientController::class);
    Route::post('/import/client', [ImportController::class, 'importClient']);
    Route::get('/parametres', [ParametreController::class, 'index']);
});

// Routes Consultant
Route::middleware(['auth', 'role:Consultant'])->group(function () {
    Route::get('/consultant/dashboard', [ConsultantController::class, 'dashboard']);
    Route::get('/consultant/clients', [ConsultantController::class, 'clients']);
});
```

---

### 9.7 Autres fonctionnalités importantes

#### 9.7.1 Recherche de clients

**Fonctionnalité :** Rechercher un client par nom (insensible à la casse, recherche partielle).

```php
public function search(Request $request)
{
    $search = $request->input('nom_client');
    
    $clients = Client::where('nom_client', 'ILIKE', '%' . $search . '%')
                     ->with(['pays', 'secteurActivite'])
                     ->get();
    
    return view('client.listClients', compact('clients'));
}
```

**Dans la vue :**

```blade
<form action="{{ route('clients.search') }}" method="GET">
    <input type="text" name="nom_client" placeholder="Recherche client...">
    <button type="submit">Rechercher</button>
</form>
```

#### 9.7.2 Suppression douce (Soft Delete)

**L'application utilise un système de "suppression douce" via le champ `actif`.**

Au lieu de supprimer physiquement un enregistrement :

```php
// MAUVAIS : Suppression définitive
$client->delete();

// BON : Marquage comme inactif
$client->actif = false;
$client->save();
```

**Avantages :**
- Les données sont conservées pour l'historique
- Possibilité de réactiver un client
- Pas de problème avec les clés étrangères

**Filtrage dans les requêtes :**

```php
// Récupérer uniquement les clients actifs
$clients = Client::where('actif', true)->get();
```

#### 9.7.3 Conversion de nombres en lettres

**Bibliothèque :** `kwn/number-to-words`

**Utilisation :** Pour afficher le montant en lettres dans les factures PDF.

```php
use Kwn\NumberToWords\NumberToWords;

$numberToWords = new NumberToWords();
$numberTransformer = $numberToWords->getNumberTransformer('fr');

$montant = 1250.50;
$montantEnLettres = $numberTransformer->toWords($montant);
// Résultat : "mille deux cent cinquante virgule cinquante"
```

#### 9.7.4 Gestion multi-devises

**L'application supporte plusieurs devises via la table `monnaie`.**

**Exemple de devises :**
- Euro (EUR)
- Dollar américain (USD)
- Franc CFA (XAF)
- Ariary malgache (MGA)

**Utilisation dans les vues :**

```blade
<p>Total : {{ number_format($montant, 0, ',', ' ') }} {{ $chantier->monnaie->nom_monnaie }}</p>
<!-- Affiche : Total : 15 000 EUR -->
```

---

### 9.8 Commandes Artisan personnalisées

**Vous pouvez créer des commandes personnalisées pour automatiser des tâches.**

**Exemple :** Calculer les totaux de tous les chantiers

```bash
php artisan chantier:calculer-totaux
```

**Code de la commande (hypothétique) :**

```php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Chantier;

class CalculerTotauxChantiers extends Command
{
    protected $signature = 'chantier:calculer-totaux';
    protected $description = 'Recalculer les totaux de tous les chantiers';

    public function handle()
    {
        $chantiers = Chantier::all();
        
        foreach ($chantiers as $chantier) {
            // Recalculer les totaux...
            $this->info("Chantier {$chantier->id_chantier} traité");
        }
        
        $this->info('Tous les totaux ont été recalculés !');
    }
}
```

---

### 9.9 Résumé des fonctionnalités

**Fonctionnalités principales :**

1. ✅ **Workflow complet en 8 étapes** (Client → Encaissement)
2. ✅ **Mise à jour automatique des statuts** (`updateFactureStatus`)
3. ✅ **Imports Excel** (clients, chantiers, budgets, factures)
4. ✅ **Dashboard avec graphiques** (Chart.js)
5. ✅ **Rapports avancés** (clôture, vérification, baromètre)
6. ✅ **Gestion multi-rôles** (Admin vs Consultant)
7. ✅ **Recherche et filtres**
8. ✅ **Suppression douce** (via champ `actif`)
9. ✅ **Multi-devises**
10. ✅ **Conversion nombres en lettres**

**Dans la prochaine section, nous verrons comment AJOUTER une nouvelle fonctionnalité au projet (guide étape par étape).**


---

## 10. COMMENT AJOUTER UNE NOUVELLE FONCTIONNALITÉ

Cette section est un **guide pratique étape par étape** pour ajouter une nouvelle fonctionnalité au projet.

**Nous allons créer ensemble une fonctionnalité complète :** Un système de **documents/pièces jointes** pour les chantiers.

### 10.1 Exemple de fonctionnalité : Ajouter des documents aux chantiers

**Besoin métier :**
- Les utilisateurs veulent pouvoir joindre des documents aux chantiers (contrats, devis, rapports, etc.)
- Chaque document doit avoir un nom, un type, et un fichier
- On doit pouvoir lister, télécharger et supprimer les documents

**Ce que nous allons créer :**
- Une table `document_chantier` en base de données
- Un modèle `DocumentChantier`
- Un contrôleur `DocumentChantierController`
- Des routes pour gérer les documents
- Des vues pour uploader et lister les documents

---

### 10.2 ÉTAPE 1 : Créer la migration (structure de la table)

**Une migration crée ou modifie la structure de la base de données.**

#### 10.2.1 Créer le fichier de migration

**Commande Artisan :**

```bash
php artisan make:migration create_document_chantier_table
```

**Résultat :** Un nouveau fichier est créé dans `database/migrations/` avec un nom comme :
```
2024_01_15_143022_create_document_chantier_table.php
```

Le préfixe (date et heure) garantit que les migrations s'exécutent dans le bon ordre.

#### 10.2.2 Définir la structure de la table

**Ouvrir le fichier de migration et modifier la méthode `up()` :**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter la migration (créer la table)
     */
    public function up(): void
    {
        Schema::create('document_chantier', function (Blueprint $table) {
            // Clé primaire
            $table->id('id_document');
            
            // Clé étrangère vers chantier
            $table->unsignedBigInteger('id_chantier');
            $table->foreign('id_chantier')
                  ->references('id_chantier')
                  ->on('chantier')
                  ->onDelete('cascade');  // Si le chantier est supprimé, supprimer aussi les documents
            
            // Informations du document
            $table->string('nom_document', 255);  // Nom du fichier
            $table->string('type_document', 100)->nullable();  // Type : contrat, devis, rapport, etc.
            $table->string('chemin_fichier', 500);  // Chemin vers le fichier sur le serveur
            $table->string('extension', 10);  // Extension : pdf, docx, xlsx, etc.
            $table->integer('taille_fichier')->nullable();  // Taille en octets
            
            // Métadonnées
            $table->text('description')->nullable();  // Description optionnelle
            $table->boolean('actif')->default(true);  // Pour suppression douce
            
            // Timestamps (created_at et updated_at)
            $table->timestamps();
        });
    }

    /**
     * Annuler la migration (supprimer la table)
     */
    public function down(): void
    {
        Schema::dropIfExists('document_chantier');
    }
};
```

**Explication ligne par ligne :**

1. **`$table->id('id_document')`** : Crée une colonne `id_document` de type BIGINT AUTO_INCREMENT (clé primaire)
2. **`$table->unsignedBigInteger('id_chantier')`** : Colonne pour la clé étrangère (entier positif)
3. **`$table->foreign('id_chantier')->references('id_chantier')->on('chantier')`** : Définit la contrainte de clé étrangère
4. **`->onDelete('cascade')`** : Si le chantier est supprimé, supprimer automatiquement ses documents
5. **`$table->string('nom_document', 255)`** : Colonne VARCHAR(255)
6. **`->nullable()`** : La colonne peut contenir NULL (optionnel)
7. **`$table->timestamps()`** : Ajoute automatiquement `created_at` et `updated_at`

#### 10.2.3 Exécuter la migration

**Commande Artisan :**

```bash
php artisan migrate
```

**Résultat :** La table `document_chantier` est créée dans PostgreSQL.

**Vérifier dans PostgreSQL :**

```bash
php artisan tinker
>>> DB::select("SELECT * FROM information_schema.tables WHERE table_name = 'document_chantier'");
```

**En cas d'erreur :** Si vous devez corriger la migration :

```bash
# Annuler la dernière migration
php artisan migrate:rollback

# Modifier le fichier de migration
# Puis réexécuter
php artisan migrate
```

---

### 10.3 ÉTAPE 2 : Créer le modèle Eloquent

**Le modèle représente la table en PHP et gère les interactions avec la base de données.**

#### 10.3.1 Créer le fichier du modèle

**Commande Artisan :**

```bash
php artisan make:model DocumentChantier
```

**Résultat :** Un fichier `app/Models/DocumentChantier.php` est créé.

#### 10.3.2 Définir le modèle

**Éditer `app/Models/DocumentChantier.php` :**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentChantier extends Model
{
    use HasFactory;

    /**
     * Nom de la table (optionnel si le nom suit la convention)
     */
    protected $table = 'document_chantier';

    /**
     * Clé primaire personnalisée
     */
    protected $primaryKey = 'id_document';

    /**
     * Les champs qui peuvent être assignés en masse
     * (protection contre l'assignation de masse)
     */
    protected $fillable = [
        'id_chantier',
        'nom_document',
        'type_document',
        'chemin_fichier',
        'extension',
        'taille_fichier',
        'description',
        'actif',
    ];

    /**
     * Les champs qui doivent être castés en types spécifiques
     */
    protected $casts = [
        'actif' => 'boolean',
        'taille_fichier' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * RELATION : Un document appartient à un chantier
     */
    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier', 'id_chantier');
    }

    /**
     * MÉTHODE UTILITAIRE : Obtenir la taille du fichier formatée
     */
    public function getTailleFormateeAttribute()
    {
        if (!$this->taille_fichier) {
            return 'N/A';
        }

        $taille = $this->taille_fichier;

        if ($taille < 1024) {
            return $taille . ' octets';
        } elseif ($taille < 1048576) {
            return round($taille / 1024, 2) . ' Ko';
        } else {
            return round($taille / 1048576, 2) . ' Mo';
        }
    }

    /**
     * MÉTHODE UTILITAIRE : Obtenir l'icône selon l'extension
     */
    public function getIconeAttribute()
    {
        $icones = [
            'pdf' => 'lni lni-files',
            'doc' => 'lni lni-microsoft-word',
            'docx' => 'lni lni-microsoft-word',
            'xls' => 'lni lni-microsoft-excel',
            'xlsx' => 'lni lni-microsoft-excel',
            'jpg' => 'lni lni-image',
            'jpeg' => 'lni lni-image',
            'png' => 'lni lni-image',
            'zip' => 'lni lni-archive',
            'rar' => 'lni lni-archive',
        ];

        return $icones[$this->extension] ?? 'lni lni-file';
    }

    /**
     * SCOPE : Récupérer uniquement les documents actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }
}
```

**Explication des éléments importants :**

1. **`$fillable`** : Liste blanche des champs qui peuvent être assignés avec `create()` ou `update()`
2. **`$casts`** : Conversion automatique des types (ex: 'actif' sera un booléen en PHP)
3. **`chantier()`** : Définit la relation `belongsTo` (un document appartient à un chantier)
4. **`getTailleFormateeAttribute()`** : Accesseur personnalisé (appelé avec `$document->taille_formatee`)
5. **`scopeActif()`** : Scope pour filtrer uniquement les documents actifs (`DocumentChantier::actif()->get()`)

#### 10.3.3 Ajouter la relation inverse dans le modèle Chantier

**Éditer `app/Models/Chantier.php` et ajouter :**

```php
/**
 * RELATION : Un chantier peut avoir plusieurs documents
 */
public function documents()
{
    return $this->hasMany(DocumentChantier::class, 'id_chantier', 'id_chantier');
}
```

**Utilisation :**

```php
$chantier = Chantier::find(1);
$documents = $chantier->documents;  // Récupère tous les documents du chantier
```

---

### 10.4 ÉTAPE 3 : Créer le contrôleur

**Le contrôleur contient la logique métier (créer, lire, modifier, supprimer).**

#### 10.4.1 Créer le fichier du contrôleur

**Commande Artisan :**

```bash
php artisan make:controller DocumentChantierController --resource
```

**Le flag `--resource` crée automatiquement les méthodes CRUD standards.**

**Résultat :** Un fichier `app/Http/Controllers/DocumentChantierController.php` est créé avec les méthodes :
- `index()` : Lister les documents
- `create()` : Afficher le formulaire de création
- `store()` : Enregistrer un nouveau document
- `show()` : Afficher un document
- `edit()` : Afficher le formulaire de modification
- `update()` : Mettre à jour un document
- `destroy()` : Supprimer un document

#### 10.4.2 Implémenter les méthodes du contrôleur

**Éditer `app/Http/Controllers/DocumentChantierController.php` :**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\DocumentChantier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentChantierController extends Controller
{
    /**
     * Afficher la liste des documents d'un chantier
     */
    public function index($id_chantier)
    {
        // Récupérer le chantier avec ses documents
        $chantier = Chantier::with(['documents' => function($query) {
            $query->where('actif', true)->orderBy('created_at', 'desc');
        }])->findOrFail($id_chantier);

        return view('document_chantier.index', compact('chantier'));
    }

    /**
     * Afficher le formulaire d'upload
     */
    public function create($id_chantier)
    {
        $chantier = Chantier::findOrFail($id_chantier);
        
        return view('document_chantier.create', compact('chantier'));
    }

    /**
     * Enregistrer un nouveau document (UPLOAD)
     */
    public function store(Request $request)
    {
        // 1. VALIDATION
        $validated = $request->validate([
            'id_chantier' => 'required|exists:chantier,id_chantier',
            'type_document' => 'required|in:contrat,devis,rapport,facture,autre',
            'description' => 'nullable|string|max:1000',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip|max:10240',
            // max:10240 = 10 Mo maximum
        ], [
            'fichier.required' => 'Veuillez sélectionner un fichier.',
            'fichier.mimes' => 'Format de fichier non autorisé. Formats acceptés : PDF, Word, Excel, Images, ZIP.',
            'fichier.max' => 'Le fichier ne doit pas dépasser 10 Mo.',
        ]);

        // 2. UPLOAD DU FICHIER
        $file = $request->file('fichier');
        
        // Générer un nom unique pour le fichier
        $nomOriginal = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nomUnique = time() . '_' . uniqid() . '.' . $extension;
        
        // Stocker le fichier dans storage/app/public/documents
        $cheminFichier = $file->storeAs('documents', $nomUnique, 'public');
        
        // 3. CRÉER L'ENREGISTREMENT EN BASE DE DONNÉES
        $document = DocumentChantier::create([
            'id_chantier' => $validated['id_chantier'],
            'nom_document' => $nomOriginal,
            'type_document' => $validated['type_document'],
            'chemin_fichier' => $cheminFichier,
            'extension' => $extension,
            'taille_fichier' => $file->getSize(),
            'description' => $validated['description'],
            'actif' => true,
        ]);

        // 4. REDIRECTION AVEC MESSAGE DE SUCCÈS
        return redirect()
            ->route('documents.index', ['id_chantier' => $validated['id_chantier']])
            ->with('success', 'Document ajouté avec succès.');
    }

    /**
     * Télécharger un document
     */
    public function download($id_document)
    {
        $document = DocumentChantier::findOrFail($id_document);
        
        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($document->chemin_fichier)) {
            return redirect()->back()->with('error', 'Fichier introuvable.');
        }
        
        // Télécharger le fichier avec son nom original
        return Storage::disk('public')->download(
            $document->chemin_fichier, 
            $document->nom_document
        );
    }

    /**
     * Supprimer un document (soft delete)
     */
    public function destroy($id_document)
    {
        $document = DocumentChantier::findOrFail($id_document);
        
        // Suppression douce (marquer comme inactif)
        $document->actif = false;
        $document->save();
        
        // Optionnel : Supprimer physiquement le fichier
        // Storage::disk('public')->delete($document->chemin_fichier);
        
        return redirect()
            ->back()
            ->with('success', 'Document supprimé avec succès.');
    }

    /**
     * Supprimer définitivement un document (hard delete)
     */
    public function forceDestroy($id_document)
    {
        $document = DocumentChantier::findOrFail($id_document);
        
        // Supprimer le fichier physique
        if (Storage::disk('public')->exists($document->chemin_fichier)) {
            Storage::disk('public')->delete($document->chemin_fichier);
        }
        
        // Supprimer l'enregistrement en base de données
        $document->delete();
        
        return redirect()
            ->back()
            ->with('success', 'Document supprimé définitivement.');
    }
}
```

**Explication des points clés :**

1. **Validation** : Laravel valide automatiquement les données et renvoie des erreurs si invalide
2. **Upload de fichier** : `$file->storeAs()` stocke le fichier dans `storage/app/public/documents/`
3. **Nom unique** : `time() . '_' . uniqid()` évite les conflits de noms
4. **Storage facade** : Laravel fournit une API unifiée pour gérer les fichiers
5. **Suppression douce** : On marque `actif = false` au lieu de supprimer
6. **Suppression physique** : `forceDestroy()` supprime le fichier ET l'enregistrement

---

### 10.5 ÉTAPE 4 : Créer les routes

**Les routes définissent les URLs et les associent aux méthodes du contrôleur.**

#### 10.5.1 Ajouter les routes dans `routes/web.php`

**Éditer `routes/web.php` et ajouter :**

```php
use App\Http\Controllers\DocumentChantierController;

// Routes pour les documents de chantier
Route::middleware(['auth'])->group(function () {
    // Lister les documents d'un chantier
    Route::get('/chantier/{id_chantier}/documents', [DocumentChantierController::class, 'index'])
        ->name('documents.index');
    
    // Afficher le formulaire d'upload
    Route::get('/chantier/{id_chantier}/documents/create', [DocumentChantierController::class, 'create'])
        ->name('documents.create');
    
    // Enregistrer un document
    Route::post('/documents', [DocumentChantierController::class, 'store'])
        ->name('documents.store');
    
    // Télécharger un document
    Route::get('/documents/{id_document}/download', [DocumentChantierController::class, 'download'])
        ->name('documents.download');
    
    // Supprimer un document (soft delete)
    Route::delete('/documents/{id_document}', [DocumentChantierController::class, 'destroy'])
        ->name('documents.destroy');
    
    // Supprimer définitivement (hard delete)
    Route::delete('/documents/{id_document}/force', [DocumentChantierController::class, 'forceDestroy'])
        ->name('documents.forceDestroy');
});
```

**Vérifier les routes :**

```bash
php artisan route:list --name=documents
```

**Résultat attendu :**

```
GET|HEAD   chantier/{id_chantier}/documents ........... documents.index
GET|HEAD   chantier/{id_chantier}/documents/create ... documents.create
POST       documents .................................. documents.store
GET|HEAD   documents/{id_document}/download .......... documents.download
DELETE     documents/{id_document} ................... documents.destroy
DELETE     documents/{id_document}/force ............. documents.forceDestroy
```

---

### 10.6 ÉTAPE 5 : Créer les vues Blade

**Les vues affichent l'interface utilisateur.**

#### 10.6.1 Créer le dossier et les fichiers

**Créer le dossier :**

```bash
mkdir resources/views/document_chantier
```

**Créer les fichiers :**

```bash
touch resources/views/document_chantier/index.blade.php
touch resources/views/document_chantier/create.blade.php
```

#### 10.6.2 Vue pour lister les documents (index.blade.php)

**Créer `resources/views/document_chantier/index.blade.php` :**

```blade
@extends('layouts.app')

@section('content')
    <!-- Message de succès -->
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Titre -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Documents du chantier : {{ $chantier->getdates->reference_chantier ?? 'N/A' }}</h2>
                <p class="text-muted">Client : {{ $chantier->client->nom_client }}</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('documents.create', ['id_chantier' => $chantier->id_chantier]) }}" 
                   class="main-btn primary-btn btn-hover">
                    <i class="lni lni-plus"></i> Ajouter un document
                </a>
            </div>
        </div>
    </div>

    <!-- Tableau des documents -->
    <div class="card-style mb-30">
        @if($chantier->documents->isEmpty())
            <div class="alert alert-info">
                <i class="lni lni-information"></i>
                Aucun document n'a été ajouté à ce chantier.
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Icône</th>
                            <th>Nom du document</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Description</th>
                            <th>Date d'ajout</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chantier->documents as $document)
                            <tr>
                                <!-- Icône selon l'extension -->
                                <td>
                                    <i class="{{ $document->icone }} text-primary" style="font-size: 24px;"></i>
                                </td>
                                
                                <!-- Nom du document -->
                                <td>
                                    <strong>{{ $document->nom_document }}</strong>
                                    <br>
                                    <small class="text-muted">.{{ $document->extension }}</small>
                                </td>
                                
                                <!-- Type -->
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($document->type_document) }}</span>
                                </td>
                                
                                <!-- Taille formatée -->
                                <td>{{ $document->taille_formatee }}</td>
                                
                                <!-- Description -->
                                <td>
                                    {{ $document->description ?? '-' }}
                                </td>
                                
                                <!-- Date d'ajout -->
                                <td>{{ $document->created_at->format('d/m/Y H:i') }}</td>
                                
                                <!-- Actions -->
                                <td>
                                    <!-- Télécharger -->
                                    <a href="{{ route('documents.download', ['id_document' => $document->id_document]) }}" 
                                       class="btn btn-sm btn-success"
                                       title="Télécharger">
                                        <i class="lni lni-download"></i>
                                    </a>
                                    
                                    <!-- Supprimer -->
                                    <form action="{{ route('documents.destroy', ['id_document' => $document->id_document]) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="lni lni-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bouton retour -->
    <a href="{{ route('detailsChantier', ['id_chantier' => $chantier->id_chantier]) }}" 
       class="main-btn deactive-btn btn-hover">
        <i class="lni lni-arrow-left"></i> Retour aux détails du chantier
    </a>

    <!-- Script pour masquer le message de succès après 3 secondes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endsection
```

#### 10.6.3 Vue pour uploader un document (create.blade.php)

**Créer `resources/views/document_chantier/create.blade.php` :**

```blade
@extends('layouts.app')

@section('content')
    <!-- Titre -->
    <div class="title-wrapper pt-30">
        <h2>Ajouter un document au chantier : {{ $chantier->getdates->reference_chantier ?? 'N/A' }}</h2>
        <p class="text-muted">Client : {{ $chantier->client->nom_client }}</p>
    </div>

    <!-- Formulaire d'upload -->
    <div class="card-style mb-30">
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Champ caché pour l'ID du chantier -->
            <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">
            
            <!-- Afficher les erreurs de validation -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="row">
                <!-- Type de document -->
                <div class="col-md-6">
                    <div class="select-style-1">
                        <label for="type_document">Type de document *</label>
                        <select id="type_document" name="type_document" required>
                            <option value="">-- Choisir un type --</option>
                            <option value="contrat" {{ old('type_document') == 'contrat' ? 'selected' : '' }}>
                                Contrat
                            </option>
                            <option value="devis" {{ old('type_document') == 'devis' ? 'selected' : '' }}>
                                Devis
                            </option>
                            <option value="rapport" {{ old('type_document') == 'rapport' ? 'selected' : '' }}>
                                Rapport
                            </option>
                            <option value="facture" {{ old('type_document') == 'facture' ? 'selected' : '' }}>
                                Facture
                            </option>
                            <option value="autre" {{ old('type_document') == 'autre' ? 'selected' : '' }}>
                                Autre
                            </option>
                        </select>
                        @error('type_document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Fichier -->
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="fichier">Fichier *</label>
                        <input type="file" 
                               id="fichier" 
                               name="fichier" 
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.zip"
                               required
                               onchange="afficherNomFichier(this)">
                        <small class="text-muted">
                            Formats acceptés : PDF, Word, Excel, Images, ZIP (max 10 Mo)
                        </small>
                        <p id="nom-fichier" class="text-success mt-2" style="display: none;"></p>
                        @error('fichier')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Description -->
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="description">Description (optionnelle)</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Décrivez brièvement ce document...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="col-12">
                    <a href="{{ route('documents.index', ['id_chantier' => $chantier->id_chantier]) }}" 
                       class="main-btn deactive-btn btn-hover">
                        Annuler
                    </a>
                    
                    <button type="submit" class="main-btn primary-btn btn-hover" style="float: right;">
                        <i class="lni lni-upload"></i> Uploader le document
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript pour afficher le nom du fichier sélectionné -->
    <script>
        function afficherNomFichier(input) {
            const nomFichierElement = document.getElementById('nom-fichier');
            
            if (input.files && input.files[0]) {
                const fichier = input.files[0];
                const taille = (fichier.size / 1024 / 1024).toFixed(2); // Taille en Mo
                
                nomFichierElement.textContent = `Fichier sélectionné : ${fichier.name} (${taille} Mo)`;
                nomFichierElement.style.display = 'block';
            } else {
                nomFichierElement.style.display = 'none';
            }
        }
    </script>
@endsection
```

---

### 10.7 ÉTAPE 6 : Configurer le stockage de fichiers

**Par défaut, Laravel stocke les fichiers dans `storage/app/`. Pour les rendre accessibles publiquement, on doit créer un lien symbolique.**

#### 10.7.1 Créer le lien symbolique

**Commande Artisan :**

```bash
php artisan storage:link
```

**Résultat :** Crée un lien symbolique de `public/storage` vers `storage/app/public`

**Vérification :**

```bash
ls -la public/storage
# Devrait afficher : public/storage -> ../storage/app/public
```

**Maintenant, les fichiers dans `storage/app/public/documents/` sont accessibles via :**
```
http://localhost:8000/storage/documents/nom_du_fichier.pdf
```

#### 10.7.2 Configurer les permissions (sur serveur Linux)

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

### 10.8 ÉTAPE 7 : Ajouter un lien dans le menu

**Pour que les utilisateurs puissent accéder à la fonctionnalité, ajoutons un lien dans la page de détails du chantier.**

**Éditer `resources/views/chantier/detailsChantier.blade.php` et ajouter :**

```blade
<!-- Bouton pour accéder aux documents -->
<div class="col-md-3">
    <a href="{{ route('documents.index', ['id_chantier' => $chantier->id_chantier]) }}" 
       class="btn btn-primary btn-block">
        <i class="lni lni-files"></i> Documents ({{ $chantier->documents->count() }})
    </a>
</div>
```

---

### 10.9 ÉTAPE 8 : Tester la fonctionnalité

**Maintenant, testons toutes les fonctionnalités.**

#### 10.9.1 Test manuel dans le navigateur

1. **Naviguer vers un chantier :**
   ```
   http://localhost:8000/chantier/1
   ```

2. **Cliquer sur le bouton "Documents"**

3. **Cliquer sur "Ajouter un document"**

4. **Remplir le formulaire :**
   - Type : Contrat
   - Fichier : Sélectionner un PDF de test
   - Description : "Contrat de prestation"

5. **Cliquer sur "Uploader le document"**

6. **Vérifier :**
   - Le document apparaît dans la liste
   - Le compteur de documents est mis à jour
   - On peut télécharger le fichier
   - On peut supprimer le document

#### 10.9.2 Test avec Tinker

**Ouvrir Tinker :**

```bash
php artisan tinker
```

**Créer un document manuellement :**

```php
$document = new App\Models\DocumentChantier();
$document->id_chantier = 1;
$document->nom_document = 'test.pdf';
$document->type_document = 'contrat';
$document->chemin_fichier = 'documents/test.pdf';
$document->extension = 'pdf';
$document->taille_fichier = 1024000;
$document->description = 'Document de test';
$document->actif = true;
$document->save();
```

**Vérifier :**

```php
App\Models\DocumentChantier::find(1);
// Devrait afficher le document créé

App\Models\Chantier::find(1)->documents;
// Devrait afficher tous les documents du chantier
```

#### 10.9.3 Vérifier en base de données

**Avec psql :**

```bash
php artisan tinker
>>> DB::select('SELECT * FROM document_chantier');
```

**Ou directement en SQL :**

```sql
SELECT * FROM document_chantier WHERE id_chantier = 1;
```

---

### 10.10 ÉTAPE 9 : Améliorations possibles

**Une fois la fonctionnalité de base en place, vous pouvez l'améliorer :**

#### 10.10.1 Ajouter la pagination

**Dans le contrôleur :**

```php
public function index($id_chantier)
{
    $chantier = Chantier::findOrFail($id_chantier);
    
    $documents = DocumentChantier::where('id_chantier', $id_chantier)
                                 ->where('actif', true)
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(10);  // 10 documents par page
    
    return view('document_chantier.index', compact('chantier', 'documents'));
}
```

**Dans la vue :**

```blade
{{ $documents->links() }}
```

#### 10.10.2 Ajouter une recherche

**Dans le contrôleur :**

```php
public function index(Request $request, $id_chantier)
{
    $chantier = Chantier::findOrFail($id_chantier);
    
    $query = DocumentChantier::where('id_chantier', $id_chantier)
                              ->where('actif', true);
    
    // Recherche par nom
    if ($request->has('search')) {
        $query->where('nom_document', 'ILIKE', '%' . $request->search . '%');
    }
    
    // Filtre par type
    if ($request->has('type')) {
        $query->where('type_document', $request->type);
    }
    
    $documents = $query->orderBy('created_at', 'desc')->paginate(10);
    
    return view('document_chantier.index', compact('chantier', 'documents'));
}
```

#### 10.10.3 Ajouter une prévisualisation

**Pour les PDF, vous pouvez utiliser un iframe :**

```blade
@if($document->extension == 'pdf')
    <a href="{{ asset('storage/' . $document->chemin_fichier) }}" 
       target="_blank"
       class="btn btn-sm btn-info">
        <i class="lni lni-eye"></i> Prévisualiser
    </a>
@endif
```

#### 10.10.4 Ajouter des permissions

**Restreindre l'accès selon le rôle :**

```php
// Dans le contrôleur
public function destroy($id_document)
{
    // Vérifier que l'utilisateur est Admin
    if (Auth::user()->role !== 'Admin') {
        return redirect()->back()->with('error', 'Action non autorisée.');
    }
    
    // ... reste du code
}
```

---

### 10.11 Checklist complète pour ajouter une fonctionnalité

**Utilisez cette checklist pour toute nouvelle fonctionnalité :**

- [ ] **1. Créer la migration** (`php artisan make:migration`)
  - [ ] Définir les colonnes
  - [ ] Définir les clés étrangères
  - [ ] Définir les index si nécessaire
  - [ ] Exécuter la migration (`php artisan migrate`)

- [ ] **2. Créer le modèle** (`php artisan make:model`)
  - [ ] Définir `$table` (si nom non standard)
  - [ ] Définir `$primaryKey` (si non standard)
  - [ ] Définir `$fillable` ou `$guarded`
  - [ ] Définir `$casts`
  - [ ] Ajouter les relations (`hasMany`, `belongsTo`, etc.)
  - [ ] Ajouter les accesseurs/mutateurs si nécessaire
  - [ ] Ajouter les scopes si nécessaire

- [ ] **3. Créer le contrôleur** (`php artisan make:controller --resource`)
  - [ ] Implémenter `index()` (liste)
  - [ ] Implémenter `create()` (formulaire de création)
  - [ ] Implémenter `store()` (enregistrement)
  - [ ] Implémenter `show()` (détails) si nécessaire
  - [ ] Implémenter `edit()` (formulaire de modification) si nécessaire
  - [ ] Implémenter `update()` (mise à jour) si nécessaire
  - [ ] Implémenter `destroy()` (suppression)
  - [ ] Ajouter la validation
  - [ ] Ajouter les messages flash (succès/erreur)

- [ ] **4. Créer les routes** (dans `routes/web.php`)
  - [ ] Ajouter les routes individuelles OU
  - [ ] Utiliser `Route::resource()` pour les routes CRUD
  - [ ] Ajouter le middleware d'authentification
  - [ ] Ajouter les middlewares de rôles si nécessaire
  - [ ] Vérifier avec `php artisan route:list`

- [ ] **5. Créer les vues** (dans `resources/views/`)
  - [ ] Créer le dossier pour la fonctionnalité
  - [ ] Créer `index.blade.php` (liste)
  - [ ] Créer `create.blade.php` (formulaire création)
  - [ ] Créer `edit.blade.php` (formulaire modification) si nécessaire
  - [ ] Utiliser `@extends('layouts.app')`
  - [ ] Utiliser `@section('content')`
  - [ ] Ajouter la gestion des erreurs avec `@error`
  - [ ] Ajouter les messages flash avec `@if(session('success'))`

- [ ] **6. Ajouter les liens dans le menu**
  - [ ] Ajouter un lien dans la sidebar
  - [ ] Ajouter un lien dans les pages pertinentes

- [ ] **7. Tester la fonctionnalité**
  - [ ] Test manuel dans le navigateur
  - [ ] Test avec Tinker
  - [ ] Vérifier en base de données
  - [ ] Tester tous les cas d'erreur
  - [ ] Tester les permissions si applicable

- [ ] **8. Documenter** (optionnel mais recommandé)
  - [ ] Ajouter des commentaires dans le code
  - [ ] Mettre à jour la documentation technique
  - [ ] Créer un fichier README si nécessaire

---

### 10.12 Commandes Artisan utiles

**Voici toutes les commandes Artisan que vous utiliserez fréquemment :**

```bash
# Créer une migration
php artisan make:migration create_nom_table_table
php artisan make:migration add_colonne_to_table_table

# Exécuter les migrations
php artisan migrate
php artisan migrate:rollback  # Annuler la dernière migration
php artisan migrate:fresh     # Tout recréer (ATTENTION : supprime les données)
php artisan migrate:status    # Voir l'état des migrations

# Créer un modèle
php artisan make:model NomModele
php artisan make:model NomModele -m  # Avec migration
php artisan make:model NomModele -mc # Avec migration et contrôleur

# Créer un contrôleur
php artisan make:controller NomController
php artisan make:controller NomController --resource  # Avec méthodes CRUD

# Voir les routes
php artisan route:list
php artisan route:list --name=documents  # Filtrer par nom

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Tinker (REPL)
php artisan tinker

# Créer le lien symbolique pour le storage
php artisan storage:link

# Voir la structure de la base de données
php artisan db:show
php artisan db:table nom_table
```

---

### 10.13 Résumé

**Pour ajouter une nouvelle fonctionnalité, suivez toujours cet ordre :**

```
1. Migration (structure BDD)
   ↓
2. Modèle (représentation en PHP)
   ↓
3. Contrôleur (logique métier)
   ↓
4. Routes (URLs)
   ↓
5. Vues (interface utilisateur)
   ↓
6. Tests (vérification)
   ↓
7. Documentation (commentaires)
```

**Règles d'or :**

1. **TOUJOURS** valider les données utilisateur
2. **TOUJOURS** utiliser les transactions DB pour les opérations complexes
3. **TOUJOURS** ajouter des messages de feedback (succès/erreur)
4. **TOUJOURS** gérer les cas d'erreur (fichier manquant, ID invalide, etc.)
5. **TOUJOURS** commenter votre code
6. **TOUJOURS** tester avant de déployer

**Dans la prochaine section, nous verrons comment DÉBOGUER et résoudre les problèmes courants.**


---

## 11. DÉBOGAGE ET RÉSOLUTION DE PROBLÈMES

Cette section vous aide à **identifier et résoudre les erreurs** que vous rencontrerez lors du développement.

### 11.1 Les outils de débogage de Laravel

**Laravel fournit plusieurs outils puissants pour déboguer votre code.**

#### 11.1.1 dd() - Dump and Die

**C'est l'outil de débogage LE PLUS UTILISÉ.**

**`dd()` affiche le contenu d'une variable et arrête l'exécution du script.**

**Exemple :**

```php
public function index()
{
    $clients = Client::all();
    
    dd($clients);  // Affiche le contenu de $clients et ARRÊTE ici
    
    // Cette ligne ne sera JAMAIS exécutée
    return view('client.listClients', compact('clients'));
}
```

**Résultat dans le navigateur :**
```
Collection {#1234
  #items: array:5 [
    0 => Client {#5678
      #attributes: array:8 [
        "id_client" => 1
        "code_client" => "CLI001"
        "nom_client" => "Entreprise X"
        ...
      ]
    }
    ...
  ]
}
```

**Utilisations courantes :**

```php
// Déboguer une variable
dd($variable);

// Déboguer plusieurs variables
dd($var1, $var2, $var3);

// Déboguer une requête Eloquent
dd(Client::where('actif', true)->get());

// Déboguer une requête SQL (voir la requête générée)
dd(Client::where('actif', true)->toSql());

// Déboguer les données d'une requête HTTP
dd($request->all());

// Déboguer la session
dd(session()->all());

// Déboguer l'utilisateur connecté
dd(Auth::user());
```

#### 11.1.2 dump() - Dump sans arrêter

**`dump()` affiche le contenu d'une variable SANS arrêter l'exécution.**

**Exemple :**

```php
public function index()
{
    $clients = Client::all();
    
    dump($clients);  // Affiche $clients
    
    $actifs = $clients->where('actif', true);
    
    dump($actifs);  // Affiche $actifs
    
    return view('client.listClients', compact('clients'));  // Continue l'exécution
}
```

**Utile pour déboguer plusieurs points dans le même flux.**

#### 11.1.3 ddd() - Dump, Die, and Debug

**`ddd()` est comme `dd()` mais avec une meilleure mise en forme.**

```php
ddd($clients);
```

#### 11.1.4 Log::debug() - Écrire dans les logs

**Pour déboguer en production SANS afficher d'informations aux utilisateurs.**

```php
use Illuminate\Support\Facades\Log;

public function store(Request $request)
{
    Log::debug('Début de la création du client');
    Log::debug('Données reçues', $request->all());
    
    $client = Client::create($request->all());
    
    Log::info('Client créé avec succès', ['id_client' => $client->id_client]);
    
    return redirect()->route('listClients');
}
```

**Les logs sont écrits dans `storage/logs/laravel.log`**

**Niveaux de log disponibles :**

```php
Log::emergency($message);  // Système inutilisable
Log::alert($message);      // Action immédiate requise
Log::critical($message);   // Conditions critiques
Log::error($message);      // Erreurs
Log::warning($message);    // Avertissements
Log::notice($message);     // Événements normaux mais significatifs
Log::info($message);       // Informations
Log::debug($message);      // Informations de débogage
```

**Voir les logs en temps réel :**

```bash
tail -f storage/logs/laravel.log
```

#### 11.1.5 DB::enableQueryLog() - Déboguer les requêtes SQL

**Pour voir TOUTES les requêtes SQL exécutées.**

```php
use Illuminate\Support\Facades\DB;

public function index()
{
    // Activer le log des requêtes
    DB::enableQueryLog();
    
    $clients = Client::with('pays', 'secteurActivite')->get();
    
    // Récupérer toutes les requêtes exécutées
    $queries = DB::getQueryLog();
    
    dd($queries);
}
```

**Résultat :**

```php
array:2 [
  0 => array:3 [
    "query" => "select * from "client" where "actif" = ?"
    "bindings" => array:1 [
      0 => true
    ]
    "time" => 2.5
  ]
  1 => array:3 [
    "query" => "select * from "pays" where "id_pays" in (?, ?, ?)"
    "bindings" => array:3 [
      0 => 1
      1 => 2
      2 => 3
    ]
    "time" => 1.2
  ]
]
```

**Astuce :** Le champ `time` indique le temps d'exécution en millisecondes (utile pour identifier les requêtes lentes).

#### 11.1.6 toSql() - Voir la requête SQL générée

**Pour voir la requête SQL SANS l'exécuter.**

```php
$query = Client::where('actif', true)
               ->where('created_at', '>', now()->subMonth())
               ->orderBy('nom_client');

dd($query->toSql());
// Résultat : "select * from "client" where "actif" = ? and "created_at" > ? order by "nom_client" asc"

// Voir aussi les bindings (valeurs des paramètres)
dd($query->getBindings());
// Résultat : [true, "2024-12-15 10:30:00"]
```

#### 11.1.7 Debug dans les vues Blade

**Dans les vues, utilisez `@dump` ou `@dd` :**

```blade
<!-- Afficher le contenu d'une variable dans la vue -->
@dump($clients)

<!-- Afficher et arrêter -->
@dd($clients)

<!-- Afficher plusieurs variables -->
@dump($clients, $chantiers, $factures)
```

---

### 11.2 Erreurs courantes et leurs solutions

**Voici les erreurs que vous rencontrerez le plus souvent.**

#### 11.2.1 ERREUR : "Column not found"

**Message d'erreur :**

```
SQLSTATE[42703]: Undefined column: 7 ERROR:  column "id" does not exist
LINE 1: select * from "client" where "id" = $1 limit 1
```

**Cause :** Vous essayez d'accéder à une colonne qui n'existe pas ou le nom de la clé primaire est incorrect.

**Solution :**

```php
// PROBLÈME : Laravel cherche la colonne 'id' par défaut
Client::find(1);

// SOLUTION : Spécifier la clé primaire dans le modèle
class Client extends Model
{
    protected $primaryKey = 'id_client';  // ← Ajouter cette ligne
}
```

**Vérifier la structure de la table :**

```bash
php artisan tinker
>>> DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = 'client'");
```

#### 11.2.2 ERREUR : "Mass assignment exception"

**Message d'erreur :**

```
Illuminate\Database\Eloquent\MassAssignmentException: Add [nom_client] to fillable property to allow mass assignment on [App\Models\Client].
```

**Cause :** Vous essayez de créer/modifier un enregistrement avec des champs non autorisés.

**Solution :**

```php
// PROBLÈME : Les champs ne sont pas dans $fillable
Client::create([
    'nom_client' => 'Test',
    'code_client' => 'CLI001',
]);

// SOLUTION : Ajouter les champs dans $fillable
class Client extends Model
{
    protected $fillable = [
        'nom_client',
        'code_client',
        'id_pays',
        'id_secteur_activite',
        // ... tous les champs assignables
    ];
}
```

**Alternative : Utiliser `$guarded` :**

```php
// Protéger uniquement certains champs
protected $guarded = ['id_client', 'created_at', 'updated_at'];
```

#### 11.2.3 ERREUR : "Class not found"

**Message d'erreur :**

```
Class 'App\Models\Client' not found
```

**Causes possibles et solutions :**

**1. Namespace incorrect**

```php
// PROBLÈME
use App\Client;  // Ancien namespace Laravel < 8

// SOLUTION
use App\Models\Client;  // Nouveau namespace Laravel 11
```

**2. Fichier mal nommé ou mal placé**

Vérifier que :
- Le fichier existe : `app/Models/Client.php`
- Le namespace dans le fichier est correct : `namespace App\Models;`
- La classe est déclarée : `class Client extends Model`

**3. Autoload non à jour**

```bash
composer dump-autoload
```

#### 11.2.4 ERREUR : "Trying to get property of non-object"

**Message d'erreur :**

```
ErrorException: Trying to get property 'nom_client' of non-object
```

**Cause :** Vous essayez d'accéder à une propriété d'un objet null.

**Solution :**

```php
// PROBLÈME : $client peut être null
$client = Client::find($id);
echo $client->nom_client;  // Erreur si $client est null

// SOLUTION 1 : Vérifier si l'objet existe
$client = Client::find($id);
if ($client) {
    echo $client->nom_client;
} else {
    echo "Client introuvable";
}

// SOLUTION 2 : Utiliser findOrFail (lance une exception 404)
$client = Client::findOrFail($id);
echo $client->nom_client;

// SOLUTION 3 : Utiliser l'opérateur null-safe (?->)
$client = Client::find($id);
echo $client?->nom_client ?? 'N/A';

// SOLUTION 4 : Dans Blade, utiliser ?? ou @if
{{ $client->nom_client ?? 'N/A' }}

@if($client)
    {{ $client->nom_client }}
@endif
```

#### 11.2.5 ERREUR : "Route not defined"

**Message d'erreur :**

```
Route [client.show] not defined.
```

**Cause :** Vous essayez de générer une URL pour une route qui n'existe pas.

**Solution :**

```php
// PROBLÈME : La route n'existe pas
<a href="{{ route('client.show', $client->id_client) }}">Voir</a>

// SOLUTION 1 : Vérifier que la route existe
php artisan route:list --name=client

// SOLUTION 2 : Ajouter la route dans web.php
Route::get('/client/{id_client}', [ClientController::class, 'show'])->name('client.show');

// SOLUTION 3 : Utiliser le bon nom de route
<a href="{{ route('detailsClients', $client->id_client) }}">Voir</a>
```

#### 11.2.6 ERREUR : "CSRF token mismatch"

**Message d'erreur :**

```
419 | Page Expired
```

**Cause :** Le token CSRF est manquant ou invalide.

**Solution :**

```blade
<!-- PROBLÈME : Pas de token CSRF -->
<form action="/client" method="POST">
    <input type="text" name="nom_client">
    <button>Créer</button>
</form>

<!-- SOLUTION : Ajouter @csrf -->
<form action="/client" method="POST">
    @csrf
    <input type="text" name="nom_client">
    <button>Créer</button>
</form>
```

**Pour les requêtes AJAX :**

```javascript
$.ajax({
    url: '/client',
    type: 'POST',
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        nom_client: 'Test'
    },
    success: function(response) {
        console.log(response);
    }
});
```

#### 11.2.7 ERREUR : "Method not allowed"

**Message d'erreur :**

```
405 | Method Not Allowed
```

**Cause :** La méthode HTTP utilisée ne correspond pas à la route.

**Solution :**

```php
// PROBLÈME : Route définie en GET mais formulaire en POST
Route::get('/client', [ClientController::class, 'store']);

<form action="/client" method="POST">  // ← Méthode POST
    @csrf
    ...
</form>

// SOLUTION : Utiliser la bonne méthode
Route::post('/client', [ClientController::class, 'store']);
```

**Pour PUT/DELETE dans les formulaires :**

```blade
<form action="/client/1" method="POST">
    @csrf
    @method('PUT')  <!-- Simule une requête PUT -->
    ...
</form>

<form action="/client/1" method="POST">
    @csrf
    @method('DELETE')  <!-- Simule une requête DELETE -->
    ...
</form>
```

#### 11.2.8 ERREUR : "Too few arguments to function"

**Message d'erreur :**

```
ArgumentCountError: Too few arguments to function App\Http\Controllers\ClientController::show(), 0 passed
```

**Cause :** Vous appelez une méthode sans passer tous les paramètres requis.

**Solution :**

```php
// PROBLÈME : La route ne passe pas le paramètre
Route::get('/client/details', [ClientController::class, 'show']);

public function show($id_client) {  // Attend un paramètre
    // ...
}

// SOLUTION : Ajouter le paramètre dans la route
Route::get('/client/{id_client}/details', [ClientController::class, 'show']);

// OU rendre le paramètre optionnel
public function show($id_client = null) {
    if (!$id_client) {
        return redirect()->back();
    }
    // ...
}
```

#### 11.2.9 ERREUR : "Undefined variable"

**Message d'erreur dans Blade :**

```
ErrorException: Undefined variable: clients
```

**Cause :** Vous essayez d'utiliser une variable dans la vue qui n'a pas été passée depuis le contrôleur.

**Solution :**

```php
// PROBLÈME : Variable non passée à la vue
public function index()
{
    $clients = Client::all();
    return view('client.listClients');  // Oubli de passer $clients
}

// SOLUTION 1 : Utiliser compact()
public function index()
{
    $clients = Client::all();
    return view('client.listClients', compact('clients'));
}

// SOLUTION 2 : Utiliser un tableau
public function index()
{
    $clients = Client::all();
    return view('client.listClients', ['clients' => $clients]);
}

// SOLUTION 3 : Utiliser with()
public function index()
{
    $clients = Client::all();
    return view('client.listClients')->with('clients', $clients);
}
```

**Dans la vue, vérifier si la variable existe :**

```blade
@if(isset($clients))
    @foreach($clients as $client)
        ...
    @endforeach
@else
    <p>Aucun client</p>
@endif
```

#### 11.2.10 ERREUR : "Call to undefined relationship"

**Message d'erreur :**

```
BadMethodCallException: Call to undefined relationship [pays] on model [App\Models\Client].
```

**Cause :** Vous essayez d'accéder à une relation qui n'est pas définie dans le modèle.

**Solution :**

```php
// PROBLÈME : Relation non définie
{{ $client->pays->nom_pays }}

// SOLUTION : Définir la relation dans le modèle Client
class Client extends Model
{
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays', 'id_pays');
    }
}
```

#### 11.2.11 ERREUR : "Foreign key constraint violation"

**Message d'erreur :**

```
SQLSTATE[23503]: Foreign key violation: 7 ERROR:  insert or update on table "chantier" violates foreign key constraint "chantier_id_client_foreign"
DETAIL:  Key (id_client)=(999) is not present in table "client".
```

**Cause :** Vous essayez d'insérer/modifier un enregistrement avec une clé étrangère qui n'existe pas.

**Solution :**

```php
// PROBLÈME : L'id_client n'existe pas
Chantier::create([
    'id_client' => 999,  // Ce client n'existe pas
    // ...
]);

// SOLUTION 1 : Vérifier que le client existe avant
$client = Client::find(999);
if (!$client) {
    return back()->withErrors(['error' => 'Client introuvable']);
}

Chantier::create([
    'id_client' => $client->id_client,
    // ...
]);

// SOLUTION 2 : Utiliser la validation
$validated = $request->validate([
    'id_client' => 'required|exists:client,id_client',  // Vérifie que l'ID existe
]);
```

---

### 11.3 Déboguer les requêtes lentes (problèmes de performance)

**Si votre application est lente, c'est souvent à cause de requêtes SQL inefficaces.**

#### 11.3.1 Identifier les requêtes lentes

**Activer le log des requêtes lentes dans `.env` :**

```env
DB_SLOW_QUERY_LOG=true
DB_SLOW_QUERY_THRESHOLD=100  # En millisecondes
```

**Ou manuellement dans le code :**

```php
DB::listen(function ($query) {
    if ($query->time > 100) {  // Plus de 100ms
        Log::warning('Requête lente détectée', [
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time' => $query->time . 'ms'
        ]);
    }
});
```

#### 11.3.2 Problème N+1 (le plus fréquent)

**C'est l'erreur de performance la plus courante.**

**Exemple du problème :**

```php
// MAUVAIS : Génère 1 + N requêtes SQL
$chantiers = Chantier::all();  // 1 requête

foreach ($chantiers as $chantier) {
    echo $chantier->client->nom_client;  // N requêtes (1 par chantier)
}

// Si vous avez 100 chantiers, cela génère 101 requêtes !
```

**Solution : Utiliser Eager Loading**

```php
// BON : Génère seulement 2 requêtes SQL
$chantiers = Chantier::with('client')->all();  // 2 requêtes (1 pour chantiers, 1 pour clients)

foreach ($chantiers as $chantier) {
    echo $chantier->client->nom_client;  // Pas de nouvelle requête
}
```

**Avec plusieurs relations :**

```php
$factures = Facture::with(['chantier', 'chantier.client', 'tranches'])->get();
```

**Déboguer le N+1 :**

```php
DB::enableQueryLog();

$chantiers = Chantier::all();
foreach ($chantiers as $chantier) {
    echo $chantier->client->nom_client;
}

dd(count(DB::getQueryLog()));  // Si > 2, vous avez un problème N+1
```

#### 11.3.3 Ajouter des index

**Si une colonne est souvent utilisée dans les WHERE ou JOIN, ajoutez un index.**

```php
// Dans une migration
Schema::table('client', function (Blueprint $table) {
    $table->index('code_client');  // Accélère les recherches par code_client
    $table->index(['actif', 'created_at']);  // Index composite
});
```

---

### 11.4 Déboguer les erreurs de validation

**Quand les formulaires ne fonctionnent pas comme prévu.**

#### 11.4.1 Voir toutes les erreurs de validation

**Dans le contrôleur :**

```php
try {
    $validated = $request->validate([
        'nom_client' => 'required|min:3',
        'code_client' => 'required|unique:client,code_client',
    ]);
} catch (\Illuminate\Validation\ValidationException $e) {
    dd($e->errors());  // Affiche toutes les erreurs
}
```

**Dans la vue :**

```blade
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Afficher l'erreur d'un champ spécifique -->
@error('nom_client')
    <span class="text-danger">{{ $message }}</span>
@enderror
```

#### 11.4.2 Déboguer les données reçues

```php
public function store(Request $request)
{
    // Voir TOUTES les données du formulaire
    dd($request->all());
    
    // Voir seulement certains champs
    dd($request->only(['nom_client', 'code_client']));
    
    // Voir si un champ existe
    dd($request->has('nom_client'));
    
    // Voir la valeur d'un champ
    dd($request->input('nom_client'));
    
    // Voir les fichiers uploadés
    dd($request->file('document'));
}
```

---

### 11.5 Déboguer les problèmes de fichiers et permissions

#### 11.5.1 Erreur : "Permission denied"

**Message d'erreur :**

```
file_put_contents(/path/to/storage/logs/laravel.log): failed to open stream: Permission denied
```

**Solution (sur Linux/Mac) :**

```bash
# Donner les permissions d'écriture
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Si nécessaire, changer le propriétaire
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

#### 11.5.2 Erreur : "File does not exist"

**Pour les assets (CSS/JS) :**

```bash
# Vérifier que le fichier existe
ls -la public/assets/css/main.css

# Si Vite est utilisé, compiler les assets
npm run build

# Si les assets sont dans storage, créer le lien symbolique
php artisan storage:link
```

---

### 11.6 Déboguer les problèmes PostgreSQL

#### 11.6.1 Connexion à PostgreSQL échoue

**Message d'erreur :**

```
SQLSTATE[08006] [7] could not connect to server: Connection refused
```

**Solutions :**

```bash
# Vérifier que PostgreSQL est démarré
sudo systemctl status postgresql

# Démarrer PostgreSQL
sudo systemctl start postgresql

# Vérifier le fichier .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nom_base
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe
```

**Tester la connexion :**

```bash
php artisan tinker
>>> DB::connection()->getPdo();
# Si ça fonctionne : affiche l'objet PDO
# Si ça échoue : affiche l'erreur
```

#### 11.6.2 Voir les requêtes PostgreSQL en temps réel

**Dans un terminal séparé :**

```bash
# Se connecter à PostgreSQL
psql -U utilisateur -d nom_base

# Activer le log des requêtes
ALTER DATABASE nom_base SET log_statement = 'all';

# Voir les logs
tail -f /var/log/postgresql/postgresql-*.log
```

---

### 11.7 Outils de débogage avancés

#### 11.7.1 Laravel Telescope (recommandé)

**Telescope est un outil de débogage et de monitoring complet.**

**Installation :**

```bash
composer require laravel/telescope
php artisan telescope:install
php artisan migrate
```

**Accès :**

```
http://localhost:8000/telescope
```

**Fonctionnalités :**
- Voir toutes les requêtes HTTP
- Voir toutes les requêtes SQL
- Voir les jobs et queues
- Voir les emails envoyés
- Voir les exceptions
- Voir les logs
- Profiler les performances

#### 11.7.2 Laravel Debugbar

**Une barre de débogage en bas de page.**

**Installation :**

```bash
composer require barryvdh/laravel-debugbar --dev
```

**Fonctionnalités :**
- Nombre de requêtes SQL
- Temps d'exécution
- Utilisation de la mémoire
- Vues chargées
- Routes
- Session

#### 11.7.3 Tinker (REPL Laravel)

**Tester du code PHP interactif.**

```bash
php artisan tinker
```

**Exemples d'utilisation :**

```php
>>> $client = App\Models\Client::find(1);
>>> $client->nom_client;
=> "Entreprise X"

>>> $client->chantiers;
=> Collection { ... }

>>> App\Models\Client::count();
=> 150

>>> DB::table('client')->where('actif', true)->count();
=> 142

>>> cache()->put('test', 'valeur', 60);
>>> cache()->get('test');
=> "valeur"
```

---

### 11.8 Checklist de débogage

**Quand quelque chose ne fonctionne pas, suivez cette checklist :**

#### 11.8.1 Problème : La page est blanche

- [ ] Vérifier les logs : `tail -f storage/logs/laravel.log`
- [ ] Activer le mode debug : `APP_DEBUG=true` dans `.env`
- [ ] Vider les caches : `php artisan cache:clear && php artisan config:clear`
- [ ] Vérifier les permissions : `chmod -R 775 storage`

#### 11.8.2 Problème : Les données ne s'affichent pas

- [ ] Déboguer la variable : `dd($variable);`
- [ ] Vérifier que la variable est passée à la vue : `compact('variable')`
- [ ] Vérifier la requête SQL : `DB::enableQueryLog(); ... dd(DB::getQueryLog());`
- [ ] Vérifier les relations : `dd($model->relation);`

#### 11.8.3 Problème : Le formulaire ne fonctionne pas

- [ ] Vérifier le token CSRF : `@csrf`
- [ ] Vérifier la méthode HTTP : `method="POST"` et `@method('PUT')` si nécessaire
- [ ] Vérifier l'action du formulaire : `action="{{ route('...') }}"`
- [ ] Déboguer les données reçues : `dd($request->all());`
- [ ] Vérifier la validation : `dd($errors->all());`

#### 11.8.4 Problème : La route ne fonctionne pas

- [ ] Vérifier que la route existe : `php artisan route:list`
- [ ] Vérifier le nom de la route : `route('nom.route')`
- [ ] Vérifier les paramètres : `route('nom.route', ['id' => 1])`
- [ ] Vérifier le middleware : Authentification requise ?
- [ ] Vider le cache des routes : `php artisan route:clear`

#### 11.8.5 Problème : Erreur 500

- [ ] Voir les logs : `tail -f storage/logs/laravel.log`
- [ ] Activer le mode debug : `APP_DEBUG=true`
- [ ] Vérifier les permissions
- [ ] Vérifier la connexion à la base de données
- [ ] Exécuter les migrations : `php artisan migrate:status`

---

### 11.9 Messages d'erreur PostgreSQL courants

- **Erreur** : `relation "table" does not exist` - Signification : Table inexistante - Solution : Exécuter `php artisan migrate`
- **Erreur** : `column "colonne" does not exist` - Signification : Colonne inexistante - Solution : Vérifier le nom de la colonne ou créer une migration
- **Erreur** : `duplicate key value violates unique constraint` - Signification : Valeur en double sur champ unique - Solution : Utiliser une autre valeur ou modifier la contrainte
- **Erreur** : `null value in column violates not-null constraint` - Signification : Valeur NULL non autorisée - Solution : Fournir une valeur ou rendre la colonne nullable
- **Erreur** : `foreign key constraint violation` - Signification : Clé étrangère invalide - Solution : Vérifier que l'enregistrement parent existe
- **Erreur** : `syntax error at or near` - Signification : Erreur de syntaxe SQL - Solution : Vérifier la requête SQL générée


---

### 11.10 Commandes utiles pour le débogage

```bash
# Voir les logs en temps réel
tail -f storage/logs/laravel.log

# Vider tous les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Recompiler les classes
composer dump-autoload

# Voir l'état des migrations
php artisan migrate:status

# Voir toutes les routes
php artisan route:list

# Voir la configuration actuelle
php artisan config:show database

# Tester la connexion à la base de données
php artisan tinker
>>> DB::connection()->getPdo();

# Voir les tables en base de données
php artisan db:show
php artisan db:table nom_table

# Mode maintenance (désactiver temporairement l'application)
php artisan down
php artisan up
```

---

### 11.11 Résumé : Comment déboguer efficacement

**1. Identifier le problème :**
- Lire attentivement le message d'erreur
- Noter la ligne de code exacte
- Identifier le type d'erreur (SQL, PHP, Blade, etc.)

**2. Isoler le problème :**
- Utiliser `dd()` pour vérifier les valeurs
- Commenter des parties du code
- Tester avec des données simples

**3. Comprendre le problème :**
- Lire les logs
- Activer le query log
- Utiliser Telescope ou Debugbar

**4. Résoudre le problème :**
- Corriger le code
- Tester la solution
- Vérifier qu'il n'y a pas d'effets de bord

**5. Prévenir le problème :**
- Ajouter des validations
- Ajouter des tests
- Documenter la solution

**Règle d'or du débogage : "Quand vous ne savez pas ce qui se passe, utilisez dd() partout jusqu'à trouver où ça casse."**

**Dans la prochaine et dernière section, nous verrons comment DÉPLOYER l'application en production.**


---

## 12. DÉPLOIEMENT EN PRODUCTION

Cette section explique comment déployer et maintenir l'application en production.

**Note :** Ce projet est actuellement déployé sur Render : https://factures-mazars-app.onrender.com/

### 12.1 Déploiement sur Render

**Render est une plateforme cloud moderne qui facilite le déploiement d'applications web.**

#### 12.1.1 Architecture sur Render

**Le projet est composé de plusieurs services :**

1. **Web Service** : Application Laravel (PHP)
2. **Base de données PostgreSQL** : Base de données hébergée sur Render
3. **Disk storage** : Stockage persistant pour les fichiers uploadés

#### 12.1.2 Configuration du Web Service

**Le fichier clé pour Render est `render.yaml` (s'il existe) ou la configuration dans le dashboard Render.**

**Configuration typique pour Laravel sur Render :**

**Build Command :**
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Explication :**
- `composer install --no-dev` : Installe uniquement les dépendances de production (sans dev)
- `--optimize-autoloader` : Optimise l'autoloader pour de meilleures performances
- `php artisan config:cache` : Met en cache la configuration
- `php artisan route:cache` : Met en cache les routes
- `php artisan view:cache` : Met en cache les vues Blade

**Start Command :**
```bash
php artisan migrate --force && php artisan storage:link && php -S 0.0.0.0:${PORT:-8000} -t public
```

**OU avec un serveur plus robuste (recommandé) :**
```bash
php artisan migrate --force && php artisan storage:link && vendor/bin/heroku-php-apache2 public/
```

**Explication :**
- `php artisan migrate --force` : Exécute les migrations (--force en production)
- `php artisan storage:link` : Crée le lien symbolique pour le stockage
- `php -S` ou `heroku-php-apache2` : Démarre le serveur web

#### 12.1.3 Variables d'environnement sur Render

**Dans le dashboard Render, configurer ces variables d'environnement :**

```env
# Application
APP_NAME="Factures Mazars"
APP_ENV=production
APP_KEY=base64:votre_cle_generee_ici
APP_DEBUG=false
APP_URL=https://factures-mazars-app.onrender.com

# Base de données (automatique si PostgreSQL Render)
DATABASE_URL=postgresql://user:password@host:5432/database

# OU en détail
DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxx.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=nom_base
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe_securise

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Queue (si utilisée)
QUEUE_CONNECTION=database

# Mail (pour notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=mot_de_passe_application
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@factures-mazars.com
MAIL_FROM_NAME="${APP_NAME}"

# Logs
LOG_CHANNEL=stack
LOG_LEVEL=error  # En production, logger uniquement les erreurs

# Sécurité
BCRYPT_ROUNDS=12
```

**IMPORTANT : Ne JAMAIS commiter le fichier `.env` dans Git !**

#### 12.1.4 Générer la clé d'application

**La clé `APP_KEY` est CRITIQUE pour la sécurité.**

```bash
# Localement, générer une nouvelle clé
php artisan key:generate --show

# Résultat (exemple)
base64:jZ9qE3X2mK8vL5wN7pR4tU6yH9gF2dS1aQ8wE5rT3yU=

# Copier cette valeur dans Render (variable APP_KEY)
```

**⚠️ Ne changez JAMAIS la clé en production si vous avez déjà des données chiffrées (sessions, mots de passe, etc.).**

#### 12.1.5 Configuration PostgreSQL sur Render

**Si vous utilisez une base de données PostgreSQL managée par Render :**

1. **Créer le service PostgreSQL** dans le dashboard Render
2. **Render fournit automatiquement** :
   - `DATABASE_URL` (connexion complète)
   - Host, Port, Database, Username, Password

3. **Dans votre application, Laravel peut utiliser directement `DATABASE_URL` :**

```php
// config/database.php (déjà configuré par défaut)
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    // ...
]
```

#### 12.1.6 Stockage persistant sur Render

**⚠️ IMPORTANT : Les Web Services Render ont un système de fichiers éphémère.**

**Problème :** Les fichiers uploadés dans `storage/app/public/` seront SUPPRIMÉS à chaque redémarrage.

**Solutions :**

**Option 1 : Utiliser un Disk Persistant Render**

Dans le dashboard Render :
- Ajouter un "Persistent Disk"
- Monter le disk sur `/var/data`
- Configurer Laravel pour stocker les fichiers là :

```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => env('RENDER_DISK_PATH', storage_path('app/public')),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

```env
# Dans Render
RENDER_DISK_PATH=/var/data/storage
```

**Option 2 : Utiliser un service de stockage cloud (recommandé)**

**Amazon S3, DigitalOcean Spaces, ou Cloudinary.**

```bash
composer require league/flysystem-aws-s3-v3
```

```php
// config/filesystems.php
's3' => [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION'),
    'bucket' => env('AWS_BUCKET'),
    'url' => env('AWS_URL'),
],
```

```env
# Dans Render
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=votre_cle
AWS_SECRET_ACCESS_KEY=votre_secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=factures-mazars
```

---

### 12.2 Optimisations pour la production

**Avant de déployer, optimiser l'application pour de meilleures performances.**

#### 12.2.1 Mettre en cache les configurations

```bash
# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues Blade
php artisan view:cache

# Optimiser l'autoloader Composer
composer install --optimize-autoloader --no-dev
```

**⚠️ ATTENTION :** Après `config:cache`, le fichier `.env` n'est plus lu. Toutes les modifications de configuration nécessitent de refaire le cache.

**Pour annuler les caches (en développement) :**

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### 12.2.2 Activer le mode production dans `.env`

```env
APP_ENV=production
APP_DEBUG=false  # TRÈS IMPORTANT : ne JAMAIS mettre true en production
```

**Pourquoi `APP_DEBUG=false` est critique :**
- Évite de révéler des informations sensibles (chemins de fichiers, variables d'environnement, requêtes SQL)
- Améliore les performances
- Affiche des pages d'erreur génériques aux utilisateurs

#### 12.2.3 Optimiser les requêtes SQL

**Utiliser le Eager Loading partout :**

```php
// MAUVAIS (N+1)
$chantiers = Chantier::all();
foreach ($chantiers as $chantier) {
    echo $chantier->client->nom_client;
}

// BON
$chantiers = Chantier::with('client')->all();
foreach ($chantiers as $chantier) {
    echo $chantier->client->nom_client;
}
```

**Utiliser select() pour limiter les colonnes :**

```php
// MAUVAIS : Récupère toutes les colonnes
$clients = Client::all();

// BON : Récupère seulement les colonnes nécessaires
$clients = Client::select('id_client', 'nom_client', 'code_client')->get();
```

**Utiliser chunk() pour les grandes collections :**

```php
// MAUVAIS : Charge 100 000 enregistrements en mémoire
$clients = Client::all();

// BON : Traite par lots de 100
Client::chunk(100, function ($clients) {
    foreach ($clients as $client) {
        // Traitement
    }
});
```

#### 12.2.4 Activer la compression Gzip

**Dans `public/.htaccess` (si Apache) :**

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

#### 12.2.5 Optimiser les assets

**Minifier CSS et JavaScript :**

```bash
# Avec Vite (déjà configuré dans Laravel 11)
npm run build

# Résultat : Fichiers minifiés dans public/build/
```

---

### 12.3 Sécurité en production

**La sécurité est CRITIQUE en production.**

#### 12.3.1 Checklist de sécurité

- [x] **APP_DEBUG=false** : Ne jamais afficher les erreurs détaillées
- [x] **HTTPS activé** : Render fournit automatiquement un certificat SSL
- [x] **APP_KEY généré** : Clé unique et sécurisée
- [x] **Mots de passe forts** : Pour la base de données, email, etc.
- [x] **Validation stricte** : Valider toutes les entrées utilisateur
- [x] **CSRF protection** : `@csrf` dans tous les formulaires
- [x] **SQL injection protection** : Utiliser Eloquent ou requêtes préparées
- [x] **XSS protection** : Utiliser `{{ }}` dans Blade (pas `{!! !!}`)
- [x] **Permissions fichiers** : 755 pour dossiers, 644 pour fichiers
- [x] **Cacher les fichiers sensibles** : `.env`, `composer.json`, etc.

#### 12.3.2 Forcer HTTPS

**Dans `app/Providers/AppServiceProvider.php` :**

```php
use Illuminate\Support\Facades\URL;

public function boot()
{
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
}
```

#### 12.3.3 Protéger les routes sensibles

**Middleware d'authentification :**

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Toutes les routes protégées
});
```

**Middleware de rôle :**

```php
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('client', ClientController::class);
    // Routes réservées aux admins
});
```

#### 12.3.4 Limiter les tentatives de connexion

**Laravel a un rate limiting intégré :**

```php
// Dans routes/web.php
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');  // 5 tentatives par minute
```

#### 12.3.5 Mettre à jour régulièrement

```bash
# Vérifier les mises à jour de sécurité
composer outdated

# Mettre à jour les dépendances
composer update

# Vérifier les vulnérabilités connues
composer audit
```

---

### 12.4 Monitoring et logs en production

**Surveiller l'application pour détecter les problèmes rapidement.**

#### 12.4.1 Logs sur Render

**Voir les logs en temps réel dans le dashboard Render :**

1. Aller sur votre service web
2. Cliquer sur "Logs"
3. Voir les logs en direct

**Ou via CLI :**

```bash
render logs --service votre-service-id --tail
```

#### 12.4.2 Configuration des logs Laravel

**Dans `.env` :**

```env
LOG_CHANNEL=stack
LOG_LEVEL=error  # En production, uniquement les erreurs
```

**Dans `config/logging.php`, configurer les canaux :**

```php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['daily', 'slack'],  // Logs dans fichier + Slack
        'ignore_exceptions' => false,
    ],

    'daily' => [
        'driver' => 'daily',
        'path' => storage_path('logs/laravel.log'),
        'level' => env('LOG_LEVEL', 'error'),
        'days' => 14,  // Garder les logs 14 jours
    ],

    // Envoyer les erreurs critiques sur Slack
    'slack' => [
        'driver' => 'slack',
        'url' => env('LOG_SLACK_WEBHOOK_URL'),
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => env('LOG_LEVEL', 'critical'),
    ],
],
```

#### 12.4.3 Monitoring avec des services externes

**Services recommandés :**

1. **Sentry** : Suivi des erreurs en temps réel

```bash
composer require sentry/sentry-laravel
php artisan sentry:publish --dsn=your-dsn
```

```env
SENTRY_LARAVEL_DSN=https://xxx@sentry.io/xxx
```

2. **New Relic** : Performance monitoring

3. **Bugsnag** : Error tracking

4. **Laravel Pulse** : Monitoring Laravel natif (Laravel 10+)

```bash
composer require laravel/pulse
php artisan pulse:install
php artisan migrate
```

Accès : `https://votre-app.com/pulse`

#### 12.4.4 Health checks

**Créer un endpoint de santé pour vérifier que l'app fonctionne :**

```php
// routes/web.php
Route::get('/health', function () {
    try {
        // Vérifier la connexion à la base de données
        DB::connection()->getPdo();
        
        return response()->json([
            'status' => 'healthy',
            'database' => 'connected',
            'timestamp' => now()
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'unhealthy',
            'error' => 'Database connection failed',
            'timestamp' => now()
        ], 500);
    }
});
```

**Configurer Render pour vérifier cet endpoint :**

Dans le dashboard Render :
- Health Check Path : `/health`

---

### 12.5 Backups (sauvegardes)

**LES BACKUPS SONT CRITIQUES. Ne jamais déployer en production sans stratégie de backup.**

#### 12.5.1 Backup de la base de données PostgreSQL

**Option 1 : Backups automatiques Render**

Render fait des backups automatiques de votre base de données PostgreSQL :
- Backups quotidiens automatiques
- Rétention de 7 jours (gratuit) ou plus (payant)
- Restauration via le dashboard

**Option 2 : Script de backup manuel**

```bash
#!/bin/bash
# backup.sh

# Variables
DB_HOST="dpg-xxxxx.oregon-postgres.render.com"
DB_PORT="5432"
DB_NAME="nom_base"
DB_USER="utilisateur"
DATE=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/var/backups/postgres"
BACKUP_FILE="$BACKUP_DIR/backup_$DATE.sql"

# Créer le dossier de backup
mkdir -p $BACKUP_DIR

# Faire le backup
PGPASSWORD="$DB_PASSWORD" pg_dump -h $DB_HOST -p $DB_PORT -U $DB_USER $DB_NAME > $BACKUP_FILE

# Compresser
gzip $BACKUP_FILE

# Garder seulement les 30 derniers backups
ls -t $BACKUP_DIR/backup_*.sql.gz | tail -n +31 | xargs rm -f

echo "Backup créé : $BACKUP_FILE.gz"
```

**Automatiser avec cron :**

```bash
# Éditer crontab
crontab -e

# Ajouter : Backup quotidien à 2h du matin
0 2 * * * /path/to/backup.sh >> /var/log/backup.log 2>&1
```

#### 12.5.2 Backup des fichiers uploadés

**Si vous utilisez un disk persistant Render :**

```bash
#!/bin/bash
# backup_files.sh

SOURCE="/var/data/storage"
DEST="s3://votre-bucket/backups/$(date +%Y%m%d)"

# Synchroniser avec S3
aws s3 sync $SOURCE $DEST --delete

echo "Files backed up to $DEST"
```

#### 12.5.3 Restaurer un backup

**Restaurer la base de données :**

```bash
# Télécharger le backup
scp backup_20240115.sql.gz server:/tmp/

# Décompresser
gunzip /tmp/backup_20240115.sql.gz

# Restaurer (ATTENTION : écrase les données existantes)
PGPASSWORD="$DB_PASSWORD" psql -h $DB_HOST -p $DB_PORT -U $DB_USER $DB_NAME < /tmp/backup_20240115.sql
```

---

### 12.6 Déploiement avec Git

**Workflow de déploiement recommandé.**

#### 12.6.1 Branches Git

```
main (production)
  ↑
develop (staging/pré-production)
  ↑
feature/* (fonctionnalités en développement)
```

#### 12.6.2 Déployer sur Render

**Render se déploie automatiquement depuis Git :**

1. **Connecter le repository GitHub/GitLab** dans le dashboard Render
2. **Configurer la branche** à déployer (ex: `main`)
3. **Render redéploie automatiquement** à chaque push sur cette branche

**Déploiement manuel :**

Dans le dashboard Render :
- Cliquer sur "Manual Deploy"
- Choisir la branche ou le commit

#### 12.6.3 Workflow de déploiement

```bash
# 1. Développement local sur une branche feature
git checkout -b feature/nouvelle-fonctionnalite
# ... développement ...
git add .
git commit -m "Ajout de la nouvelle fonctionnalité"

# 2. Fusionner dans develop (staging)
git checkout develop
git merge feature/nouvelle-fonctionnalite
git push origin develop

# Render déploie automatiquement sur l'environnement de staging

# 3. Tester sur staging
# Ouvrir https://staging-factures-mazars.onrender.com

# 4. Si tout fonctionne, fusionner dans main (production)
git checkout main
git merge develop
git push origin main

# Render déploie automatiquement en production
```

---

### 12.7 Variables d'environnement par environnement

**Avoir des configurations différentes pour dev, staging, production.**

**Développement (.env.local) :**
```env
APP_ENV=local
APP_DEBUG=true
DB_DATABASE=factures_dev
LOG_LEVEL=debug
```

**Staging (.env.staging - sur Render) :**
```env
APP_ENV=staging
APP_DEBUG=true  # Peut rester true pour debugging
APP_URL=https://staging-factures-mazars.onrender.com
DB_DATABASE=factures_staging
LOG_LEVEL=debug
```

**Production (.env.production - sur Render) :**
```env
APP_ENV=production
APP_DEBUG=false  # TOUJOURS false
APP_URL=https://factures-mazars-app.onrender.com
DB_DATABASE=factures_production
LOG_LEVEL=error
```

---

### 12.8 Maintenance et mises à jour

#### 12.8.1 Mettre l'application en mode maintenance

**Avant une mise à jour importante :**

```bash
# Activer le mode maintenance
php artisan down

# Avec un message personnalisé
php artisan down --message="Maintenance en cours, retour dans 10 minutes"

# Avec une page HTML personnalisée
php artisan down --render="errors::503"

# Permettre l'accès à certaines IPs
php artisan down --allow=123.45.67.89 --allow=98.76.54.32
```

**Désactiver le mode maintenance :**

```bash
php artisan up
```

#### 12.8.2 Exécuter les migrations en production

```bash
# TOUJOURS faire un backup avant !

# Voir les migrations en attente
php artisan migrate:status

# Exécuter les migrations
php artisan migrate --force

# Si problème, rollback
php artisan migrate:rollback --force
```

#### 12.8.3 Zero-downtime deployment

**Pour éviter les interruptions :**

1. **Utiliser les blue-green deployments** (Render le fait automatiquement)
2. **Les migrations doivent être rétro-compatibles** :
   - D'abord ajouter la nouvelle colonne (nullable)
   - Déployer le code qui utilise l'ancienne ET la nouvelle colonne
   - Migrer les données
   - Supprimer l'ancienne colonne dans un déploiement ultérieur

**Exemple de migration compatible :**

```php
// Migration 1 : Ajouter la nouvelle colonne (nullable)
Schema::table('client', function (Blueprint $table) {
    $table->string('nouveau_champ')->nullable();
});

// Code : Gérer l'ancienne ET la nouvelle colonne

// Migration 2 (plus tard) : Supprimer l'ancienne colonne
Schema::table('client', function (Blueprint $table) {
    $table->dropColumn('ancien_champ');
});
```

---

### 12.9 Performance en production

#### 12.9.1 Utiliser un cache Redis ou Memcached

**Installer Redis sur Render :**

1. Ajouter un service Redis dans le dashboard
2. Configurer Laravel :

```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=redis-xxxxx.oregon-redis.render.com
REDIS_PASSWORD=votre_password
REDIS_PORT=6379
```

```bash
composer require predis/predis
```

#### 12.9.2 Utiliser une queue pour les tâches longues

**Déporter les tâches longues (emails, exports, etc.) :**

```bash
# Configurer la queue
composer require laravel/horizon  # Pour Redis

php artisan horizon:install
```

```env
QUEUE_CONNECTION=redis
```

**Créer un job :**

```bash
php artisan make:job SendFactureEmail
```

```php
// app/Jobs/SendFactureEmail.php
public function handle()
{
    Mail::to($this->user)->send(new FactureMail($this->facture));
}
```

**Dispatcher le job :**

```php
SendFactureEmail::dispatch($user, $facture);
```

**Sur Render, créer un worker :**

- Type : Background Worker
- Command : `php artisan queue:work --tries=3`

---

### 12.10 Troubleshooting en production

#### 12.10.1 Application lente

**Diagnostic :**

```bash
# Voir les requêtes lentes dans les logs
grep "Slow query" storage/logs/laravel.log

# Activer le query log temporairement
DB::enableQueryLog();
// ... code
dd(DB::getQueryLog());
```

**Solutions :**
- Ajouter des index sur les colonnes fréquemment utilisées
- Utiliser Eager Loading (with())
- Utiliser le cache Redis
- Optimiser les requêtes SQL

#### 12.10.2 Erreurs 500 aléatoires

**Diagnostic :**

```bash
# Voir les logs Render
render logs --service votre-service --tail

# Ou dans le dashboard Render > Logs
```

**Causes courantes :**
- Mémoire insuffisante → Augmenter la RAM du plan Render
- Timeout → Augmenter le timeout ou optimiser le code
- Connexion base de données perdue → Utiliser `DB::reconnect()`

#### 12.10.3 Fichiers uploadés disparus

**Cause :** Système de fichiers éphémère sur Render.

**Solution :** Utiliser un Persistent Disk ou S3 (voir section 12.1.6).

---

### 12.11 Checklist de déploiement

**Avant chaque déploiement en production, vérifier :**

- [ ] **Tests passent** : `php artisan test`
- [ ] **Backup de la base de données** effectué
- [ ] **Variables d'environnement** correctes sur Render
- [ ] **APP_DEBUG=false** en production
- [ ] **APP_KEY** généré et configuré
- [ ] **Migrations testées** sur staging
- [ ] **Caches vidés** si nécessaire
- [ ] **Assets compilés** : `npm run build`
- [ ] **Dépendances à jour** : `composer install --no-dev`
- [ ] **Logs configurés** : LOG_LEVEL=error
- [ ] **Health check** fonctionne : `/health`
- [ ] **Monitoring actif** (Sentry, etc.)
- [ ] **Plan de rollback** préparé

**Après déploiement :**

- [ ] **Vérifier l'application** fonctionne
- [ ] **Tester les fonctionnalités critiques** (login, création client, facture)
- [ ] **Vérifier les logs** pour les erreurs
- [ ] **Tester sur plusieurs navigateurs**
- [ ] **Vérifier les performances** (temps de chargement)

---

### 12.12 Commandes utiles pour Render

```bash
# Installer le CLI Render
npm install -g @render-com/cli

# Se connecter
render login

# Lister les services
render services list

# Voir les logs
render logs --service votre-service-id --tail

# Déployer manuellement
render deploy --service votre-service-id

# Voir les variables d'environnement
render env list --service votre-service-id

# Ajouter une variable
render env set --service votre-service-id KEY=value

# Redémarrer le service
render restart --service votre-service-id
```

---

### 12.13 Ressources et documentation

**Laravel :**
- Documentation officielle : https://laravel.com/docs
- Laracasts (vidéos) : https://laracasts.com
- Laravel News : https://laravel-news.com

**Render :**
- Documentation : https://render.com/docs
- Guide Laravel : https://render.com/docs/deploy-laravel
- Status page : https://status.render.com

**PostgreSQL :**
- Documentation : https://www.postgresql.org/docs/
- Performance tuning : https://wiki.postgresql.org/wiki/Performance_Optimization

**Sécurité :**
- OWASP Top 10 : https://owasp.org/www-project-top-ten/
- Laravel Security : https://laravel.com/docs/11.x/security

---

### 12.14 Conclusion

**Vous avez maintenant toutes les clés pour maintenir et faire évoluer cette application.**

**Points clés à retenir :**

1. ✅ **Toujours sauvegarder** avant toute modification majeure
2. ✅ **Tester sur staging** avant de déployer en production
3. ✅ **Monitorer activement** les logs et les performances
4. ✅ **Mettre à jour régulièrement** les dépendances pour la sécurité
5. ✅ **Documenter** tous les changements importants
6. ✅ **APP_DEBUG=false** en production (TOUJOURS)
7. ✅ **Utiliser des caches** pour optimiser les performances
8. ✅ **Prévoir un plan de rollback** en cas de problème

**En cas de problème critique en production :**

1. 🔴 **Activer le mode maintenance** : `php artisan down`
2. 🔍 **Consulter les logs** : Dashboard Render > Logs
3. 🔄 **Rollback si nécessaire** : Déployer le dernier commit stable
4. 💾 **Restaurer le backup** si problème de données
5. ✅ **Corriger le bug** sur une branche de hotfix
6. 🚀 **Redéployer** après tests
7. 🟢 **Désactiver la maintenance** : `php artisan up`

**Félicitations ! Vous avez terminé ce guide technique complet. Vous êtes maintenant capable de comprendre, maintenir et faire évoluer cette application Laravel de gestion de factures.**

**Bon développement ! 🚀**

---

## FIN DU GUIDE TECHNIQUE

**Document créé pour le projet Factures Mazars**  
**Application Laravel 11 - PostgreSQL - Render**  
**URL Production :** https://factures-mazars-app.onrender.com/

