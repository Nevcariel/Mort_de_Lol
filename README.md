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

## Instalation

- Télécharger le repo

- Se positionner dans le dossier

- Lancer les commandes suivantes :

```
composer install
./bin/console cache:clear
./bin/console doctrine:database:create
./bin/console make:migration
./bin/console doctrine:migrations:migrate
./bin/console doctrine:fixtures:load
./bin/console server:run

```

Lancer le navigateur et aller sur http://localhost:8000.


## Auteurs

Romain Guilcher, Alexandre Doré, Léo Guerin, Thomas Bihorel, Corentin Poncet.

## Autre
Une partie du HTML/CSS a été inspiré par https://knpuniversity.com/

