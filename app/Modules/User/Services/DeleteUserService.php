<?php 

namespace app\Modules\User\Services;

use app\Entitys\Users;
use app\Helpers\EntityManagerHelper;

class DeleteUserService
{

	public static function delete(string $userUuid): void
	{
		
		$entityManager = EntityManagerHelper::getEntityManager();

		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if ($user) {

		    $entityManager->remove($user);
		    $entityManager->flush();
		    
		}

	}
	
}