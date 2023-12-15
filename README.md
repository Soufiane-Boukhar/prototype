# Prototype project and tasks

## Overview
Create web application built with Laravel to manage projects and tasks. It also uses the Maatwebsite Excel package to export and import data. Built with Laravel UI authentification and AdminLTE, user permissions with Spatie Laravel Permission, and functionality for search, pagination, and filtering, and unit test for project and task controllers.

## Prerequisites
- PHP 8.2
- Composer
- Node.js & NPM
- MySQL

## Getting Started

### Installation

```bash

# Clone the repository
git clone https://github.com/boukharSoufiane1998/prototype-project.git

# Navigate to the project directory
cd your-repo

# Install PHP dependencies
composer install

# Install JavaScript dependencies

npm install && npm run dev

# Configure your .env file and set up the database
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

```

### Packages

```bash

# Configure your php.ini file php
extension=gd enabled

# Install package excel
 composer require maatwebsite/excel:*

# Run commande
composer update

# Configure your file config/app.php

'providers' => ServiceProvider::defaultProviders()->merge([
    Maatwebsite\Excel\ExcelServiceProvider::class,
]);

'aliases' => Facade::defaultAliases()->merge([
    'Excel' =>Maatwebsite\Excel\Facades\Excel::class,
])->toArray(),

# Run commande
composer dump-autoload

# Run commande 
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

# Install permission package
composer require spatie/laravel-permission

# Run commande
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Run commande
php artisan migrate:fresh

# Run commande
php artisan db:seed


```



