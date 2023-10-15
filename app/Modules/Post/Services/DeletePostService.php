<?php

namespace app\Modules\Post\Services;

use app\Entitys\{
	Posts,
	Users,
	Comments
};

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class DeletePostService
{
	public static function handle(string $postUuid, string $userUuid): void
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);

		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		if (!$user->getAdm()) {
			throw new AppException("Unauthorized user.", 401);
		}

		$postsRepository = $entityManager->getRepository(Posts::class);
		$commentRepository = $entityManager->getRepository(Comments::class);

		$affectedRows  = $postsRepository->createQueryBuilder("p")
			->delete()
			->where("p.uuid = :postUuid")
			->setParameter("postUuid", $postUuid)
			->getQuery()
			->execute();

		if ($affectedRows === 0) {
			throw new AppException("Post not found", 404);
		}

		$commentRepository->createQueryBuilder("c")
			->delete()
	    	->where("c.postUuid = :postUuid")
			->setParameter("postUuid", $postUuid)
			->getQuery()
			->execute();
	}
}