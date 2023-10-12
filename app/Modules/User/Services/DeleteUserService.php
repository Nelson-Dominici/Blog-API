<?php 

namespace app\Modules\User\Services;

use app\Entitys\Users;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class DeleteUserService
{
	public static function handle(string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();

		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$user) {
			throw new AppException("User not found.");
		}

	    $entityManager->remove($user);
	    $entityManager->flush();
	}
}