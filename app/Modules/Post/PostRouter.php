<?php

namespace app\Modules\Post;

use Slim\Routing\RouteCollectorProxy;

$group->get("", [PostController::class, "index"]);
$group->get("/{postUuid}", [PostController::class, "show"]);

$group->group("", function(RouteCollectorProxy $group): void {

	$group->post("", [PostController::class, "store"]);

	$group->group("/{postUuid}", function(RouteCollectorProxy $group): void {

		$group->delete("", [PostController::class, "destroy"]);
		$group->patch("/title", [PostController::class, "editTitle"]);
		$group->patch("/contente", [PostController::class, "editContente"]);

	});

})->add(new \app\Middlewares\AuthenticateReqToken());