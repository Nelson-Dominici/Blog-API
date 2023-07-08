<?php

namespace app\Modules\Post\Comment;

$group->get(
	"/getComments/{postUuid}", [PostCommentController::class, "getComments"]
);

$group->group("", function($group)
{

	$group->post("", [PostCommentController::class, "addComment"]);
	
	$group->delete(
		"/delete/{commentUuid}", [PostCommentController::class, "deleteComment"]
	);
	
})->add(new \app\Middlewares\AuthenticateReqToken());