<?php

namespace app\Modules\Post;

use app\Helpers\ApiResponseTrait;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{
	use ApiResponseTrait;

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