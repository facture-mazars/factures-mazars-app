# Guide de mise en place sur GitHub

## Informations du dépôt
- **Username GitHub** : `ainanyfitiagershom`
- **Nom du dépôt** : `factures-mazars-app`
- **URL du dépôt** : `https://github.com/ainanyfitiagershom/factures-mazars-app.git`

---

## Étape 1 : Créer le dépôt sur GitHub

1. Allez sur [github.com](https://github.com) et connectez-vous
2. Cliquez sur le bouton **"+"** en haut à droite → **"New repository"**
3. Remplissez :
   - **Repository name** : `factures-mazars-app`
   - **Description** : `Application Laravel de gestion de factures et chantiers`
   - **Visibilité** : Private ou Public (votre choix)
   - ⚠️ **NE PAS** cocher "Add a README file"
   - ⚠️ **NE PAS** ajouter .gitignore (on l'a déjà)
   - ⚠️ **NE PAS** choisir de licence pour l'instant
4. Cliquez **"Create repository"**

---

## Étape 2 : Initialiser Git et pousser le code

Ouvrez un terminal dans le dossier du projet et exécutez ces commandes **une par une** :

### 1. Initialiser Git
```bash
git init
```

### 2. Configurer votre identité Git (si ce n'est pas déjà fait)
```bash
git config user.name "ainanyfitiagershom"
git config user.email "votre-email@example.com"
```

### 3. Ajouter tous les fichiers au staging
```bash
git add .
```

### 4. Vérifier les fichiers qui seront commités
```bash
git status
```
Vérifiez que le fichier `.env` n'apparaît PAS dans la liste (il doit être ignoré).

### 5. Créer le premier commit
```bash
git commit -m "Initial commit: Application Laravel de gestion de factures"
```

### 6. Renommer la branche en 'main' (si nécessaire)
```bash
git branch -M main
```

### 7. Ajouter le dépôt distant GitHub
```bash
git remote add origin https://github.com/ainanyfitiagershom/factures-mazars-app.git
```

### 8. Pousser le code sur GitHub
```bash
git push -u origin main
```

**Note** : Si GitHub demande une authentification, utilisez un **Personal Access Token** au lieu du mot de passe.

---

## Étape 3 : Vérification

Allez sur `https://github.com/ainanyfitiagershom/factures-mazars-app` et vérifiez que :
- ✅ Tous vos fichiers sont présents
- ✅ Le fichier `.env` n'est PAS visible (il doit être ignoré)
- ✅ Le fichier `build.sh` est présent
- ✅ Les dossiers `vendor/` et `node_modules/` ne sont PAS présents (ignorés)

---

## Commandes Git utiles pour la suite

### Voir l'état du dépôt
```bash
git status
```

### Ajouter des modifications
```bash
git add .
git commit -m "Description des changements"
git push
```

### Voir l'historique des commits
```bash
git log --oneline
```

### Voir les fichiers ignorés
```bash
git status --ignored
```

---

## Dépannage

### Erreur : "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/ainanyfitiagershom/factures-mazars-app.git
```

### Erreur d'authentification GitHub
GitHub n'accepte plus les mots de passe depuis 2021. Vous devez :
1. Créer un **Personal Access Token** :
   - GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
   - Generate new token → Cochez "repo" → Generate
   - Copiez le token (vous ne le reverrez plus)
2. Utilisez ce token comme mot de passe lors du push

### Alternative : Utiliser SSH au lieu de HTTPS
```bash
# Générer une clé SSH
ssh-keygen -t ed25519 -C "votre-email@example.com"

# Ajouter la clé à ssh-agent
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519

# Copier la clé publique
cat ~/.ssh/id_ed25519.pub

# Ajouter cette clé dans GitHub → Settings → SSH and GPG keys

# Changer l'URL du remote
git remote set-url origin git@github.com:ainanyfitiagershom/factures-mazars-app.git
```

---

## Prochaine étape : Déploiement sur Render

Une fois que votre code est sur GitHub, vous pourrez :
1. Aller sur [render.com](https://render.com)
2. Connecter votre compte GitHub
3. Sélectionner le dépôt `factures-mazars-app`
4. Suivre les instructions dans `DEPLOYMENT.md`
