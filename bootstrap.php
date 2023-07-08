<?php 

require_once("./vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();

$app->add(new \app\Middlewares\GetReqbody());

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(new \app\Middlewares\HandleExceptions());