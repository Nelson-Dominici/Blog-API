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

		$comment = $commentRepository->findOneBy([
		    "userUuid" => $userUuid,
		    "uuid" => $commentUuid
		]);

		if (!$comment) {
			throw new AppException("Comment not found.");
		}

	    $entityManager->remove($comment);
	    $entityManager->flush();
	}
} 