# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Vue d'ensemble du projet

Application Laravel 11 de gestion de factures, clients et chantiers. Système de facturation en français construit avec PHP 8.2+, Laravel et Vite.

## Modèle de domaine principal

Structure hiérarchique :

**Client → Chantier → Facture → TrancheFacture → Encaissement**

Relations clés :
- Chaque Client peut avoir plusieurs Chantiers
- Chaque Chantier appartient à un Client et possède Budget, Equipe et GetDate associés
- Chaque Chantier peut avoir plusieurs Factures
- Chaque Facture peut avoir plusieurs TrancheFactures (tranches)
- Chaque TrancheFacture peut avoir plusieurs Encaissements
- Les Factures sont liées aux Budgets via une table pivot (facture_budget)

L'application gère :
- Le statut des factures (non payé/partiel/totalement payé)
- L'encaissement des paiements (chèque, virement, etc.)
- Les budgets et équipes des chantiers
- Les types et sous-types de mission
- Le support multi-devises
- Les zones géographiques et secteurs d'activité

## Commandes de développement

### Installation
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### Exécution de l'application
```bash
# Démarrer le serveur Laravel
php artisan serve

# Compiler les assets frontend (développement)
npm run dev

# Builder les assets frontend (production)
npm run build
```

### Tests
```bash
# Exécuter tous les tests
php artisan test

# Ou avec PHPUnit directement
./vendor/bin/phpunit

# Exécuter une suite spécifique
./vendor/bin/phpunit --testsuite Unit
./vendor/bin/phpunit --testsuite Feature
```

### Qualité du code
```bash
# Formatter le code avec Laravel Pint
./vendor/bin/pint

# Vérifier des fichiers spécifiques
./vendor/bin/pint path/to/file.php
```

### Base de données
```bash
# Exécuter les migrations
php artisan migrate

# Rollback des migrations
php artisan migrate:rollback

# Migration fraîche (supprime et recrée toutes les tables)
php artisan migrate:fresh

# Peupler la base de données
php artisan db:seed
```

### Commandes Artisan utiles
```bash
# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Lister toutes les routes
php artisan route:list

# Créer un nouveau modèle avec migration, factory et controller
php artisan make:model ModelName -mfc

# Créer un nouveau controller
php artisan make:controller ControllerName

# Tinker (REPL)
php artisan tinker
```

## Notes d'architecture

### Contrôleurs
Organisation par entités métier (Client, Chantier, Facture, TrancheFacture, Encaissement, etc.). Pattern CRUD standard.

Contrôleurs importants :
- **DashboardController** : Graphiques et données du tableau de bord
- **RapportController** : Fonctionnalités de reporting (baromètre, clôture, vérification)
- **ImportController** : Import Excel pour chargement de données en masse
- **AuthController** : Authentification avec système de vérification par email
- **ConsultantController** : Vues séparées pour le rôle consultant
- **ChoixBanqueController** : Gestion des banques et choix pour facturation

### Modèles
Utilise Eloquent ORM avec clés primaires personnalisées (ex: `id_client`, `id_chantier`) au lieu de `id`.

Modèles importants :
- **Client** : Gestion clients avec données géographiques et sectorielles
- **Chantier** : Suivi de projets/missions avec types, dates, budgets
- **Facture** : Factures avec logique de statut (`updateFactureStatus`)
- **TrancheFacture** : Tranches de facturation avec suivi paiements
- **Encaissement** : Enregistrements de paiement avec détails banque/chèque
- **Budget** : Allocations budgétaires par chantier
- **User/Users** : Deux modèles utilisateur (User pour auth, Users pour table custom)

### Vues
Templates Blade organisés par domaine sous `resources/views/`. Composants layout :
- `layouts/app.blade.php` : Layout principal
- `layouts/navbar.blade.php` et `layouts/sidebar.blade.php` : Navigation standard
- `layouts/navbarConsultant.blade.php` et `layouts/sidebarConsultant.blade.php` : Navigation consultant

### Authentification & Autorisation
- Système de vérification email avec codes
- Accès basé sur les rôles (utilisateurs standard vs consultants)
- Routes et vues spécifiques consultant sous namespace `/consultant`

### Import/Export Excel
Utilise `maatwebsite/excel` et `phpoffice/phpspreadsheet` pour :
- Import clients (ClientImport)
- Import chantiers (ChantierImport)
- Import budget/factures (BudgetFactureImport)

### Graphiques & Reporting
Utilise `consoletvs/charts` pour visualisation :
- Graphiques du dashboard
- Reporting baromètre
- Analytics clients/projets par secteur, zone et ligne métier

### Conversion nombres en lettres
Utilise `kwn/number-to-words` pour convertir montants en texte (génération factures).

## Patterns importants

### Gestion des statuts
La méthode `updateFactureStatus()` du modèle Facture :
1. Vérifie tous les statuts TrancheFacture d'une facture
2. Met à jour l'état Facture (0=non payé, 1=partiel, 2=totalement payé)
3. Met à jour l'état du Chantier parent quand facture totalement payée

### Multi-société
Application utilise modèle Societes avec configurations spécifiques pour chèques, personnel et taux de change.

## Conventions base de données

- Clés primaires : pattern `id_{nom_table}` (ex: `id_client`, `id_chantier`)
- Clés étrangères : même pattern
- Champs booléens : true/false
- Timestamps activés sur la plupart des tables
- Nombreuses clés étrangères nullable pour flexibilité de saisie

## Frontend

- Vite pour bundling (configuré dans `vite.config.js`)
- JavaScript minimal dans `resources/js/`
- Templates Blade principalement rendus côté serveur
- Assets statiques dans `public/assetsfacture/` incluant Bootstrap Icons

## Tests

PHPUnit configuré avec suites Unit et Feature séparées. Environnement test utilise cache array et queue sync.
