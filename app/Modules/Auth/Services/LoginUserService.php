<?php 

namespace app\Modules\Auth\Services;

use Firebase\JWT\JWT;

use app\Entitys\Users;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class LoginUserService
{
	public static function handle(array $reqBody): string
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "email" => $reqBody["email"]
		]);

		if (!$user) {
			throw new AppException("Password or Email are incorrect.");
		}

		if (!password_verify($reqBody["password"], $user->getPassword())) {
			throw new AppException("Password or Email are incorrect.");
		}

		$payload = [
		    "uuid" => $user->getUuid(),
		    "exp" => time() + (8 * 24 * 60 * 60)
		];

		return JWT::encode($payload, $_ENV["JWT_KEY"], "HS256");
	}
}