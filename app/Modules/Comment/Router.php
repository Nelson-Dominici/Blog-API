<?php  

namespace app\Modules\Comment;

use Slim\Routing\RouteCollectorProxy;

$group->group("/{postUuid}/comments", function(RouteCollectorProxy $group): void {

	$group->get("", [Controller::class, "index"]);

	$group->group("", function(RouteCollectorProxy $group): void {

		$group->post("", [Controller::class, "store"]);
		$group->patch("", [Controller::class, "update"]);		
		$group->delete("/{commentUuid}", [Controller::class, "destroy"]);
		
	})->add(new \app\Middlewares\AuthenticateReqToken());

});