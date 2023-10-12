<?php

namespace app\Modules\Comment\Services;

use app\Entitys\{
	Posts,
	Comments
};

use Ramsey\Uuid\Uuid;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class AddCommentService
{
	public static function handle(array $reqBody, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();

		$userRepository = $entityManager->getRepository(User::class);
		$postsRepository = $entityManager->getRepository(Posts::class);

		$post = $postsRepository->findOneBy([
		    "uuid" => $reqBody["postUuid"]
		]);

		$user = $userRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$post || !$user) {
			throw new AppException("Post or user does not exist.");
		}

		$commentUuid = Uuid::uuid4();

		$comments = new Comments(new \DateTime(), $commentUuid);

		$comments->setUserUuid($userUuid);
		$comments->setPostUuid($reqBody["postUuid"]);
		$comments->setContente($reqBody["contente"]);

		$entityManager->persist($comments);
		$entityManager->flush();
	}
} 