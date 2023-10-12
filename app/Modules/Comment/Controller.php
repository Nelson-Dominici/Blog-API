<?php

namespace app\Modules\Comment;

use app\Helpers\ApiResponseTrait;

use Respect\Validation\Validator as v;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
}

class Controller
{
	use ApiResponseTrait;

	public function store(Request $req, Response $res): Response
	{
		v::key(
			"contente", v::stringType()->notEmpty()
		)->key(
    		"postUuid", v::stringType()->notEmpty()
    	)->assert($req->getParsedBody());

		Services\AddCommentService::handle(
			$req->getParsedBody(),
			$req->getAttribute("payload")->userUuid
		);

		return $this->success();
	}

	public function index(Request $req, Response $res, array $args): Response
	{
		$comments = Services\GetCommentsService::handle(
			$args["postUuid"], 
			$req->getQueryParams()
		);

		return $this->success($comments);
	}

	public function destroy(Request $req, Response $res, array $args): Response
	{

		var_dump($req->getAttribute("payload"));
		die();
		Services\DeleteCommentService::handle(
			$args, $req->getAttribute("payload")->userUuid
		);

		return $this->success();
	}

	public function update(Request $req, Response $res): Response
	{
		v::key(
			"newContente", v::stringType()->notEmpty()
		)->key(
    		"commentUuid", v::stringType()->notEmpty()
    	)->assert($req->getParsedBody());

		Services\EditPostCommentService::handle(
			$req->getParsedBody(), 
			$req->getAttribute("payload")->userUuid
		);

		return $this->success();
	}
}