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