<?php

namespace app\Modules\Post\Comment;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostCommentController
{
	
	public function addPostComment(Request $req, Response $res): Response
	{

		v::key(
			"contente", v::stringType()->notEmpty()
		)->key(
    		"postUuid", v::number()->notEmpty()
    	)->assert($req->getParsedBody());

		$data = Services\AddCommentService::comment(
			$req->getParsedBody(),
			$req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);

	}

	public function getComments(Request $req, Response $res, array $args): Response
	{

		$comments = Services\GetCommentsService::get(
			$args["postUuid"], 
			$req->getQueryParams()
		);

		return SendJson::send([
			"success" => true,
			"data" => $comments
		]);

	}

	public function deleteComment(Request $req, Response $res, array $args): Response
	{

		Services\DeleteCommentService::delete(
			$args, $req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);
		
	}

	public function editPostComment(Request $req, Response $res): Response
	{

		v::key(
			"newContente", v::stringType()->notEmpty()
		)->key(
    		"commentUuid", v::stringType()->notEmpty()
    	)->assert($req->getParsedBody());

		Services\EditPostCommentService::editComment(
			$req->getParsedBody(), 
			$req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);
		
	}

}