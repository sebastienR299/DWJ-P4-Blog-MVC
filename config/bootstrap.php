<?php
# config/bootstrap.php

# Include Composer Autoload
require_once dirname(__DIR__,1) . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

# Path to Entity files
$paths = array("/path/to/entity-files");
$isDevMode = false;

# Connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'charset'  => 'utf8',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'blog_mvc',
    'port'     => '3308',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);