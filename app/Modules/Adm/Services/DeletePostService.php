<?php

namespace app\Modules\Adm\Services;

use app\Entitys\Posts;
use app\Entitys\Comments;
use app\Helpers\AppException;
use app\Helpers\EntityManagerHelper;

class DeletePostService
{
	
	public static function delete(array $urlParams): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();

		$postsRepository = $entityManager->getRepository(Posts::class);
		$commentRepository = $entityManager->getRepository(Comments::class);

		$post = $postsRepository->findOneBy([
		    "uuid" => $urlParams["postUuid"]
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