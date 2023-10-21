<?php

namespace app\Modules\Post;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(Group $group) {

	$group->get("", [PostController::class, "index"]);
	$group->get("/{postUuid}", [PostController::class, "show"]);

	$group->group("", function(Group $group): void {

		$group->post("", [PostController::class, "store"]);

		$group->group("/{postUuid}", function(Group $group): void {

			$group->delete("", [PostController::class, "destroy"]);
			$group->patch("/title", [PostController::class, "editTitle"]);
			$group->patch("/contente", [PostController::class, "editContente"]);

		});

	})->add(new \app\Middlewares\AuthenticateReqToken());
};