<?php

namespace app\Modules\Post\Comment;
use Slim\Routing\RouteCollectorProxy;

$group->get(
	"/all/{postUuid}", [PostCommentController::class, "getComments"]
);

$group->group("", function(RouteCollectorProxy $group)
{

	$group->post("", [PostCommentController::class, "addPostComment"]);
	
	$group->patch(
		"/edit", [PostCommentController::class, "editPostComment"]
	);
	
	$group->delete(
		"/delete/{commentUuid}", 
		[PostCommentController::class, "deleteComment"]
	);
	
})->add(new \app\Middlewares\AuthenticateReqToken());