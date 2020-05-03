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
    private $twig;

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

    public function getArticles()
    {
        $articles = $this->articleRepository->findAll();

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('home.front.twig', [
            'articles' => $articles
        ]);
    }

    public function getArticle($articleId)
    {
        $article = $this->articleRepository->findBy(['id' => $articleId]);
        $comments = $this->commentRepository->findBy(["article" => "$articleId"]);

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('article.front.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function addComment($articleId)
    {
        $article = $this->articleRepository->find($articleId);

        $comment = new Comment();
        $comment->setCreatedAt(new DateTime(date('d-m-Y')));

        if (!empty($_POST['content']) && !ctype_space($_POST['content']))
        {
            $comment->setContent($_POST['content']);
            $comment->setReport(0);
            $comment->setArticle($article);
            $article->addComment($comment);
            $this->entityManager->persist($comment);
            $this->entityManager->persist($article);
            $this->entityManager->flush();
        }

        header('Location: ?p=article&id=' . $article->getId());
        
    }

}