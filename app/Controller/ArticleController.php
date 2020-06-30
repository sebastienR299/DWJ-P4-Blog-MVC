<?php
# app/Controller/ArticleController.php

namespace App\Controller;

use App\Entity\Article;
use DateTime;

class ArticleController extends Controller
{

    /**
     * Récupération de tout les articles
     *
     * @param integer $page -> Vérifie la page demandée
     * @param boolean $isAdmin -> Vérifie si il s'agit d'un compte administrateur
     * @return void
     */
    public function getArticles(int $page = 1, $isAdmin = false)
    {
        // Nombre d'articles par page
        $perPage = 4;
        // Resultat minimum
        $resultMin = ($page*$perPage)-$perPage;
        // Resultat maximum
        $resultMax = ($page*$perPage);

        // Recherche des articles avec les contraintes OFFSET / LIMIT
        $articles = $this->articleRepository->findAllByDesc($resultMin,$resultMax);

        // Recherche de tout les utilisateurs
        $users = $this->userRepository->findAll();

        // Nombre d'articles
        $nbArticles = count($articles);

        // Calcule du nombre de page en fonction du nombre d'article
        $nbPages = ceil($nbArticles/$perPage);
        if($page > $nbPages) {
            header('Location: /home/1');
            $_SESSION['flash'] = "Désolé cette page n'existe pas";
            $_SESSION['color'] = "danger";
        } else {
        if ($isAdmin === false)
        {
            echo $this->twig->render('home.front.twig', [
                'articles' => $articles,
                // 'users' => $users,
                'nbPages' => $nbPages,
                'page' => $page
            ]);
        }
        else
        {
            $comments = $this->commentRepository->findAll();
            $reportComment = $this->commentRepository->findBy(['report' => 1]);

            echo $this->twig->render('home.back.twig', [
                'users' => $users,
                'comments' => $comments,
                'articles' => $articles,
                'reportComment' => $reportComment,
                'nbPages' => $nbPages,
                'page' => $page
            ]);
        
        }
    }
    }

    /**
     * Récupération d'un article via son ID
     *
     * @param integer $articleId -> Récupération de l'ID de l'article
     * @param boolean $isAdmin -> Vérifie si il s'agit d'un compte administrateur
     * @return void
     */
    public function getArticle(int $articleId, $isAdmin = false)
    {

        $article = $this->articleRepository->findBy(['id' => $articleId]);
        $comments = $this->commentRepository->findBy(["article" => $articleId]);
        $user = $this->userRepository->findBy(['id' => $articleId]);
        $title = $this->articleRepository->find($articleId);

        if(is_null($title)) {
            header('Location: /home/1');
            $_SESSION['flash'] = "Désolé la page demandée n'existe pas";
            $_SESSION['color'] = "danger";
        } else {

            $titleName = $title->getTitle();

            if ($isAdmin === false)
            {
                echo $this->twig->render('article.front.twig', [
                    'article' => $article,
                    'comments' => $comments,
                    'users' => $user,
                    'title' => $titleName
                    ]);    
                
            }
            else
            {
                echo $this->twig->render('article.back.twig', [
                    'article' => $article,
                    'comments' => $comments,
                    'users' => $user,
                    'title' => $titleName
                ]);
            }
        }
    }
    

    /**
     * Retourne la vue pour la création d'un article
     *
     * @return void
     */
    public function viewAddArticle()
    {
        echo $this->twig->render('createArticle.back.twig');
    }

