<?php

namespace app\Utils\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CheckTokenCookie
{

	public static function check(){

		if(!empty($_COOKIE["token"])){

			$token = $_COOKIE["token"];

			try {
				$payload = JWT::decode($token, new Key($_ENV["JWT_KEY"], "HS256"));
				return ["payload" => $payload];

			}catch (\Exception $e) {
				header("Location: /user/login");
			}
		}
	
		header("Location: /user/login");
	}
}