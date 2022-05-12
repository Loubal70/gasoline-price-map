# Gasoline Price MAP  [![plugin version](https://img.shields.io/badge/version-v1.1-color.svg)](https://github.com/Loubal70/gasoline-price-map/releases/latest)

## Description

Plateforme communautaire qui répertorie les prix actuelles de l'essence selon votre position GPS.
Community platform that lists current gas prices based on your GPS location.

## Versions

**Dernière version stable :** 1.0 <br>
**Dernière version :** 1.1<br>
Liste des versions : [Cliquer pour afficher](https://github.com/Loubal70/gasoline-price-map/tags)


## Optimizations

- [x] Convert to Laravel 8 Project
- [ ] PWA Versionning
- [x] Connexion with Google
- [x] Message Error personnalisée register
- [ ] BDD Stations Essence
- [ ] Système Points ajout / modification

- [ ] Réaliser Maquette de l'application

Le projet a pour but d'être une PWA (Progressive Web App) tournant grâce à Laravel. A terme, il sera obligatoire de se connecter avec son compte Google, Facebook, GitHub afin de pouvoir ajouter / Modifier le prix d'un carburant. 

L'ajout / Modification d'un prix est valide si plusieurs membres du site, valide le prix, vous obtiendez alors des points / badges qui vous permettront d'avoir des récompenses...

---

The project aims to be a PWA (Progressive Web App) powered by Laravel. Eventually, it will be mandatory to connect with your Google, Facebook, GitHub account in order to be able to add / Modify the price of a fuel.

The addition / modification of a price is valid if several members of the site validate the price, you will then obtain points / badges which will allow you to have rewards...


## 🛠 Skills
HTML, CSS, Javascript, Laravel, Php

## Changelog

### [Unreleased]

#### [1.0.1] - (05/04/2022)

* Fix - Click in Map disappears after 10 seconds
* Fix - Click in Map = Prompt Add pointer, redirect create form with lat et lnt
* Fix - Responsive navbar
* Fix - Dashboard (map view) - Add navbar
* Fix - Add PointerController : Create Custom Pointer
* Fix - Added distancing if user position is enabled
* Fix - Remove pointer'shadow of leafletjs
* Fix - Add npm leafletjs dependance (map librairy)

#### [1.0] - (04/04/2022)

* Fix - Add profil page (password, custom picture, others session, delete account)
* Fix - Add compiler Sass
* Fix - Add connexion with Google
* Fix - Add Laravel project
* Fix - Ajout du système de carte
* Fix - Ajout géo-localisation de l'utilisateur
* Fix - Ajout dynamique des distanciations



## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
