#!/bin/bash

# Exécuter les migrations
php artisan migrate --force --no-interaction

# Optimiser Laravel pour la production
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# Démarrer Apache
apache2-foreground
