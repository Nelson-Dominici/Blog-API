<?php

namespace app\Modules\Post\PostAdm\Services;

use app\Entitys\Posts;
use app\Helpers\AppException;
use app\Helpers\EntityManagerHelper;

class EditPostTitleService
{

	public static function editTitle(array $reqBody): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postRepository = $entityManager->getRepository(Posts::class);

		$poste = $postRepository->findOneBy([
		    "postUuid" => $reqBody["postUuid"]
		]);

		if (!$poste) {

			throw new AppException("Post uuid not found", 404);

		}

	    $poste->setTitle($reqBody["newContente"]);
	    $entityManager->flush();
		
	}
	
}