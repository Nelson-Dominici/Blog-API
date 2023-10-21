<?php

require_once "bootstrap.php";

$routes = require_once __DIR__ . "/../app/routes.php";

$routes($app);

$app->run();