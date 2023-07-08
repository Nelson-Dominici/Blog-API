<?php

namespace app\Modules\Post\PostUser\Services;

use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class GetPostsService
{
	
	public static function get(array $queryParams): array
	{
	
		$skipQuery = intval($queryParams["skipQuery"] ?? 0) * 5;

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$posts = $postsRepository->createQueryBuilder("p")
            ->select("p.title", "p.postUuid")
            ->orderBy("p.postDate", "DESC")
            ->setMaxResults(5)
            ->setFirstResult($skipQuery);

		return $posts->getQuery()->getResult();
		
	}

}