<?php

require_once("bootstrap.php");
use app\Utils\AppException;

try {
 
    $routes = require_once("app/Routes.php");
    $routes($app);

} catch (AppException $e) {
    
    $e->sendException();
}