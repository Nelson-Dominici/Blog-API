<?php

namespace app\Modules\User\Account\Services;

use Ramsey\Uuid\Uuid;
use app\Entitys\Users;
use app\Helpers\EntityManagerHelper;

class RenameUsernameService
{

	public static function renameUsername(array $reqBody, string $userUuid): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);
		
		$user = $usersRepository->findOneBy([
		    "userUuid" => $userUuid
		]);

		if ($user) {

		    $user->setName($reqBody["newName"]);
		    $entityManager->flush();

		}

	}
	
}