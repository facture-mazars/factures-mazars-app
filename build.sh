#!/usr/bin/env bash
# Script de build pour Render
# exit on error
set -o errexit

echo "🚀 Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "📦 Installation des dépendances npm..."
npm ci --include=dev

echo "🔨 Build des assets frontend avec Vite..."
npm run build

echo "🗄️  Exécution des migrations..."
php artisan migrate --force --no-interaction

echo "⚡ Optimisation Laravel pour la production..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

echo "✅ Build terminé avec succès!"
