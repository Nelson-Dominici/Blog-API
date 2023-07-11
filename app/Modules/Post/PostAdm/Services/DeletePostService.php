<?php

namespace app\Modules\Post\PostAdm\Services;

use app\Entitys\Posts;
use app\Entitys\Comments;
use app\Helpers\AppException;
use app\Helpers\EntityManagerHelper;

class DeletePostService
{
	
	public static function deletePost(array $urlParams): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();

		$postsRepository = $entityManager->getRepository(Posts::class);
		$commentRepository = $entityManager->getRepository(Comments::class);

		$post = $postsRepository->findOneBy([
		    "postUuid" => $urlParams["postUuid"]
		]);

		if (!$post) {
			
			throw new AppException("Post uuid not found", 404);

		}

    	$entityManager->remove($post);
	    $entityManager->flush();

		$queryBuilder = $commentRepository->createQueryBuilder("e")
		->delete()
	    ->where("e.postUuid = :postUuid")
		->setParameter("postUuid", $urlParams["postUuid"]);

		$queryBuilder->getQuery()->execute();

	}

}