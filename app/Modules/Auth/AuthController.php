<?php

namespace app\Modules\Auth;

use app\Helpers\ApiResponseTrait;

use Psr\Http\Message\{
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

use Respect\Validation\Validator as v;

class AuthController
{
	use ApiResponseTrait;

	public function login(Request $request, Response $response): Response
	{
		v::key(
			"email", v::stringType()::notEmpty()::email()->length(null, 100)
		)->key(
    		"password", v::notEmpty()::stringType()->length(6, 100)	
    	)->assert($request->getParsedBody());

		$jwt = Services\LoginUserService::handle($request->getParsedBody());

		return $this->jsonResponse([
			"success" => true,
			"data" => $jwt
		]);
	}

	public function checkJWT(Request $request, Response $response): Response
	{
		v::key(
			"token", v::stringType()::notEmpty()
		)->assert($request->getParsedBody());

		Services\CheckJWTService::handle(
			$request->getParsedBody()["token"]
		);

		return $this->jsonResponse(["success" => true]);
	}
}