<?php

namespace app\Modules\Comment\Services;

use app\Entitys\{
	Users,
	Comments
};

use app\Helpers\EntityManagerHelper;

class GetCommentsService
{
	public static function handle(string $postUuid, array $queryParams): array
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$commentsRepository = $entityManager->getRepository(Comments::class);

		$skipQuery = intval($queryParams["skipQuery"] ?? 0) * 5;

		$queryBuilder = $commentsRepository->createQueryBuilder("c")
		    ->select("c.contente, c.uuid, u.name")
		    ->innerJoin(Users::class, "u", "WITH", "c.userUuid = u.uuid")
		    ->where("c.postUuid = :postUuid")
		    ->orderBy("c.date", "DESC")
		    ->setMaxResults(5)
		    ->setFirstResult($skipQuery)
		    ->setParameter("postUuid", $postUuid);

		$data = ["comments" => $queryBuilder->getQuery()->getResult()];

		return $data;
	}
}