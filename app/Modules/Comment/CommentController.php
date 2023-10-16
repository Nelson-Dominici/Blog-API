<?php

namespace app\Modules\Comment;

use app\Helpers\ApiResponseTrait;

use Respect\Validation\Validator as v;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

class CommentController
{
	use ApiResponseTrait;

	public function store(Request $request, Response $resposnse, array $args): Response
	{
		v::key(
			"content", v::stringType()->notEmpty()
		)->assert($request->getParsedBody());

		Services\AddCommentService::handle(
			$args["postUuid"],
			$request->getParsedBody(),
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function index(Request $request, Response $resposnse, array $args): Response
	{
		$comments = Services\GetCommentsService::handle(
			$args["postUuid"], 
			$request->getQueryParams()
		);

		return $this->jsonResponse([
			"success" => true,
			"data" => $comments
		]);
	}

	public function destroy(Request $request, Response $resposnse, array $args): Response
	{
		Services\DeleteCommentService::handle(
			$args["commentUuid"], $request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function update(Request $request, Response $resposnse): Response
	{
		v::key(
			"newContent", v::stringType()->notEmpty()
		)->key(
    		"commentUuid", v::stringType()->notEmpty()
    	)->assert($request->getParsedBody());

		Services\EditPostCommentService::handle(
			$request->getParsedBody(), 
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}
}