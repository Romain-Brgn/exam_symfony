# Projet Symfony 6.4 – Examen

## Présentation rapide

Ce projet a été réalisé dans le cadre d’un examen Symfony 6.4.  
Je me suis appuyé sur le cours, quelques vidéos YouTube, la doc officielle, et pas mal sur ChatGPT pour comprendre certains trucs ou m’aider quand j’étais bloqué.

## Ce que j’ai mis en place

### Authentification / Espace Professeur

- J’ai utilisé le bundle **Security** pour gérer le login et le logout.
- Quand un professeur s’inscrit, ses infos sont bien enregistrées en BDD.
- Upload de photo de profil intégré dans le formulaire d’inscription.
- Un mail de bienvenue est envoyé automatiquement après inscription.
- Je voulais faire un listener pour hasher le mot de passe… j’ai essayé, mais ça n’a pas marché. Du coup je l’ai fait **manuellement dans le contrôleur**, au moins c’est fonctionnel.
- Une fois inscrit, le prof est redirigé vers la page de login. Il se connecte, un message flash s'affiche, et il est envoyé dans son espace privé.

### Espace personnel via EasyAdmin

- J’ai mis en place un espace prof avec **EasyAdmin**.
- L’accès est restreint au rôle `ROLE_PROFESSOR`.
- Une fois connecté, le professeur peut faire un CRUD sur ses **activités**.
- Quand il crée une activité, elle est automatiquement liée à lui.
- Il peut aussi choisir un **thème** via une liste déroulante.

### Pages publiques

- J’ai utilisé `knplabs/knp-paginator-bundle` pour faire la pagination, notamment sur la page des professeurs.
- Sur cette page, les profs sont triés **par ordre alphabétique** (via un `QueryBuilder`).
- Chaque professeur et chaque activité peuvent être cliqués pour afficher une page de détails (ici j'ai utilisé l'entityvalueresolver).

### Gestion des erreurs

- Comme j’ai galéré avec le listener pour le mot de passe, j’ai au moins réussi à faire un listener qui gère les **erreurs d’URL**.

## À propos des templates

- Tous les templates **Twig** ont été générés avec **ChatGPT**.
- J’ai quand même bidouillé un peu dedans pour que ça colle à mon projet, mais le gros du code vient pas de moi.

## Pour résumer

J’ai essayé de faire un projet propre et fonctionnel, même si tout n’est pas parfait.  
Je n’ai pas réussi à faire tout ce que je voulais (comme le listener du hash), mais j’ai trouvé des solutions pour que ça marche quand même.  
J’ai appris pas mal de choses en faisant ce projet, surtout sur la gestion des rôles, les formulaires, EasyAdmin, et la sécurité avec Symfony.


j'ai ajouter au dashboard la possibilité de consulter les evaluations et de faire du crud dessus

