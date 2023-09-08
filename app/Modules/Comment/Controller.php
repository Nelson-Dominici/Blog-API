<?php

namespace app\Modules\Comment;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{
	
	public function store(Request $req, Response $res): Response
	{

		v::key(
			"contente", v::stringType()->notEmpty()
		)->key(
    		"postUuid", v::stringType()->notEmpty()
    	)->assert($req->getParsedBody());

		$data = Services\AddCommentService::add(
			$req->getParsedBody(),
			$req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);

	}

	public function index(Request $req, Response $res, array $args): Response
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

	public function destroy(Request $req, Response $res, array $args): Response
	{

		Services\DeleteCommentService::delete(
			$args, $req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);
		
	}

	public function update(Request $req, Response $res): Response
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