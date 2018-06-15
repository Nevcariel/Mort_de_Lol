# MortDeLol
## Résumé

Ce site en un site de référencement de blagues.

- Un utilisateur annonyme peut : s'inscrire, consulter les blagues, faire un recherche, consulter le profil d'un utilisateur.

- Un utilisateur insrit peut : ajouter une blague, noter une blague, laisser un commentaire sur une blague.

- Le panneau d'administration est accessible depuis : http://localhost:8000/admin

- Le compte admin est : 
```
id : admin
mdp : adminpass
```

## Prérequis

- Requiert composer https://getcomposer.org/download/

- Requiert php 7.2 http://php.net/downloads.php

- Requiert SQLite ou MySQL

- Dans le cas ou MySQL est utilisé :

remplacer le contenu du fichier site/config/package/doctrine.yaml par :

```
parameters:
    # Adds a fallback DATABASE_URL if the env var is not set.
    # This allows you to run cache:warmup even if your
    # environment variables are not available yet.
    # You should not need to change this value.
    env(DATABASE_URL): ''

doctrine:
    dbal:
        # configure these for your database server
        driver: 'pdo_mysql'
        server_version: '5.7'
        charset: utf8mb4
        default_table_options:
            charset: utf8mb4
            collate: utf8mb4_unicode_ci

        url: '%env(resolve:DATABASE_URL)%'
    orm:
        auto_generate_proxy_classes: '%kernel.debug%'
        naming_strategy: doctrine.orm.naming_strategy.underscore
        auto_mapping: true
        mappings:
            App:
                is_bundle: false
                type: annotation
                dir: '%kernel.project_dir%/src/Entity'
                prefix: 'App\Entity'
                alias: App


```

remplacer le contenu du fichier site/.env par :
```
# This file is a "template" of which env vars need to be defined for your application
# Copy this file to .env file for development, create environment variables when deploying to production
# https://symfony.com/doc/current/best_practices/configuration.html#infrastructure-related-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=0c94212559cd3d8678c06b4b876a12f4
#TRUSTED_PROXIES=127.0.0.1,127.0.0.2
#TRUSTED_HOSTS=localhost,example.com
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/mort_de_lol
###< doctrine/doctrine-bundle ###

```



## Instalation

- Télécharger le repo

- Se positionner dans le dossier

- Entrer les commandes suivantes :

```
composer install
./bin/console cache:clear
./bin/console doctrine:database:create
./bin/console make:migration
./bin/console doctrine:migrations:migrate
./bin/console doctrine:fixtures:load
./bin/console server:run

```

- Lancer le navigateur et aller sur http://localhost:8000.


## Auteurs

Romain Guilcher, Alexandre Doré, Léo Guerin, Thomas Bihorel, Corentin Poncet.

## Autre
Une partie du HTML/CSS a été inspiré par https://knpuniversity.com/

