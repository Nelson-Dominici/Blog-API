<?php

namespace app\Entity\Post\Comment;

use app\Utils\SendJson;
use app\Utils\RenderView;
use Respect\Validation\Validator as v;

class PostCommentController
{
	
	public function addComment($req, $res)
	{

		v::key(
			"contente", v::notEmpty()
		)->key(
    		"postId", v::notEmpty()	
    	)->assert($req->getParsedBody());

		$commentId = Services\AddCommentService::comment(
			$req->getParsedBody(), 
			$req->getAttribute("payload")->userUuid
		);

		return SendJson::send([
		    "success" => true,
		    "data" => ["commentId" => $commentId]
		]);
		
	}

	public function get($req, $res, $args)
	{

		$comments = Services\GetCommentsService::get(
			$req,
			$args["postId"], 
		);

		return SendJson::send([
		    "success" => true,
			"data" => $comments
		]);
		
	}

	public function deleteComment($req, $res, $args)
	{

		Services\DeleteCommentService::delete(
			$args, $req->getAttribute("payload")->userUuid
		);

		return SendJson::send([
		    "success" => true
		]);
		
	}
	
}