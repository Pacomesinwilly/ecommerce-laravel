# 🛒 E-commerce Laravel — Pacôme SINWILLY

Plateforme e-commerce complète avec Laravel 12.

## ✨ Fonctionnalités
- Authentification (register/login/logout)
- Liste et détail des produits
- Panier (ajout, suppression, checkout)
- Dashboard administrateur
- Gestion des commandes

## 🛠️ Technologies
- Laravel 12 · PHP 8.2
- MySQL · Eloquent ORM
- Blade Templates
- Laravel Breeze (Auth)

## 🚀 Installation

```bash
git clone https://github.com/Pacomesinwilly/ecommerce-laravel.git
cd ecommerce-laravel
composer install
cp .env.example .env
php artisan key:generate
```

Configure `.env` avec ta base MySQL puis :

```bash
php artisan migrate
php artisan serve
```

Ouvre `http://localhost:8000`

## 👤 Auteur
**Pacôme SINWILLY** — [GitHub](https://github.com/Pacomesinwilly)