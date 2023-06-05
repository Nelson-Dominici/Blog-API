<?php 

require_once("./vendor/autoload.php");

$body = require_once("app/Middlewares/reqBody.php");
$handleErros = require_once("app/Middlewares/handleErros.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($handleErros);