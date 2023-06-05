<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Psr7\Response;

return function($request, $handler)
{

	$res = new Response();

	if (!empty($_COOKIE["token"])){

		$token = $_COOKIE["token"];

		$payload = JWT::decode($token, new Key($_ENV["JWT_KEY"], "HS256"));
		$request = $request->withAttribute("payload", $payload);
   			
   		return $handler->handle($request);
	}

    return $res->withHeader("Location", "/home")->withStatus(302);
};