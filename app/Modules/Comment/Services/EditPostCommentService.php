<?php

namespace app\Modules\Comment\Services;

use app\Entitys\Comments;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class EditPostCommentService
{
	public static function handle(array $reqBody, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$commentsRepository = $entityManager->getRepository(Comments::class);

		$comment = $commentsRepository->findOneBy([
		    "uuid" => $reqBody["commentUuid"],
		    "userUuid" => $userUuid
		]);

		if (!$comment) {
			throw new AppException("Comment not found.");
		}

	    $comment->setContente($reqBody["newContente"]);
	    $entityManager->flush();
	}
}