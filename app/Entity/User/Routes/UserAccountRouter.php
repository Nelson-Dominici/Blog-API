<?php

namespace app\Entity\User\Routes;

use Slim\Routing\RouteCollectorProxy;
use app\Entity\User\Controllers\UserAccountController;

return function($app): void
{

	$app->group("/user", function(RouteCollectorProxy $group){

		$group->get("/login", [UserAccountController::class, "loginView"]);
		$group->get("/register", [UserAccountController::class, "registerView"]);

		$group->post("/", [UserAccountController::class, "login"]);
		$group->post("/register", [UserAccountController::class, "register"]);

	});

};