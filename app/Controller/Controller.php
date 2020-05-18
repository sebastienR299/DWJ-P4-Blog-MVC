<?php
# app/Controller/Controller.php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;

abstract class Controller
{

    protected $entityManager;
    protected $articleRepository;
    protected $commentRepository;
    protected $userRepository;
    protected $twig;

    public function __construct()
    {
        $this->entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->twig = require (dirname(__DIR__, 2).'/config/twig-config.php');
    }

}