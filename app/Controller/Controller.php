<?php
# app/Controller/Controller.php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use DateTime;
use Exception;
use PHPImageWorkshop\ImageWorkshop;

class Controller
{

    private $entityManager;
    private $articleRepository;
    private $commentRepository;
    private $userRepository;


    public function __construct()
    {
        
    }

    public function login()
    {
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('connexion.front.twig');
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?p=home');
    }

    public function signIn()
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $users = $this->userRepository->findAll();

        foreach($users as $user)
        {
            if (!empty($_POST['email']) && !empty($_POST['password']))
            {
                if ($_POST['email'] === $user->getEmail() && password_verify($_POST['password'], $user->getPassword()))
                {
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['firstName'] = $user->getFirstName();
                    $_SESSION['lastName'] = $user->getLastName();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['admin'] = $user->getAdmin();

                    header('Location: ?p=home');
                }
                else
                {
                    $returnConnect = 'Désolé identifiant incorrect';
                    $colorConnect = 'danger';
                    require (dirname(__DIR__, 2).'/config/twig-config.php');
                    echo $twig->render('connexion.front.twig', [
                        'returnConnect' => $returnConnect,
                        'colorConnect' => $colorConnect
                    ]);
                }
            }
            else
            {
                $returnConnect = 'Veuillez remplir tout les champs';
                $colorConnect = 'warning';
                require (dirname(__DIR__, 2).'/config/twig-config.php');
                echo $twig->render('connexion.front.twig', [
                    'returnConnect' => $returnConnect,
                    'colorConnect' => $colorConnect
                ]);
            }
        }
    }

    public function getInscription()
    {
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('inscription.front.twig');
    }

    public function register()
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->userRepository = $this->entityManager->getRepository(User::class);
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        $users = $this->userRepository->findAll();
        $alreadyExist = false;

        if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password']))
        {
            if ($_POST['password'] === $_POST['passwordRepeat'])
            {
                foreach($users as $user)
                {
                    if ($_POST['email'] === $user->getEmail())
                    {
                        $alreadyExist = true;
                        $returnMessage = 'Désolé cette adresse e-mail est déjà utilisée';
                        $colorMessage = 'danger';
                        echo $twig->render('inscription.front.twig', [
                            'returnMessage' => $returnMessage,
                            'colorMessage' => $colorMessage
                        ]);
                    }
                    elseif ($alreadyExist === true)
                    {
                        $user = new User();
                        $user->setFirstName($_POST['firstName']);
                        $user->setLastName($_POST['lastName']);
                        $user->setEmail($_POST['email']);
                        $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                        $user->setAdmin(0);
                        $this->entityManager->persist($user);
                        $this->entityManager->flush();

                        $returnMessage = 'Vous êtes désormais inscrit ! Vous pouvez vous connecter';
                        $colorMessage = 'success';
                        echo $twig->render('home.front.twig', [
                            'returnMessage' => $returnMessage,
                            'colorMessage' => $colorMessage
                        ]);
                    }
                }
            }
            else
            {
                $returnMessage = 'Veuillez saisir deux mots de passe identiques';
                $colorMessage = 'warning';
                echo $twig->render('inscription.front.twig', [
                    'returnMessage' => $returnMessage,
                    'colorMessage' => $colorMessage
                ]);
            }
        }
        else
        {
            $returnMessage = 'Veuillez remplir tout les champs indiqués';
            $colorMessage = 'warning';
            echo $twig->render('inscription.front.twig', [
                'returnMessage' => $returnMessage,
                'colorMessage' => $colorMessage
            ]);
        }
    }

    public function getArticles($page, $isAdmin = false)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);

        // Nombre d'articles par page
        $perPage = 3;
        // Resultat minimum
        $resultMin = ($page*$perPage)-$perPage;
        // Resultat maximum
        $resultMax = ($page*$perPage);

        // Recherche des articles avec les contraintes OFFSET / LIMIT
        $articles = $this->articleRepository->findAllByDesc($resultMin,$resultMax);

        // Nombre d'articles
        $nbArticles = count($articles);

        // Calcule du nombre de page en fonction du nombre d'article
        $nbPages = ceil($nbArticles/$perPage);

        $comments = $this->commentRepository->findAll();
        $users = $this->userRepository->findAll();
        $reportComment = $this->commentRepository->findBy(['report' => 1]);
        require (dirname(__DIR__, 2).'/config/twig-config.php');

        $_SESSION['returnMessage'] = '';
        $_SESSION['colorMessage'] = '';

        if ($isAdmin === false)
        {
            echo $twig->render('home.front.twig', [
                'articles' => $articles,
                'users' => $users,
                'nbPages' => $nbPages,
                'page' => $page
            ]);
        }
        else
        {
            $_SESSION['returnMessage'] = '';
            $_SESSION['colorMessage'] = '';

            echo $twig->render('home.back.twig', [
                'users' => $users,
                'comments' => $comments,
                'articles' => $articles,
                'reportComment' => $reportComment,
                'nbPages' => $nbPages,
                'page' => $page
            ]);
        }
        
        
    }

    public function getArticle($articleId, $isAdmin = false)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        $comments = $this->commentRepository->findBy(["article" => $articleId]);
        $user = $this->userRepository->findBy(['id' => $articleId]);

        $_SESSION['returnMessage'] = '';
        $_SESSION['colorMessage'] = '';

        if ($isAdmin === false)
        {
            require (dirname(__DIR__, 2).'/config/twig-config.php');
            echo $twig->render('article.front.twig', [
                'article' => $article,
                'comments' => $comments,
                'users' => $user
            ]);
        }
        else
        {
            require (dirname(__DIR__, 2).'/config/twig-config.php');
            echo $twig->render('article.back.twig', [
                'article' => $article,
                'comments' => $comments,
                'users' => $user
            ]);
        } 
    }

    public function getArticleUpdate($articleId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('articleUpdate.back.twig', [
            'article' => $article
        ]);
    }

    public function setArticleUpdateSave($articleId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $article = $this->articleRepository->find($articleId);
        $article->setTitle($_POST['title']);
        $article->setContent($_POST['content']);
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $_SESSION['returnMessage'] = 'Votre article a bien été modifié';
        $_SESSION['colorMessage'] = 'success';

        header('Location: ?p=articleBack&id=' . $article->getId());
    }

    public function viewAddArticle()
    {
        // $_SESSION['returnMessage'] = '';
        // $_SESSION['colorMessage'] = '';

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('createArticle.back.twig');
    }

    public function viewUpdateArticle()
    {
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('articleUpdate.back.twig');
    }

    public function addArticle()
    {

        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
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

            if($file_error == 0 )
            {
                if(in_array($file_extension, $allowExtensions)) {
                
                    if(move_uploaded_file($file_tmp_name, $target_file)) {
                        echo "Fichier envoyé avec succès";
                    }
                } else {
                    echo "Désolé ce type de fichier n'est pas pris en charge";
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
    
                $_SESSION['returnMessage'] = 'Votre article a bien été ajouté';
                $_SESSION['colorMessage'] = 'success';
    
                header('Location: ?p=homeBack&page=1');
            }
            else
            {
                $_SESSION['returnMessage'] = 'Désolé, les données des champs sont incorrects';
                $_SESSION['colorMessage'] = 'danger';

                header('Location: ?p=viewAddArticle');
            }

        }
        else
        {
            $_SESSION['returnMessage'] = 'Désolé, tout les champs ne sont pas remplis';
            $_SESSION['colorMessage'] = 'danger';

            header('Location: ?p=viewAddArticle');
        }
    }

    public function deleteArticle($articleId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $article = $this->articleRepository->find($articleId);

        $this->entityManager->remove($article);
        $this->entityManager->flush();

        $_SESSION['returnMessage'] = 'Votre article a bien été supprimé';
        $_SESSION['colorMessage'] = 'success';

        header('Location: ?p=homeBack&page=1');
    }

    public function addComment($articleId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $article = $this->articleRepository->find($articleId);
        $user = $this->userRepository->find($_SESSION['id']);

        if (!empty($_POST['content']) && !ctype_space($_POST['content']))
        {
            $comment = new Comment();
            $comment->setCreatedAt(new DateTime(date('d-m-Y')));
            $comment->setContent($_POST['content']);
            $comment->setFirstName($_SESSION['firstName']);
            $comment->setLastName($_SESSION['lastName']);
            $comment->setReport(0);
            $comment->setArticle($article);
            $article->addComment($comment);
            $user->addComment($comment);
            $comment->setUser($user);
            $this->entityManager->persist($comment);
            $this->entityManager->persist($article);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        header('Location: ?p=article&id=' . $article->getId());
        
    }

    public function reportComment($articleId, $commentId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $article = $this->articleRepository->find($articleId);
        $comment = $this->commentRepository->find($commentId);

        $comment->setReport(1);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        header('Location: ?p=article&id=' . $article->getId());
    }

    public function viewReportComment()
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $comments = $this->commentRepository->findBy(['report' => 1]);
        $reportComment = count($comments);

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('report.back.twig', [
            'comments' => $comments,
            'reportComment' => $reportComment
        ]);
    }

    public function validReportComment($commentId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $comment = $this->commentRepository->find($commentId);
        

        $comment->setReport(0);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $returnMessage = 'Le commentaire à bien été validé';
        $colorMessage = 'success';

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('report.back.twig', [
            'returnMessage' => $returnMessage,
            'colorMessage' => $colorMessage,
        ]);
    }

    public function deleteReportComment($commentId)
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $comment = $this->commentRepository->find($commentId);

        $this->entityManager->remove($comment);
        $this->entityManager->flush();

        $returnMessage = 'Le commentaire à bien été supprimé';
        $colorMessage = 'success';

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('report.back.twig', [
            'returnMessage' => $returnMessage,
            'colorMessage' => $colorMessage,
        ]);
    }

}