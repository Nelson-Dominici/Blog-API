<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$app = Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();

$app->add(new \app\Middlewares\GetRequestbody());

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(new \app\Middlewares\HandleExceptions());