<?php
# config/cli-config.php

namespace App\config;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);

return ConsoleRunner::createHelperSet($entityManager);