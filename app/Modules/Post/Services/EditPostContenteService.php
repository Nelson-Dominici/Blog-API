<?php

namespace app\Modules\Post\Services;

use app\Entitys\{
	Posts,
	Users
};

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class EditPostContenteService
{
	public static function handle(string $postUuid, array $reqBody): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$user->getAdm()) {
			throw new AppException("Unauthorized user.", 401);
		}

		$postRepository = $entityManager->getRepository(Posts::class);

		$post = $postRepository->findOneBy([
		    "uuid" => $postUuid
		]);

		if (!$post) {

			throw new AppException("Post uuid not found", 404);
		}

	    $post->setContente($reqBody["newContente"]);
	    $entityManager->flush();
	}
}