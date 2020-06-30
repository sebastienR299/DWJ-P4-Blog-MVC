<?php
# config/Router.php

namespace App\config;

use App\Controller\ArticleController;
use App\Controller\CommentController;
use App\Controller\UserController;
use Exception;

use function GuzzleHttp\Psr7\str;

define("URL", str_replace("index.php","",(isset($_SERVER["HTTPS"]) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

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

        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));

        if (isset($_GET['p']))
        {

            switch ($url[0])
            {
                case "home" : 
                    if(isset($url[1]) && ctype_digit($url[1])) {
                        $this->ArticleController->getArticles($url[1]);
                    } else {
                        header('Location: /home/1');
                    }
                break;

                case "homeBack" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->ArticleController->getArticles($url[1], true);
                        } else {
                            header('Location: /homeBack/1');
                        }
                    } else {
                        header('Location: /home/1');
                    }
                    
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
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->ArticleController->deleteArticle($url[1]);
                        } else {
                            header('Location: /homeBack/1');
                        }
                    } else {
                        header('Location: /home/1');
                    }
                break;

                case "article" :
                    if(isset($url[1]) && isset($url[2]) && ctype_digit($url[2])) {
                            $this->ArticleController->getArticle($url[2]);
                    } else {
                        header('Location: /home/1');
                    }
                break;

                case "articleBack" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && isset($url[2]) && ctype_digit($url[2])) {
                            $this->ArticleController->getArticle($url[2], true);
                        } else {
                            header('Location: /homeBack/1');
                        }
                    } else {
                        header('Location: /home/1');
                    }
                    
                break;

                case "articleBackUpdate" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->ArticleController->getArticleUpdate($url[1]);
                        } else {
                            header('Location: /homeBack/1');
                        }  
                    } else {
                        header('Location: /home/1');
                    }
                    
                break;

                case "articleUpdateSave" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->ArticleController->setArticleUpdateSave($url[1]);
                        } else {
                            header('Location: /homeBack/1');
                        }
                    } else {
                        header('Location: /home/1');
                    }
                    
                break;

                case "addComment" :
                    if($_SESSION['logged'] === true) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->CommentController->addComment($url[1], $_POST['content'], false);
                        }
                    }
                break;
            
                case "reportComment" :
                    if($_SESSION['logged'] === true) {
                        if(isset($url[1]) && isset($url[2]) && ctype_digit($url[1]) && ctype_digit($url[2])) {
                            $this->CommentController->reportComment($url[1], $url[2]);
                        }
                    }
                break;

                case "viewReportComment" :
                    $this->CommentController->viewReportComment();
                break;

                case "validReport" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->CommentController->validReportComment($url[1]);
                        }
                    }
                break;

                case "deleteReport" :
                    if($_SESSION['admin'] == 1) {
                        if(isset($url[1]) && ctype_digit($url[1])) {
                            $this->CommentController->deleteReportComment($url[1]);
                        }
                    }
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
                    $this->UserController->signIn($_POST['email'], $_POST['password']);
                break;

                case "logout" :
                    $this->UserController->logout();
                break;

                case "error404" :
                    header('HTTP/1.0 404 not found');
                break;

                default: $this->ArticleController->error404();
            }
        }
        else
        {
            header('Location: /home/1');
        } 
        
    }

}

