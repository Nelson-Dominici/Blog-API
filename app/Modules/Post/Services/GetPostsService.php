<?php

namespace app\Modules\Post\Services;

use app\Entitys\{
	Users,
	Posts,
};

use app\Helpers\EntityManagerHelper;

class GetPostsService
{
	public static function handle(array $queryParams): array
	{
		$skipQuery = intval($queryParams["skipQuery"] ?? 0) * 5;

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$posts = $postsRepository->createQueryBuilder("p")
            ->select("p.title", "p.uuid", "u.name")
            ->innerJoin(Users::class, "u", "WITH", "p.userUuid = u.uuid")
            ->orderBy("p.date", "DESC")
            ->setMaxResults(5)
            ->setFirstResult($skipQuery)
			->getQuery()
			->getResult();

		return $posts;
	}
}