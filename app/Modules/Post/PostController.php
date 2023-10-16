<?php

namespace app\Modules\Post;

use app\Helpers\ApiResponseTrait;

use Respect\Validation\Validator as v;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

class PostController
{
	use ApiResponseTrait;

	public function editContent(Request $request, Response $response, array $args): Response
	{
		v::key(
    		"newContent", v::stringType()->notEmpty()	
    	)->assert($request->getParsedBody());

		Services\EditPostContentService::handle(
			$args["postUuid"],
			$request->getParsedBody()
		);

		return $this->jsonResponse(["success" => true]);
	}
	
	public function editTitle(Request $request, Response $response, array $args): Response
	{
		v::key(
    		"newTitle", v::stringType()->notEmpty()->length(null, 100)
    	)->assert($request->getParsedBody());

		Services\EditPostTitleService::handle(
			$args["postUuid"],
			$request->getParsedBody()
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function store(Request $request, Response $response): Response
	{
		v::key(
			"title", v::stringType()->notEmpty()->length(null, 100)
		)->key(
    		"content", v::stringType()->notEmpty()	
    	)->assert($request->getParsedBody());

		Services\AddPostService::handle(
			$request->getParsedBody(),
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function destroy(Request $request, Response $response, array $args): Response
	{
		Services\DeletePostService::handle(
			$args["postUuid"],
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function index(Request $request, Response $response): Response
	{
		$posts = Services\GetPostsService::handle($request->getQueryParams());
		
		return $this->jsonResponse([
			"success" => true, 
			"data" => $posts
		]);
	}

	public function show(Request $request, Response $response, array $args): Response
	{
		$data = Services\GetPostDataService::handle($args);
		
		return $this->jsonResponse([
			"success" => true, 
			"data" => $data
		]);
	}
}