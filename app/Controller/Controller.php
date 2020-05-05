<?php
# app/Controller/Controller.php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Picture;
use DateTime;

class Controller
{

    private $entityManager;
    private $articleRepository;
    private $commentRepository;
    private $userRepository;
    private $pictureRepository;

    public function __construct()
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->pictureRepository = $this->entityManager->getRepository(Picture::class);
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

    public function getArticles($isAdmin = false)
    {
        $articles = $this->articleRepository->findAll();
        $comments = $this->commentRepository->findAll();
        $users = $this->userRepository->findAll();
        require (dirname(__DIR__, 2).'/config/twig-config.php');

        if ($isAdmin === false)
        {
            echo $twig->render('home.front.twig', [
                'articles' => $articles
            ]);
        }
        else
        {
            echo $twig->render('home.back.twig', [
                'users' => $users,
                'comments' => $comments,
                'articles' => $articles
            ]);
        }
        
        
    }

    public function getArticle($articleId, $isAdmin = false)
    {
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        $comments = $this->commentRepository->findBy(["article" => $articleId]);

        if ($isAdmin === false)
        {
            require (dirname(__DIR__, 2).'/config/twig-config.php');
            echo $twig->render('article.front.twig', [
                'article' => $article,
                'comments' => $comments
            ]);
        }
        else
        {
            require (dirname(__DIR__, 2).'/config/twig-config.php');
            echo $twig->render('article.back.twig', [
                'article' => $article,
                'comments' => $comments
            ]);
        } 
    }

    public function getArticleUpdate($articleId)
    {
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('articleUpdate.back.twig', [
            'article' => $article
        ]);
    }

    public function setArticleUpdateSave($articleId)
    {
        $article = $this->articleRepository->find($articleId);
        $article->setTitle($_POST['title']);
        $article->setContent($_POST['content']);
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        header('Location: ?p=articleBack&id=' . $article->getId());
    }

    public function viewAddArticle()
    {
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('createArticle.back.twig');
    }

    public function viewUpdateArticle()
    {
        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('update.back.twig');
    }

    public function addArticle()
    {

        $user = $this->userRepository->find($_SESSION['id']);

        if (!empty($_POST['title']) && !empty($_POST['content']))
        {
            $article = new Article();
            $article->setCreatedAt(new DateTime(date('d-m-Y')));
            $article->setTitle($_POST['title']);
            $article->setContent($_POST['content']);
            $article->setPictureUrl('...');
            $article->setPictureAlt('...');
            $user->addArticle($article);
            $article->setUser($user);
            $this->entityManager->persist($article);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            header('Location: ?p=homeBack');
        }
    }

    public function addComment($articleId)
    {
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

}