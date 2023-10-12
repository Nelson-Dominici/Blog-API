<?php

namespace app\Modules\Post\Services;

use app\Entitys\Posts;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class EditPostContenteService
{
	public static function handle(string $postUuid, array $reqBody): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$postRepository = $entityManager->getRepository(Posts::class);

		$poste = $postRepository->findOneBy([
		    "uuid" => $postUuid
		]);

		if (!$poste) {

			throw new AppException("Post uuid not found", 404);
		}

	    $poste->setContente($reqBody["newContente"]);
	    $entityManager->flush();
	}
}