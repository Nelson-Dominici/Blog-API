<?php

namespace app\Modules\User\Services;

use app\Entitys\Users;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class RenameUsernameService
{
	public static function handle(array $reqBody, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);
		
		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$user) {
			throw new AppException("User not found.");
		}

	    $user->setName($reqBody["newName"]);
	    $entityManager->flush();
	}
}