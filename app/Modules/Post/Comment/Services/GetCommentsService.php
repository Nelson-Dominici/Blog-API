<?php

namespace app\Modules\Post\Comment\Services;

use app\Entitys\Users;
use app\Entitys\Comments;
use app\Helpers\EntityManagerHelper;

class GetCommentsService
{

	public static function get(string $postUuid, array $queryParams): array
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$commentsRepository = $entityManager->getRepository(Comments::class);

		$skipQuery = intval($queryParams["skipQuery"] ?? 0) * 5;

		$qb = $commentsRepository->createQueryBuilder("c")
		    ->select("c.contente, c.commentUuid, u.name")
		    ->innerJoin(Users::class, "u", "WITH", "c.userUuid = u.userUuid")
		    ->where("c.postUuid = :postUuid")
		    ->orderBy("c.commentDate", "DESC")
		    ->setMaxResults(5)
		    ->setFirstResult($skipQuery)
		    ->setParameter("postUuid", $postUuid);

		$data = ["comments" => $qb->getQuery()->getResult()];

		return $data;

	}

}