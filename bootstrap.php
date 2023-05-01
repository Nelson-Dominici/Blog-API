<?php 

require_once("./vendor/autoload.php");

use app\Framework\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
 
$app = new App();