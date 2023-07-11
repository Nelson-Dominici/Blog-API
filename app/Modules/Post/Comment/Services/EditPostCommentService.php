<?php

namespace app\Modules\Post\Comment\Services;

use app\Entitys\Comments;
use app\Helpers\EntityManagerHelper;

class EditPostCommentService
{

	public static function editComment(array $reqBody, string $userUuid): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$commentsRepository = $entityManager->getRepository(Comments::class);

		$comment = $commentsRepository->findOneBy([
		    "commentUuid" => $reqBody["commentUuid"],
		    "userUuid" => $userUuid
		]);

		if ($comment) {

		    $comment->setContente($reqBody["newContente"]);
		    $entityManager->flush();

		}

	}

}