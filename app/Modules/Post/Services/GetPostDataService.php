<?php

namespace app\Modules\Post\Services;

use app\Entitys\Posts;

use app\Helpers\{
	AppException,
	EntityManagerHelper
};

class GetPostDataService
{
	public static function handle(array $urlParams): array|false
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$post = $postsRepository->findOneBy([
		    "uuid" => $urlParams["postUuid"]
		]);

		if (!$post) {
			throw new AppException("Post not found");
		}

		$parsedown = new \Parsedown();
		$content = $parsedown->text($post->getContent());

		return [
			"title" => $post->getTitle(),
			"content" => $content
		];
	}
}