<?php

namespace app\Modules\User;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{

	public function login(Request $req, Response $res): Response
	{

		v::key(
			"email", v::stringType()::notEmpty()::email()
		)->key(
    		"password", v::notEmpty()::stringType()->length(6, null)	
    	)->assert($req->getParsedBody());

		$jwt = Services\loginUserService::loginUser($req->getParsedBody());

		return SendJson::send([
			"success" => true,
			"data" => ["token" => $jwt]
		]);

	}

	public function store(Request $req, Response $res): Response
	{

		v::key(
			"name", v::stringType()::notEmpty()
		)->key(
    		"email", v::stringType()::notEmpty()::email()	
    	)->key(
    		"password", v::notEmpty()::stringType()->length(6, null)	
    	)->assert($req->getParsedBody());

		Services\RegisterUserService::registerUser($req->getParsedBody());
		
		return SendJson::send(["success" => true]);

	}

	public function destroy(Request $req, Response $res): Response
	{
		
		$userUuid = $req->getAttribute("payload")->userUuid;
		Services\DeleteUserService::delete($userUuid);

		return SendJson::send(["success" => true]);

	}

	public function update(Request $req, Response $res): Response
	{

		v::key(
			"newName", v::stringType()->notEmpty()
    	)->assert($req->getParsedBody());
		
		Services\RenameUsernameService::renameUsername(
			$req->getParsedBody(),
			$req->getAttribute("payload")->userUuid
		);

		return SendJson::send(["success" => true]);

	}

}