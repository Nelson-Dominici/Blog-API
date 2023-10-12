<?php

namespace app\Modules\Post;

use Slim\Routing\RouteCollectorProxy;

$group->get("", [Controller::class, "index"]);
$group->get("/{postUuid}", [Controller::class, "show"]);

$group->group("", function(RouteCollectorProxy $group): void {

	$group->post("", [Controller::class, "store"]);

	$group->group("/{postUuid}", function(RouteCollectorProxy $group): void {

		$group->delete("", [Controller::class, "destroy"]);
		$group->patch("/title", [Controller::class, "editTitle"]);
		$group->patch("/contente", [Controller::class, "editContente"]);

	});

})->add(new \app\Middlewares\AuthenticateReqToken());