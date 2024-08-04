# Projet Symfony - Rattrapages

Bonjour,

Dans le cadre des mes rattrapages IIM en "Architecture MVC - Symfony", je vais vous présenter mon projet de gestion des congés réalisé avec Symfony. Cette application permet aux utilisateurs de poser des congés, de les modifier, de les annuler et de voir l'état de leurs demandes. J'ai aussi tenté d'intégrer un système de connexion pour sécuriser l'accès aux fonctionnalités.

## Fonctionnalités Principales

- **Gestion des Congés :**
  - Les utilisateurs peuvent poser des congés une journée entière ou plusieurs jours.
  - Les congés peuvent être catégorisés (RTT, CP, congé exceptionnel).
  - Les congés peuvent avoir plusieurs états : Demandé, Validé, Refusé, Annulé.
  - Les congés peuvent être modifiés
  - Les congés peuvent être annulés
- **Login :**
  - Les utilisateurs doivent se connecter pour accéder à l'application.
  - Les utilisateurs peuvent valider ou refuser leurs propres congés.

## Étapes de développement

### Installation et Configuration

- J'ai d'abord installé mon projet Symfony avec symfony new Rattrapages_MVC --webapp
- J'ai utilisé SQLite avec DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db" dans mon fichier .env.
- J'ai installé les dépendances

### Développement des Fonctionnalités de Congés

- Création de l'entité Leave avec php bin/console make:entity Leave
- J'ai ensuite défini les propriétés de l'entité dans le fichier src/Entity/Leave.php.
- J'ai créé un contrôleur pour gérer toutes les actions liées aux congés avec php bin/console make:controller
- J'ai configuré le formulaire dans src/Form/LeaveType.php.
- J'ai créé des fichiers Twig pour les vues dans le dossier templates/leave/ : list.html.twig, new.html.twig, edit.html.twig.

### Développement de l'authentification des Users

- Pour gérer les utilisateurs, j'ai créé une entité User avec php bin/console make:entity User
- J'ai ensuite défini les propriétés de l'entité dans le fichier src/Entity/User.php.
- J'ai créé un contrôleur pour gérer toutes les actions liées aux users avec php bin/console make:controller
- J'ai créé le fichier login.html.twig dans le dossier templates/security/

## Difficultés rencontrées

### Gestion session d'utilisateurs

S'assurer que les utilisateurs sont correctement connectés et que les sessions fonctionnent comme prévu.

### Intégrité des données dans SQLite

Gérer les contraintes d'intégrité des données, telles que les doublons de noms d'utilisateur.

### Redirection après connexion

S'assurer que les utilisateurs sont redirigés correctement après la connexion.

## Conclusion

Ce projet Symfony de gestion des congés permet aux utilisateurs de poser, modifier, et annuler des congés avec différentes catégories et états. Bien que certaines fonctionnalités, notamment la gestion avancée des utilisateurs, n'aient pas été correctement implémentées, l'application offre une base solide pour une gestion des congés. Les difficultés rencontrées ont été des opportunités d'apprentissage et m'ont permis d'améliorer mes compétences en développement Symfony. J'espère avoir une correction ou des explications sur comment j'aurai pu m'y prendre pour progresser et comprendre mes fautes.

#### Infos supplémentaires :

Mes recherches sur internet ont été faites sur :
https://symfony.com/doc/
https://stackoverflow.com/
https://developer.mozilla.org/fr/

Le lien de la vidéo youtube de présentation du projet : https://youtu.be/LL9ryB5qQCk

#### PS : Lancer le projet

Pour lancer le projet de manière fonctionnelle (première version) sans la fonctionnalité d'authentification faire :
- Étape 1 : Cloner le repo Github
- Étape 2 : Récupérer le commit - git checkout [app fonctionnelle]
- Étape 3 : Récupérer les dépenadances - composer install
- Étape 4 : Configurer la bdd - php bin/console doctrine:database:create php bin/console doctrine:schema:update --force
- Étape 5 : Lancer le serveur - symfony server:start
- Étape 6 : Accèder à l'application via : http://localhost:8000

Pour lancer le projet avec authentification (deuxième version non-fonctionnelle) faire :
- Étape 1 : Cloner le repo Github
- Étape 2 : Récupérer le commit - git checkout [tentative ajout fonctionnalité user]
- Étape 2 : Récupérer les dépendances - composer install
- Étape 3 : Configurer la bdd - php bin/console doctrine:database:create php bin/console doctrine:schema:update --force
- Étape 4 : Lancer le serveur - symfony server:start
- Étape 5 : Accèder à l'application via : http://localhost:8000
