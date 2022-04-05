# Gasoline Price MAP  [![plugin version](https://img.shields.io/badge/version-v1.0-color.svg)](https://github.com/Loubal70/gasoline-price-map/releases/latest)

## Description

Plateforme communautaire qui répertorie les prix actuelles de l'essence selon votre position GPS.
Community platform that lists current gas prices based on your GPS location.

## Installation Steps

Follow this instructions to install the project:

1. Clone this repo.
    ```bash
    $ git clone https://github.com/Loubal70/gasoline-price-map
    ```
2. Go to branch laravel
3. `$ composer install`
5. `$ php artisan key:generate`
6. Set **database config** on `.env` file
7. `$ php artisan migrate`
8. `$ php artisan serve`
10. Open `https://localhost:8000` with browser.

## Versions

**Dernière version stable :** 1.0 <br>
**Dernière version :** 1.0<br>
Liste des versions : [Cliquer pour afficher](https://github.com/Loubal70/gasoline-price-map/tags)


## Optimizations

- [ ] Convert to Laravel 8 Project
- [ ] PWA Versionning
- [ ] Connexion with Google, Facebook, GitHub
- [ ] BDD Stations Essence
- [ ] Système Points ajout / modification

- [ ] Réaliser Maquette de l'application

Le projet a pour but d'être une PWA (Progressive Web App) tournant grâce à Laravel. A terme, il sera obligatoire de se connecter avec son compte Google, Facebook, GitHub afin de pouvoir ajouter / Modifier le prix d'un carburant. 

L'ajout / Modification d'un prix est valide si plusieurs membres du site, valide le prix, vous obtiendez alors des points / badges qui vous permettront d'avoir des récompenses...

---

The project aims to be a PWA (Progressive Web App) powered by Laravel. Eventually, it will be mandatory to connect with your Google, Facebook, GitHub account in order to be able to add / Modify the price of a fuel.

The addition / modification of a price is valid if several members of the site validate the price, you will then obtain points / badges which will allow you to have rewards...


## 🛠 Skills
HTML, CSS, Javascript

## Changelog

### [Unreleased]

#### [1.0] - (01/04/2022)

* Fix - Ajout du système de carte
* Fix - Ajout géo-localisation de l'utilisateur
* Fix - Ajout dynamique des distanciations

