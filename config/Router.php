<?php
# config/Router.php

namespace App\config;
use App\Controller\Controller;
use Exception;

class Router
{

    private $controller;

    public function __construct()
    {
        $this->controller = new Controller();
    }

    public function run()
    {

        if (isset($_GET['p']))
        {

            switch ($_GET['p'])
            {
                case "home" : 
                    $this->controller->getArticles();
                break;

                case "article" : 
                    $this->controller->getArticle($_GET['id']);
                break;

                case "addComment" :
                    $this->controller->addComment($_GET['id'], $_POST['content']);
                break;

                case "error404" :
                    header('HTTP/1.0 404 not found');
                break;

                default: throw new Exception("La page n'existe pas");
            }
        }
        else
        {
            $this->controller->getArticles();
        } 
        
    }

}