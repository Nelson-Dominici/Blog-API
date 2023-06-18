<?php

namespace app\Middlewares\Token;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CheckCookiePass
{

    public function __invoke($request, $handler)
    {

		$payload = false;

		if (!empty($_COOKIE["token"])){

			try {

				$token = $_COOKIE["token"];
				$payload = JWT::decode($token, new Key($_ENV["JWT_KEY"], "HS256"));
				
			} catch (\Exception $e) {

				$payload = false;
			}

		}
		
		$request = $request->withAttribute("payload", $payload);
	  	return $handler->handle($request);

    }

}
