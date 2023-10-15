<?php

use app\Helpers\EntityManagerHelper;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once "public/bootstrap.php";

$entityManager = EntityManagerHelper::getEntityManager();

ConsoleRunner::run(new SingleManagerProvider($entityManager));