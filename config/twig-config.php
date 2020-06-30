<?php

use Twig\Extra\String\StringExtension;

$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__, 1).'/app/View');
$twig = new Twig\Environment($loader, [
    # Mettre le cache à false pendant le dev
    'cache' =>  false,
]);
$twig->addExtension(new StringExtension());
$twig->addGlobal('session', $_SESSION);

/* ▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀ */
/* ----------------------------------● FILTRE TWIG POUR BADGE
/* ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄ */

$function = new \Twig\TwigFilter('badge', function ($string) {

    if(!empty($_SESSION['flash']))
    {
        return "<span id='flashMessage' class='badge badge-danger d-block mx-auto w-25 p-4 my-2'>$string</span>";
    } else {
        return null;
    }

}, ['is_safe' => ['html']]);

$twig->addFilter($function);

/* ▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀ */
/* ----------------------------------● FONCTION TWIG POUR FLASHMESSAGE
/* ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄ */

$flashMessage = new \Twig\TwigFunction('flashMessage', function () {

    if(!empty($_SESSION['flash']))
    {
        unset($_SESSION['flash']);
        unset($_SESSION['color']);
    }   

});

$twig->addFunction($flashMessage);

return $twig;