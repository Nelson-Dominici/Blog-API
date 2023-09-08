<?php

namespace app\Modules\Comment;
use Slim\Routing\RouteCollectorProxy;

$group->get("/all/{postUuid}", [Controller::class, "index"]);

$group->group("", function(RouteCollectorProxy $group)
{

	$group->post("", [Controller::class, "store"]);
	$group->patch("/edit", [Controller::class, "update"]);
	
	$group->delete("/{commentUuid}", [Controller::class, "destroy"]);
	
})->add(new \app\Middlewares\AuthenticateReqToken());