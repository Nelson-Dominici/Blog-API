<?php

namespace app\Modules\User;

use Slim\Routing\RouteCollectorProxy;

$group->post("", [Controller::class, "store"]);
$group->post("/login", [Controller::class, "login"]);

$group->group("", function(RouteCollectorProxy $group): void
{
	$group->patch("", [Controller::class, "update"]);
	$group->delete("", [Controller::class, "destroy"]);
	
})->add(new \app\Middlewares\AuthenticateReqToken());