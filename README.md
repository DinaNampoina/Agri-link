# Agrilik

En developpement

## Description

un site web pour mettre en relation directe les petits agriculteurs de la region de vakinakaratra avec les acheteurs sans intermediaire

## Fonctionnalités

### Public (sans compte)

- Parcourir toutes les annonces disponibles
- Rechercher par mot-clé, filtrer par produit, région, prix
- Consulter le détail d'une annonce et contacter le vendeur

### Vendeur (compte requis)

- Inscription/connexion par numéro de téléphone
- Publier, modifier, supprimer une annonce
- Marquer une annonce comme vendue
- Ajouter un produit/unité/région non listés

### Admin

- Gérer la liste des produits (catégories)
- Modérer/supprimer n'importe quelle annonce
- Consulter la liste des vendeurs

## Stack technique

- Laravel 13
- PHP
- Blade + Tailwindcss
- sqlite / Mysql

## Architecture

MVC Laravel clasique

## Sécurité

- Mass assignment protégé (`role`, `user_id`, `statut` jamais acceptés depuis une requête client)
- Autorisation par propriétaire (`abort_if`) sur modification/suppression d'annonce
- Middleware dédié pour l'espace admin

## Installation locale

bash
git clone <https://github.com/DinaNampoina/Agri-link.git>
cd Agri-link
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve

