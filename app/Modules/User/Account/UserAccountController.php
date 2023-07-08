<?php

namespace app\Modules\User\Account;

use app\Helpers\SendJson;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserAccountController
{

	public function loginUser(Request $req, Response $res): Response
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

	public function registerUser(Request $req, Response $res): Response
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

}