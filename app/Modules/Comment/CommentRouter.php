<?php  

namespace app\Modules\Comment;

use Slim\Routing\RouteCollectorProxy;

$group->group("/{postUuid}/comments", function(RouteCollectorProxy $group): void {

	$group->get("", [CommentController::class, "index"]);

	$group->group("", function(RouteCollectorProxy $group): void {

		$group->post("", [CommentController::class, "store"]);
		$group->patch("", [CommentController::class, "update"]);		
		$group->delete("/{commentUuid}", [CommentController::class, "destroy"]);
		
	})->add(new \app\Middlewares\AuthenticateReqToken());

});