<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use app\Helpers\EntityManagerHelper;

require_once("bootstrap.php");

$entityManager = EntityManagerHelper::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
