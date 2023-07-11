<?php

namespace app\Modules\Post\Comment\Services;

use Ramsey\Uuid\Uuid;
use app\Entitys\Posts;
use app\Entitys\Comments;
use app\Helpers\EntityManagerHelper;

class AddCommentService
{

	public static function comment(array $reqBody, string $userUuid): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$post = $postsRepository->findOneBy([
		    "postUuid" => $reqBody["postUuid"]
		]);

		if ($post) {

			$commentUuid = Uuid::uuid4();

			$comments = new Comments(new \DateTime(), $commentUuid);

			$comments->setUserUuid($userUuid);
			$comments->setPostUuid($reqBody["postUuid"]);
			$comments->setContente($reqBody["contente"]);

			$entityManager->persist($comments);
			$entityManager->flush();
		}

	}

} 