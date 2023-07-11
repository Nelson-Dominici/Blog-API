<?php

namespace app\Modules\User\Account;
use Slim\Routing\RouteCollectorProxy;

$group->post("/login", [UserAccountController::class, "loginUser"]);
$group->post("/register", [UserAccountController::class, "registerUser"]);

$group->group("", function(RouteCollectorProxy $group): void
{

	$group->patch("/rename", [UserAccountController::class, "renameUsername"]);
	$group->delete("/delete", [UserAccountController::class, "deleteAccount"]);
	
})->add(new \app\Middlewares\AuthenticateReqToken());