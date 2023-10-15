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

	public function store(Request $request, Response $response): Response
	{
		v::key(
			"name", v::stringType()::notEmpty()->length(null, 100)
		)->key(
    		"email", v::stringType()::notEmpty()::email()->length(null, 100)	
    	)->key(
    		"password", v::notEmpty()::stringType()->length(6, 100)	
    	)->assert($request->getParsedBody());

		Services\RegisterUserService::handle($request->getParsedBody());
		
		return $this->jsonResponse(["success" => true]);
	}

	public function destroy(Request $request, Response $response): Response
	{
		Services\DeleteUserService::handle(
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}

	public function update(Request $request, Response $response): Response
	{
		v::key(
			"newName", v::stringType()->notEmpty()->length(null, 100)
    	)->assert($request->getParsedBody());
		
		Services\RenameUsernameService::handle(
			$request->getParsedBody(),
			$request->getAttribute("payload")->uuid
		);

		return $this->jsonResponse(["success" => true]);
	}
}