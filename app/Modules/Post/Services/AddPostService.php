<?php

namespace app\Modules\Post\Services;

use Ramsey\Uuid\Uuid;

use app\Entitys\{
	Posts,
	Users
};

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class AddPostService
{
	public static function handle(array $reqBody, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$user->getAdm()) {
			throw new AppException("Unauthorized user.", 401);
		}

		$posts = new Posts(new \DateTime(), Uuid::uuid4());

		$posts->setUserUuid($userUuid);
		$posts->setTitle($reqBody["title"]);
		$posts->setContente($reqBody["contente"]);

		$entityManager->persist($posts);
		$entityManager->flush();
	}
}