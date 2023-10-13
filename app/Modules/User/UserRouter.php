<?php

namespace app\Modules\User;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

$group->post("", [UserController::class, "store"]);
$group->post("/login", [UserController::class, "login"]);

$group->group("", function(Group $group): void {

	$group->patch("", [UserController::class, "update"]);
	$group->delete("", [UserController::class, "destroy"]);
	
})->add(new \app\Middlewares\AuthenticateReqToken());