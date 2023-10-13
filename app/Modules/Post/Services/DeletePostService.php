<?php

namespace app\Modules\Post\Services;

use app\Entitys\{
	Posts,
	Comments
};

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class DeletePostService
{
	public static function handle(string $postUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();

		$postsRepository = $entityManager->getRepository(Posts::class);
		$commentRepository = $entityManager->getRepository(Comments::class);

		$post = $postsRepository->findOneBy([
		    "uuid" => $postUuid
		]);
		
		if (!$post) {
			
			throw new AppException("Post not found", 404);
		}

    	$entityManager->remove($post);
	    $entityManager->flush();

		$queryBuilder = $commentRepository->createQueryBuilder("e")
		->delete()
	    ->where("e.postUuid = :postUuid")
		->setParameter("postUuid", $postUuid);

		$queryBuilder->getQuery()->execute();
	}
}