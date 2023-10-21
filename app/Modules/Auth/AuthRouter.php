<?php

namespace app\Modules\Auth;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(Group $group) {
	
	$group->post("/login", [AuthController::class, "login"]);
	$group->post("/me/verify", [AuthController::class, "checkJWT"]);
};