<?php

namespace app\Modules\Comment\Services;

use app\Entitys\Comments;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class DeleteCommentService
{
	public static function handle(string $commentUuid, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$commentRepository = $entityManager->getRepository(Comments::class);

		$affectedRows = $commentRepository->createQueryBuilder("c")
		    ->delete()
		    ->where("c.uuid = :commentUuid")
		    ->andWhere("c.userUuid = :userUuid")
		    ->setParameter("commentUuid", $commentUuid)
		    ->setParameter("userUuid", $userUuid)
		    ->getQuery()
		    ->execute();

		if ($affectedRows === 0) {
			throw new AppException("Comment not found.");
		}
	}
} 