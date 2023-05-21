<?php

namespace app\Utils\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use app\Utils\AppException;

class CheckTokenHeaders
{

	public static function check(){

		if(!empty($_SERVER["HTTP_AUTHORIZATION"])){

			$token = $_SERVER["HTTP_AUTHORIZATION"];

			try {
				$payload = JWT::decode($token, new Key($_ENV["JWT_KEY"], "HS256"));
				return ["payload" => $payload];

			}catch (\Exception $e) {
				throw new AppException("You are not allowed", 400);
			}
		}
	
		throw new AppException("You are not allowed", 400);
	}
}