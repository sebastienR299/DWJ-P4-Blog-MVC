<?php
# config/Router.php

namespace App\config;

class Router
{

    public function run()
    {
        require 'twig-config.php';
        echo $twig->render('home.front.twig');
    }

}