<?php

namespace app\Modules\Auth\Services;

use Firebase\JWT;

use app\Helpers\AppException;

class CheckJWTService
{
	static public function handle(string $token): void
	{
		$parts = explode(" ", $token);
		
		if ($parts[0] !== "Bearer" || empty($parts[1])) {
			throw new AppException("Invalid token.", 401);
		}

		try {

			JWT\JWT::decode(
				$parts[1], 
				new JWT\Key($_ENV["JWT_KEY"], "HS256"),
			);

		} catch (\Exception $e) {
			throw new AppException("Invalid token.", 401);
		}
	}
}