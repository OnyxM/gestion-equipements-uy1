ProjecTech est un projet permettant de gérer l'emprunt et réservation du matériel au département d'informatique de l'UYI

## Prérequis
    - php >= 8.1

    - composer2

## Pour lancer le projet
    - git clone https://github.com/OnyxM/gestion-equipements-uy1.git

    - cd gestion-equipements-uy1

    - composer install

    - créer la BD ('gestion_equipement' par défaut)

    - copy .env.example .env

    - php artisan key:generate 

    - php artisan migrate:fresh --seed

    - php artisan serve

    - Se connecter sur http://127.0.0.1:8000 avec l'admin (par défaut). email: admin@example.com / password: password
