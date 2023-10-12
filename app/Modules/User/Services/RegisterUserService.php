<?php

namespace app\Modules\User\Services;

use Ramsey\Uuid\Uuid;

use app\Entitys\Users;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class RegisterUserService
{
	public static function handle(array $reqBody): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);
		
		$user = $usersRepository->findOneBy([
		    "email" => $reqBody["email"]
		]);

		if ($user) {
			throw new AppException("Email already registered.");
		}

		$user = new Users(Uuid::uuid4());

		$user->setName($reqBody["name"]);
		$user->setEmail($reqBody["email"]);
		$user->setPassword($reqBody["password"]);

		$entityManager->persist($user);
		$entityManager->flush();
	}
}