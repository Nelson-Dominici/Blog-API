<?php

namespace app\Modules\User;

use app\Helpers\ApiResponseTrait;

use Respect\Validation\Validator as v;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

class UserController
{
	use ApiResponseTrait;

	public function login(Request $req, Response $res): Response
	{
		v::key(
			"email", v::stringType()::notEmpty()::email()->length(null, 100)
		)->key(
    		"password", v::notEmpty()::stringType()->length(6, 100)	
    	)->assert($req->getParsedBody());

		$jwt = Services\LoginUserService::handle($req->getParsedBody());

		return $this->success($jwt);
	}

	public function store(Request $req, Response $res): Response
	{
		v::key(
			"name", v::stringType()::notEmpty()->length(null, 100)
		)->key(
    		"email", v::stringType()::notEmpty()::email()->length(null, 100)	
    	)->key(
    		"password", v::notEmpty()::stringType()->length(6, 100)	
    	)->assert($req->getParsedBody());

		Services\RegisterUserService::handle($req->getParsedBody());
		
		return $this->success();
	}

	public function destroy(Request $req, Response $res): Response
	{
		$userUuid = $req->getAttribute("payload")->userUuid;

		Services\DeleteUserService::handle($userUuid);

		return $this->success();
	}

	public function update(Request $req, Response $res): Response
	{
		v::key(
			"newName", v::stringType()->notEmpty()->length(null, 100)
    	)->assert($req->getParsedBody());
		
		Services\RenameUsernameService::handle(
			$req->getParsedBody(),
			$req->getAttribute("payload")->userUuid
		);

		return $this->success();
	}
}