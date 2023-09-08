<?php

namespace app\Modules\Adm;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{

	public function store(Request $req, Response $res): Response
	{

		if ($req->getAttribute("payload")->adm) {
			
			v::key(
				"title", v::stringType()->notEmpty()
			)->key(
	    		"contente", v::stringType()->notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\AddPostService::add($req->getParsedBody());

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);

	}

	public function destroy(Request $req, Response $res, array $args): Response
	{

		if ($req->getAttribute("payload")->adm) {

			Services\DeletePostService::delete($args);

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);
		
	}

	public function editContente(Request $req, Response $res): Response
	{

		if ($req->getAttribute("payload")->adm) {

			v::key(
				"postUuid", v::stringType()->notEmpty()
			)->key(
	    		"newContente", v::stringType()->notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\EditPostContenteService::edit($req->getParsedBody());

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);
		
	}
	
	public function editTitle(Request $req, Response $res): Response
	{

		if ($req->getAttribute("payload")->adm) {

			v::key(
				"postUuid", v::stringType()->notEmpty()
			)->key(
	    		"newTitle", v::stringType()->notEmpty()	
	    	)->assert($req->getParsedBody());

			Services\EditPostTitleService::edit($req->getParsedBody());

			return SendJson::send(["success" => true]);

		}
        
		return SendJson::send(["success" => false]);
		
	}
	
}