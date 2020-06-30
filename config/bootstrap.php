<?php
# config/bootstrap.php

namespace App\config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

# Include Composer Autoload
require dirname(__DIR__,1) . '/vendor/autoload.php';

# Path to Entity files
$paths = array(dirname(__DIR__,1) . '/app/Entity');
$isDevMode = true;

# Connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'db5000512480.hosting-data.io',
    'charset'  => 'utf8',
    'user'     => 'dbu847385',
    'password' => 'H5ed1ubg@',
    'dbname'   => 'dbs491851',
    'port'     => '3306',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;