## Démarche à suivre pour execution en local 

1. Récupération/clonage du dépot GitHub via l'url https://github.com/OHLAntoine/ECF_garage

2. S'assurer d'avoir Composer installé (https://getcomposer.org/doc/00-intro.md pour la démarche à suivre) ainsi qu'un serveur SQL et PHP (XAMPP par exemple ? https://www.apachefriends.org/fr/download.html)

3. Télécharger les paquets nécessaire au bon fonctionnement via la ligne de commande :

        > composer update

4. Modifier le fichier .env :

        # DATABASE_URL pour configurer l'accès à la base de données
        # MAILER_DSN pour configurer le serveur SMTP qui servira à l'envoi de mail (via Mailtrap pour les tests par exemple)

5. Une fois l'accès configuré, effectuer la creation de la base de données avec la commande :

        > php bin/console doctrine:database:create

6. Effectuer les migrations nécessaires à la création des différentes tables avec les commandes :

        > php bin/console doctrine:migrations:diff
        > php bin/console doctrine:migrations:migrate

7. Effectuer les fixtures pour l'ajout du profile Admin ainsi que les horaires et services par défaut (commenter le reste qui est optionnel) :

        > php bin/console doctrine:fixtures:load 

        Email admin par défaut : vincent.parrot@gmail.com
        Mot de passe par défaut : vincentparrot

8. Ajouter quelques avis et véhicules comme bon vous semble afin de remplir le site (exemple dans les fixtures ou directement sur le site).

9. Lancer le serveur puis se connecter sur l'adresse local OU via la commande :

        > symfony serve

10. Il ne vous reste plus qu'à partir à la découverte du site et ces fonctionnalités !