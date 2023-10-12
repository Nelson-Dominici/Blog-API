<?php

namespace app\Modules\Post;

use app\Helpers\ApiResponseTrait;

use Respect\Validation\Validator as v;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

class Controller
{
	use ApiResponseTrait;

	public function editContente(Request $req, Response $res, array $args): Response
	{
		if ($req->getAttribute("payload")->adm) {

			v::key(
	    		"newContente", v::stringType()->notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\EditPostContenteService::handle(
				$args["postUuid"],
				$req->getParsedBody()
			);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}
	
	public function editTitle(Request $req, Response $res, array $args): Response
	{
		if ($req->getAttribute("payload")->adm) {

			v::key(
	    		"newTitle", v::stringType()->notEmpty()->length(null, 100)
	    	)->assert($req->getParsedBody());

			Services\EditPostTitleService::handle(
				$args["postUuid"],
				$req->getParsedBody()
			);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function store(Request $req, Response $res): Response
	{
		if ($req->getAttribute("payload")->adm) {
			
			v::key(
				"title", v::stringType()->notEmpty()->length(null, 100)
			)->key(
	    		"contente", v::stringType()->notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\AddPostService::handle($req->getParsedBody());

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function destroy(Request $req, Response $res, array $args): Response
	{
		if ($req->getAttribute("payload")->adm) {

			Services\DeletePostService::handle($args["postUuid"]);

			return $this->success();
		}
        
		return $this->error("Unauthorized user.", 401);
	}

	public function index(Request $req, Response $res): Response
	{
		$posts = Services\GetPostsService::handle($req->getQueryParams());
		
		return $this->success($posts);
	}

	public function show(Request $req, Response $res, array $args): Response
	{
		$data = Services\GetPostDataService::handle($args);
		
		return $this->success($data);
	}
}