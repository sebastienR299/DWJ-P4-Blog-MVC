<?php
# public/index.php

session_start();

require_once dirname(__DIR__,1) . '/vendor/autoload.php';

use App\config\Router;

$router = new Router;
$router->run();