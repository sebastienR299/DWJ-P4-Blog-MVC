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
        $comments= $this->commentRepository->findBy(['id' => $articleId]);

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

        header('Location: index.php?p=article&id=' . $article->getId());
        
    }

}