<?php

use Twig\Extra\String\StringExtension;

$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__, 1).'/app/View');
$twig = new Twig\Environment($loader, [
    # Mettre le cache à false pendant le dev
    'cache' =>  false,
]);
$twig->addExtension(new StringExtension());
// $twig->addGlobal('session', $_SESSION);