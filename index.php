<?php

require_once("bootstrap.php");

$app->add($body);

require_once("app/routes.php");

$app->run();