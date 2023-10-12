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
		$posts = Services\GetPostsService::get($req->getQueryParams());
		
		return $this->success($posts);
	}

	public function show(Request $req, Response $res, array $args): Response
	{
		$data = Services\GetPostInfosService::get($args);

		if ($data) {
			
			return $this->success($data);
			
		}

		return $this->error();
	}
}