    /**
     * Création d'un article
     *
     * @return void
     */
    public function addArticle()
    {

        $user = $this->userRepository->find($_SESSION['id']);

        if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES))
        {

            $name = pathinfo($_FILES["pictureUrl"]["name"]);
            $file_name = md5($name["filename"]) . "." . $name["extension"];
            $file_tmp_name = $_FILES["pictureUrl"]["tmp_name"];
            $target_file = dirname(__DIR__,2)."/public/images/uploads/" . $file_name;
            $file_extension = strrchr($file_name, ".");
            $allowExtensions = array(".jpg", ".jpeg", ".png");
            $file_error = $_FILES["pictureUrl"]["error"];

            if($file_error == 0 && in_array($file_extension, $allowExtensions))
            {
   
                    if(move_uploaded_file($file_tmp_name, $target_file)) {
                    }

                $article = new Article();
                $article->setCreatedAt(new DateTime(date('d-m-Y')));
                $article->setTitle($_POST['title']);
                $article->setContent($_POST['content']);
                $article->setPictureUrl($file_name);
                $article->setPictureAlt($file_name);
                $user->addArticle($article);
                $article->setUser($user);
                $this->entityManager->persist($article);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
    
                $_SESSION['flash'] = 'Votre article a bien été ajouté';
                $_SESSION['color'] = 'success';
                header('Location: ?p=homeBack&page=1');
            }
            elseif ($file_error != 0)
            {
                $_SESSION['flash'] = "L'image est trop volumineuse (Maximum 4Mo)";
                $_SESSION['color'] = 'danger';
                header('Location: ?p=viewAddArticle');
            } else {
                $_SESSION['flash'] = "Fichier non pris en charge (uniquement .jpg - .jpeg - .png)";
                $_SESSION['color'] = 'danger';
                header('Location: ?p=viewAddArticle');
            }
        }
        else
        {
            $_SESSION['flash'] = 'Désolé, tout les champs ne sont pas remplis';
            $_SESSION['color'] = 'danger';
            header('Location: ?p=viewAddArticle');
        }
    }

    /**
     * Suppression d'un article
     *
     * @param integer $articleId -> Récupération de l'ID de l'article
     * @return void
     */
    public function deleteArticle(int $articleId)
    {
        $article = $this->articleRepository->find($articleId);

        $this->entityManager->remove($article);
        $this->entityManager->flush();

        $_SESSION['flash'] = 'Votre article a bien été supprimé';
        $_SESSION['color'] = 'success';

        header('Location: ?p=homeBack&page=1');
    }

    /**
     * Retourne la vue pour la modification d'un article
     *
     * @return void
     */
    public function viewUpdateArticle()
    {
        echo $this->twig->render('articleUpdate.back.twig');
    }

    /**
     * Récupération de l'article à modifier
     *
     * @param integer $articleId -> Récupération de l'ID de l'article
     * @return void
     */
    public function getArticleUpdate(int $articleId)
    {
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        echo $this->twig->render('articleUpdate.back.twig', [
            'article' => $article
        ]);
    }

    /**
     * Sauvegarde de la modification de l'article
     *
     * @param integer $articleId -> Récupération de le l'ID de l'article
     * @return void
     */
    public function setArticleUpdateSave(int $articleId)
    {
        $article = $this->articleRepository->find($articleId);

        if(!empty($_FILES)) {
            $name = pathinfo($_FILES["pictureUrl"]["name"]);
            $file_name = md5($name["filename"]) . "." . $name["extension"];
            $file_tmp_name = $_FILES["pictureUrl"]["tmp_name"];
            $target_file = dirname(__DIR__,2)."/public/images/uploads/" . $file_name;
            $file_extension = strrchr($file_name, ".");
            $allowExtensions = array(".jpg", ".jpeg", ".png");
            $file_error = $_FILES["pictureUrl"]["error"];

            if($file_error == 0 && in_array($file_extension, $allowExtensions)) {
                if(move_uploaded_file($file_tmp_name, $target_file)) {
                    echo "Fichier envoyé avec succès";
                }
                $article->setPictureUrl($file_name);
                $article->setPictureAlt($file_name);
            } 
            elseif($file_error != 0) {
                $_SESSION['flash'] = "L'image est trop volumineuse (Maximum 4Mo)";
                $_SESSION['color'] = 'danger';
                header('Location: ?p=articleBack&id=' . $article->getId());
            } 
            else {
                $_SESSION['flash'] = "Fichier non pris en charge (uniquement .jpg - .jpeg - .png)";
                $_SESSION['color'] = 'danger';
                header('Location: ?p=articleBack&id=' . $article->getId());
            }
        }

            if(!empty($_POST['title']) && !empty($_POST['content'])) {
                $article->setTitle($_POST['title']);
                $article->setContent($_POST['content']);
                $this->entityManager->persist($article);
                $this->entityManager->flush();

                $_SESSION['flash'] = 'Votre article a bien été modifié';
                $_SESSION['color'] = 'success';
                header('Location: ?p=articleBack&id=' . $article->getId());
            }
            else {
                $_SESSION['flash'] = "Désolé, tout les champs ne sont pas remplis";
                $_SESSION['color'] = 'danger';
                header('Location: ?p=articleBack&id=' . $article->getId());
            }
    }

    public function error404 () {
        echo $this->twig->render('error404.twig', []);
    }

}
