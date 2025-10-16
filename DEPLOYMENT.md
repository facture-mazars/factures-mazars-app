# Guide d'installation PostgreSQL et Déploiement sur Render

## 1. Installation PostgreSQL localement (Arch Linux)

### Installer PostgreSQL
```bash
sudo pacman -S postgresql
```

### Initialiser la base de données
```bash
sudo -u postgres initdb -D /var/lib/postgres/data
```

### Démarrer le service PostgreSQL
```bash
sudo systemctl start postgresql
sudo systemctl enable postgresql  # Pour démarrer automatiquement au boot
```

### Créer un utilisateur et une base de données
```bash
# Se connecter en tant que postgres
sudo -u postgres psql

# Dans psql, exécuter :
CREATE USER mac WITH PASSWORD '2005';
CREATE DATABASE factures;
GRANT ALL PRIVILEGES ON DATABASE factures TO mac;

# Donner les privilèges sur le schéma public (pour Laravel 11)
\c factures
GRANT ALL ON SCHEMA public TO mac;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO mac;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO mac;

# Quitter psql
\q
```

### Tester la connexion
```bash
psql -U mac -d factures -h 127.0.0.1
# Entrer le mot de passe : 2005
```

### Exécuter les migrations Laravel
```bash
php artisan migrate
```

---

## 2. Déploiement sur Render

### Prérequis
- Un compte Render (gratuit sur render.com)
- Un dépôt Git (GitHub, GitLab, etc.)

### Étape 1 : Créer une base de données PostgreSQL sur Render

1. Connectez-vous sur [render.com](https://render.com)
2. Cliquez sur **"New +"** → **"PostgreSQL"**
3. Configurez :
   - **Name** : `factures-db` (ou autre nom)
   - **Database** : `factures`
   - **User** : généré automatiquement
   - **Region** : choisir la plus proche
   - **Plan** : Free (ou Starter si besoin)
4. Cliquez sur **"Create Database"**
5. **Notez les informations de connexion** (Internal Database URL et External Database URL)

### Étape 2 : Préparer le projet Laravel

#### Créer un fichier `build.sh` à la racine du projet
```bash
#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Installation des dépendances npm et build
npm ci
npm run build

# Migrations
php artisan migrate --force
```

#### Créer un fichier `render.yaml` à la racine du projet (optionnel mais recommandé)
```yaml
services:
  - type: web
    name: factures-app
    env: php
    buildCommand: bash build.sh
    startCommand: php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_NAME
        value: Factures App
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: APP_URL
        sync: false
      - key: APP_KEY
        generateValue: true
      - key: DATABASE_URL
        fromDatabase:
          name: factures-db
          property: connectionString
      - key: DB_CONNECTION
        value: pgsql
```

### Étape 3 : Créer le Web Service sur Render

1. Sur Render, cliquez sur **"New +"** → **"Web Service"**
2. Connectez votre dépôt Git
3. Configurez :
   - **Name** : `factures-app`
   - **Environment** : `PHP`
   - **Build Command** : `bash build.sh`
   - **Start Command** : `php artisan serve --host=0.0.0.0 --port=$PORT`

### Étape 4 : Configurer les variables d'environnement

Dans les paramètres du Web Service, ajoutez ces variables :

```
APP_NAME=Factures App
APP_ENV=production
APP_KEY=base64:votre_clé_ici
APP_DEBUG=false
APP_URL=https://votre-app.onrender.com

DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:password@host:port/database
# OU décomposé :
DB_HOST=xxx.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=factures
DB_USERNAME=factures_user
DB_PASSWORD=xxx

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
```

**Important** :
- Copiez la `DATABASE_URL` depuis les détails de votre base PostgreSQL sur Render
- Générez une nouvelle `APP_KEY` avec `php artisan key:generate --show`

### Étape 5 : Déployer

1. Cliquez sur **"Create Web Service"**
2. Render va automatiquement :
   - Cloner votre dépôt
   - Installer les dépendances
   - Exécuter le build script
   - Lancer les migrations
   - Démarrer l'application

### Étape 6 : Configuration supplémentaire pour la production

#### Optimiser Laravel pour la production
Ajoutez ces commandes dans votre `build.sh` :
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Configurer le stockage des fichiers
Si vous uploadez des fichiers, configurez un stockage externe (AWS S3, Cloudinary, etc.)

---

## 3. Alternatives de déploiement

### Option A : Heroku (similaire à Render)
- Postgres gratuit inclus
- Ajoutez un `Procfile` : `web: php artisan serve --host=0.0.0.0 --port=$PORT`

### Option B : DigitalOcean App Platform
- Offre 3 sites statiques gratuits
- Configuration similaire à Render

### Option C : Railway
- Plus généreux sur le plan gratuit
- PostgreSQL inclus
- Configuration très simple

---

## Dépannage

### Erreur de connexion PostgreSQL locale
```bash
# Vérifier que PostgreSQL tourne
sudo systemctl status postgresql

# Redémarrer si nécessaire
sudo systemctl restart postgresql
```

### Erreur de permissions sur Render
Assurez-vous que `build.sh` est exécutable :
```bash
chmod +x build.sh
git add build.sh
git commit -m "Rendre build.sh exécutable"
git push
```

### Migrations échouent sur Render
Vérifiez que la `DATABASE_URL` est correctement configurée dans les variables d'environnement.

### Application ne démarre pas sur Render
Consultez les logs : Dashboard → votre service → Logs
