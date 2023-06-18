<?php

namespace app\Entity\Post\Comment;

return function( $group )
{

	$group->get(

		"/getComments/{postId}", [PostCommentController::class, "get"]
	
	)->add(new \app\Middlewares\Token\CheckCookiePass());

	$group->group("", function( $group )
	{

		$group->post("", [PostCommentController::class, "addComment"]);
		
		$group->delete(
			"/delete/{commentId}", [PostCommentController::class, "deleteComment"]
		);
		
	})->add(new \app\Middlewares\Token\CheckCookieBlock());

};