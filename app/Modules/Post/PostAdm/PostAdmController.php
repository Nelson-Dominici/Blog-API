<?php

namespace app\Modules\Post\PostAdm;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostAdmController
{

	public function addPost(Request $req, Response $res): Response
	{

		if ($req->getAttribute("payload")->adm) {
			
			v::key(
				"title", v::stringType()::notEmpty()
			)->key(
	    		"postContente", v::stringType()::notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\AddPostService::addPost($req->getParsedBody());

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);

	}

	public function deletePost(Request $req, Response $res, array $args): Response
	{

		if ($req->getAttribute("payload")->adm) {

			v::key(
				"postUuid", v::number()::notEmpty()
			)->assert($args);

			Services\DeletePostService::deletePost($args);

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);
		
	}
	
}