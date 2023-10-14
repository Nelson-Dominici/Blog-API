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

	public function editContente(Request $request, Response $response, array $args): Response
	{
		if ($request->getAttribute("payload")->adm) {

			v::key(
	    		"newContente", v::stringType()->notEmpty()	
	    	)->assert($request->getParsedBody());

			Services\EditPostContenteService::handle(
				$args["postUuid"],
				$request->getParsedBody()
			);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}
	
	public function editTitle(Request $request, Response $response, array $args): Response
	{
		if ($request->getAttribute("payload")->adm) {

			v::key(
	    		"newTitle", v::stringType()->notEmpty()->length(null, 100)
	    	)->assert($request->getParsedBody());

			Services\EditPostTitleService::handle(
				$args["postUuid"],
				$request->getParsedBody()
			);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function store(Request $request, Response $response): Response
	{
		if ($request->getAttribute("payload")->adm) {
			
			v::key(
				"title", v::stringType()->notEmpty()->length(null, 100)
			)->key(
	    		"contente", v::stringType()->notEmpty()	
	    	)->assert($request->getParsedBody());

			Services\AddPostService::handle(
				$request->getParsedBody(),
				$request->getAttribute("payload")->uuid
			);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function destroy(Request $request, Response $response, array $args): Response
	{
		if ($request->getAttribute("payload")->adm) {

			Services\DeletePostService::handle($args["postUuid"]);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function index(Request $request, Response $response): Response
	{
		$posts = Services\GetPostsService::handle($request->getQueryParams());
		
		return $this->success($posts);
	}

	public function show(Request $request, Response $response, array $args): Response
	{
		$data = Services\GetPostDataService::handle($args);
		
		return $this->success($data);
	}
}