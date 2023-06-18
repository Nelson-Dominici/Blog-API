<?php

namespace app\Middlewares\Token;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Exception\HttpNotFoundException;

class CheckCookieBlock
{

    public function __invoke($request, $handler)
    {

		if (!empty($_COOKIE["token"])){

			try {
			
				$token = $_COOKIE["token"];
				$payload = JWT::decode($token, new Key($_ENV["JWT_KEY"], "HS256"));
				$request = $request->withAttribute("payload", $payload);
			
	  			return $handler->handle($request);

			} catch (\Exception $e) {

				throw new HttpNotFoundException($request);
			}
		}

		throw new HttpNotFoundException($request);

    }

}
