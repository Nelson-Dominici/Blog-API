<?php 

namespace app\Modules\User\Account\Services;

use app\Entitys\Users;
use app\Helpers\EntityManagerHelper;

class DeleteAccountService
{

	public static function delete(string $userUuid): void
	{
		
		$entityManager = EntityManagerHelper::getEntityManager();

		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "userUuid" => $userUuid
		]);

		if ($user) {

		    $entityManager->remove($user);
		    $entityManager->flush();
		    
		}

	}
	
}