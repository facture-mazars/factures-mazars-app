#!/usr/bin/env bash
# Script de build pour Render
# exit on error
set -o errexit

echo "🚀 Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader

echo "🧹 Nettoyage des caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "📦 Installation des dépendances npm..."
npm ci

echo "🔨 Build des assets frontend..."
npm run build

echo "🗄️  Exécution des migrations..."
php artisan migrate --force

echo "⚡ Optimisation Laravel pour la production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build terminé avec succès!"
