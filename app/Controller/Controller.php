<?php
# app/Controller/Controller.php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Picture;

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

    public function getArticles()
    {
        $articles = $this->articleRepository->findAll();

        require (dirname(__DIR__, 2).'/config/twig-config.php');
        echo $twig->render('home.front.twig', [
            'articles' => $articles
        ]);
    }

}