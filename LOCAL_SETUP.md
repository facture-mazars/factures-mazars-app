# Guide de lancement local du projet

## 🔧 Prérequis

Vous devez avoir installé :
- PHP 8.2+
- Composer
- Node.js et npm
- PostgreSQL

---

## 📝 Étapes de configuration

### 1. Installer PostgreSQL sur Arch Linux

```bash
# Installer PostgreSQL
sudo pacman -S postgresql

# Initialiser la base de données
sudo -u postgres initdb -D /var/lib/postgres/data

# Démarrer PostgreSQL
sudo systemctl start postgresql
sudo systemctl enable postgresql

# Vérifier que PostgreSQL fonctionne
sudo systemctl status postgresql
```

### 2. Créer la base de données et l'utilisateur

```bash
# Se connecter en tant que postgres
sudo -u postgres psql

# Dans psql, exécuter ces commandes :
CREATE USER mac WITH PASSWORD '2005';
CREATE DATABASE factures;
GRANT ALL PRIVILEGES ON DATABASE factures TO mac;

# Pour PostgreSQL 15+, donner aussi les privilèges sur le schéma
\c factures
GRANT ALL ON SCHEMA public TO mac;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO mac;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO mac;

# Quitter psql
\q
```

### 3. Vérifier la connexion PostgreSQL

```bash
# Tester la connexion
psql -U mac -d factures -h 127.0.0.1
# Entrer le mot de passe : 2005
# Si ça marche, tapez \q pour quitter
```

### 4. Installer les dépendances

```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances npm
npm install
```

### 5. Configurer l'environnement

Votre fichier `.env` est déjà configuré avec :
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=factures
DB_USERNAME=mac
DB_PASSWORD=2005
```

Vérifiez juste que ces valeurs sont correctes.

### 6. Générer la clé d'application (si besoin)

```bash
php artisan key:generate
```

### 7. Exécuter les migrations

```bash
# Lancer les migrations pour créer toutes les tables
php artisan migrate

# Si vous avez des erreurs, vous pouvez forcer :
php artisan migrate --force
```

### 8. Compiler les assets frontend

```bash
# En mode développement (avec watch)
npm run dev

# OU en mode production
npm run build
```

### 9. Lancer le serveur

```bash
# Dans un terminal
php artisan serve

# L'application sera disponible sur : http://127.0.0.1:8000
```

---

## 🚀 Commandes rapides (une fois tout installé)

Pour relancer le projet après la première installation :

```bash
# Terminal 1 : Serveur Laravel
php artisan serve

# Terminal 2 : Watcher des assets (optionnel, seulement si vous modifiez CSS/JS)
npm run dev
```

Puis ouvrez : **http://127.0.0.1:8000**

---

## 🐛 Dépannage

### Erreur : "SQLSTATE[08006] could not connect to server"
PostgreSQL n'est pas démarré :
```bash
sudo systemctl start postgresql
```

### Erreur : "SQLSTATE[42P01]: Undefined table"
Les migrations n'ont pas été exécutées :
```bash
php artisan migrate
```

### Erreur : "Class not found"
Autoload pas à jour :
```bash
composer dump-autoload
```

### Erreur : "Mix manifest not found"
Assets pas compilés :
```bash
npm run build
```

### Port 8000 déjà utilisé
Lancer sur un autre port :
```bash
php artisan serve --port=8001
```

### Réinitialiser complètement la base de données
```bash
php artisan migrate:fresh
```

---

## 📊 Données de test (optionnel)

Si vous voulez peupler la base avec des données de test :

```bash
php artisan db:seed
```

---

## ✅ Vérification finale

Une fois tout lancé, vous devriez voir :
1. ✅ Le serveur Laravel qui tourne sur http://127.0.0.1:8000
2. ✅ La page de connexion qui s'affiche
3. ✅ Pas d'erreurs dans la console

Si tout fonctionne, vous êtes prêt pour le déploiement ! 🎉
