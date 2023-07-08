<?php

namespace app\Modules\Post\PostAdm\Services;

use app\Entitys\Posts;
use app\Helpers\AppException;
use app\Helpers\EntityManagerHelper;

class DeletePostService
{
	
	public static function deletePost(array $urlParams): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$post = $postsRepository->findOneBy([
		    "postUuid" => $urlParams["postUuid"]
		]);

		if (!$post) {

			throw new AppException("Post uuid not found", 404);
		}

    	$entityManager->remove($post);
	    $entityManager->flush();

	}

}