# ***DWJ P4 BLOG MVC***

&nbsp;

**Structure**
===

- [x] *Mise en place de la structure de base et mise en place de Webpack ainsi que des paquets principaux de composer.* 
  
- [x] *Ajout des fichiers de configuration de base pour Doctrine ORM.*

***

### Créations des Entités

- Article
- Comment
- User

***

### Créations des Controllers

- Controller (abstract)
- ArticleController
- CommentController
- UserController

***

### Création des Repositories

- ArticleRepository
- UserRepository

*Création de requêtes personnalisées avec le QueryBuilder*

***

### Ajout du moteur de template Twig

- Découpage de l'interface en plusieurs fichiers
- création d'un fonction twig pour la gestion des messages flash

***

### Création du routeur pour la redirection

***

### Mise en place de l'url Rewriting

***

&nbsp;

Utilisateur non connecté
===

- Inscription
- Connexion
- Lecture des articles
- Lecture des commentaires

Utilisateur connecté
===

- Deconnexion
- Création de commentaire 
- Signalement de commentaire

Administrateur
===

- Dashboard
- Création d'un article
- Modification d'un article
- Suppression d'un article
- Création de commentaire
- Modération de commentaire
- Signalement de commentaire
- Lecture du nombre de publications
- Lecture du nombre de commentaires
- Lecture du nombre d'utilistateurs