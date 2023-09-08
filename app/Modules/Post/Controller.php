<?php

namespace app\Modules\Post;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{

	public function index(Request $req, Response $res): Response
	{

		$posts = Services\GetPostsService::get($req->getQueryParams());
		
		return SendJson::send([
		    "success" => true,
			"data" => $posts
		]);
		
	}

	public function show(Request $req, Response $res, array $args): Response
	{

		$data = Services\GetPostInfosService::get($args);

		if ($data) {
			
			return SendJson::send([
			    "success" => true,
				"data" => $data
			]);
			
		}

		return SendJson::send(["success" => false]);

	}
	
}