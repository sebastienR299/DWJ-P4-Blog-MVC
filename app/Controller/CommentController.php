<?php
# app/Controller/CommentController.php

namespace App\Controller;

use App\Entity\Comment;
use DateTime;

class CommentController extends Controller
{

    /**
     * Création d'un commentaire
     *
     * @param integer $articleId -> Récupération de l'ID de l'article
     * @return void
     */
    public function addComment(int $articleId, $isAdmin = false)
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

            $_SESSION['flash'] = "Votre commentaire à bien été ajouté";
            $_SESSION['color'] = "success";
            header('Location: ?p=article&id=' . $article->getId() . '#write-comment');
        }
        else
        {
            $_SESSION['flash'] = "Veuillez saisir un message";
            $_SESSION['color'] = "danger";
            header('Location: ?p=article&id=' . $article->getId() . '#write-comment');
        }
        
    }

    /**
     * Signalement d'un commentaire
     *
     * @param integer $articleId -> Récupération de l'ID de l'article
     * @param integer $commentId -> Récupération de l'ID du commentaire
     * @return void
     */
    public function reportComment(int $articleId, int $commentId)
    {
        $article = $this->articleRepository->find($articleId);
        $comment = $this->commentRepository->find($commentId);

        $comment->setReport(1);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $_SESSION['flash'] = "Le commentaire a bien été signaler";
        $_SESSION['color'] = "info";
        header('Location: ?p=article&id=' . $article->getId());
    }

    /**
     * Retourne la vue avec tout les commentaires qui ont été signalés
     *
     * @return void
     */
    public function viewReportComment()
    {
        $comments = $this->commentRepository->findBy(['report' => 1]);
        $reportComment = count($comments);

        echo $this->twig->render('report.back.twig', [
            'comments' => $comments,
            'reportComment' => $reportComment
        ]);
    }

    /**
     * Validation d'un commentaire signalé
     *
     * @param integer $commentId -> Récupération de l'ID du commentaire
     * @return void
     */
    public function validReportComment(int $commentId)
    {
        $comment = $this->commentRepository->find($commentId);
        
        $comment->setReport(0);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $_SESSION['flash'] = 'Le commentaire à bien été validé';
        $_SESSION['color'] = 'success';
        header('Location: ?p=viewReportComment');
    }

    /**
     * Suppression d'un commentaire signalé
     *
     * @param integer $commentId -> Récupération de l'ID du commentaire
     * @return void
     */
    public function deleteReportComment(int $commentId)
    {
        $comment = $this->commentRepository->find($commentId);

        $this->entityManager->remove($comment);
        $this->entityManager->flush();

        $_SESSION['flash'] = 'Le commentaire à bien été supprimé';
        $_SESSION['color'] = 'success';
        header('Location: ?p=viewReportComment');
    }

}