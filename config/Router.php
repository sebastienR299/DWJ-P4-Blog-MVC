<?php
# config/Router.php

namespace App\config;
use App\Controller\Controller;

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
                case "accueil" : 
                    $this->controller->getArticles();
                break;

                default:
                // require ('twig-config.php');
                // echo $twig->render('home.front.twig');
            }
        }
        else
        {
            $this->controller->getArticles();
        } 
        
    }

}