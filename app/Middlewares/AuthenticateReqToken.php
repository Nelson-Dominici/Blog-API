<?php

namespace app\Middlewares;

use Firebase\JWT;

use Psr\Http\Message\{ 
	ResponseInterface as Response,
	ServerRequestInterface as Request
};

use app\Helpers\AppException;

use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthenticateReqToken
{
    public function __invoke(Request $req, RequestHandler $handler): Response
    {
    	$headers = $req->getHeaders();

		if (
			!array_key_exists("Authorization", $headers) || 
			!$headers["Authorization"][0]
		) {
			throw new AppException("Not Authorized.", 401);
		}

		$token = $headers["Authorization"][0];

		$parts = explode(" ", $token);

		if ($parts[0] != "Bearer" || empty($parts[1])) {

			throw new AppException("Invalid token.", 401);
		}

		$tokenPayload = null;
	
		try {

			$tokenPayload = JWT\JWT::decode(
				$parts[1], 
				new JWT\Key($_ENV["JWT_KEY"], "HS256"),
			);

		} catch (\Exception $e) {
			throw new AppException("Invalid token.", 401);
		}

		$req = $req->withAttribute("payload", $tokenPayload);

	  	return $handler->handle($req);
    }
}