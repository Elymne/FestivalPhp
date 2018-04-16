FestivalPhp
===========

A Symfony project created on April 5, 2018, 8:51 am.

Procédure pour récupérer le projet sous NetBeans


Phase 1 : Clonage
=

Clonez le projet depuis gitHub ( team -> clone )


Phase 2 : Fichier parameters
=
Concernant vos bases de données et tables ect.

Dans le répertoire suivant : (app/config)
  Créez un fichier parameters.yml
  (Inspirez vous du fichier parameters.yml.dist pour créer ce fichier)


Phase 3 : Vendors
=
Installation des Vendors
Commande :
  php composer.phar install


Phase 4 : Création de votre base de données et des tables
=
Création de la BDD
Commande :
  php bin/console doctrine:database:create
  
Création des tables liées aux classes objets de l'application
Commande :
  php bin/console doctrine:schema:update --force
  

Phase 5 : Assets
=
Modification du répertoire Web
Commande :
  php bin/console assets:install web
