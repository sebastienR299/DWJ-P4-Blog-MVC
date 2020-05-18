<?php
# config/Router.php

namespace App\config;

use App\Controller\ArticleController;
use App\Controller\CommentController;
use App\Controller\UserController;
use Exception;

class Router
{

    private $ArticleController;
    private $UserController;
    private $CommentController;

    public function __construct()
    {
        $this->ArticleController = new ArticleController();
        $this->UserController = new UserController();
        $this->CommentController = new CommentController();
    }

    public function run()
    {

        if (isset($_GET['p']))
        {

            switch ($_GET['p'])
            {
                case "home" : 
                    $this->ArticleController->getArticles($_GET['page']);
                break;

                case "homeBack" :
                    $this->ArticleController->getArticles($_GET['page'], true);
                break;

                case "viewAddArticle" :
                    $this->ArticleController->viewAddArticle();
                break;

                case "viewUpdateArticle" :
                    $this->ArticleController->viewUpdateArticle();
                break;

                case "addArticle" : 
                    $this->ArticleController->addArticle();
                break;

                case "deleteArticle" :
                    $this->ArticleController->deleteArticle($_GET['id']);
                break;

                case "article" : 
                    $this->ArticleController->getArticle($_GET['id']);
                break;

                case "articleBack" :
                    $this->ArticleController->getArticle($_GET['id'], true);
                break;

                case "articleBackUpdate" :
                    $this->ArticleController->getArticleUpdate($_GET['id']);
                break;

                case "articleUpdateSave" :
                    $this->ArticleController->setArticleUpdateSave($_GET['id']);
                break;

                case "addComment" :
                    $this->CommentController->addComment($_GET['id'], $_POST['content']);
                break;

                case "reportComment" :
                    $this->CommentController->reportComment($_GET['id'], $_GET['idComment']);
                break;

                case "viewReportComment" :
                    $this->CommentController->viewReportComment();
                break;

                case "validReport" :
                    $this->CommentController->validReportComment($_GET['id']);
                break;

                case "deleteReport" :
                    $this->CommentController->deleteReportComment($_GET['id']);
                break;

                case "connexion" :
                    $this->UserController->login();
                break;

                case "inscription" : 
                    $this->UserController->getInscription();
                break;

                case "register" : 
                    $this->UserController->register();
                break;

                case "signIn" : 
                    $this->UserController->signIn();
                break;

                case "logout" :
                    $this->UserController->logout();
                break;

                case "error404" :
                    header('HTTP/1.0 404 not found');
                break;

                default: throw new Exception("La page n'existe pas");
            }
        }
        else
        {
            $this->ArticleController->getArticles($_GET['page'] = 1, false);
        } 
        
    }

}

