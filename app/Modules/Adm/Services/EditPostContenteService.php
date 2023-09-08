<?php

namespace app\Modules\Adm\Services;

use app\Entitys\Posts;
use app\Helpers\AppException;
use app\Helpers\EntityManagerHelper;

class EditPostContenteService
{

	public static function edit(array $reqBody): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postRepository = $entityManager->getRepository(Posts::class);

		$poste = $postRepository->findOneBy([
		    "uuid" => $reqBody["postUuid"]
		]);

		if (!$poste) {

			throw new AppException("Post uuid not found", 404);

		}

	    $poste->setContente($reqBody["newContente"]);
	    $entityManager->flush();
		
	}
	
}