<?php

namespace app\Modules\User;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(Group $group) {

	$group->post("", [UserController::class, "store"]);

	$group->group("", function(Group $group): void {

		$group->patch("", [UserController::class, "update"]);
		$group->delete("", [UserController::class, "destroy"]);
		
	})->add(new \app\Middlewares\AuthenticateReqToken());
};