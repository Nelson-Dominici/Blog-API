<?php  

namespace app\Modules\Comment;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(Group $group) {

	$group->group("/{postUuid}/comments", function(Group $group): void {

		$group->get("", [CommentController::class, "index"]);

		$group->group("", function(Group $group): void {

			$group->post("", [CommentController::class, "store"]);
			$group->patch("", [CommentController::class, "update"]);		
			$group->delete("/{commentUuid}", [CommentController::class, "destroy"]);
			
		})->add(new \app\Middlewares\AuthenticateReqToken());

	});

};