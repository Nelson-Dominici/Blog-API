<?php

namespace app\Modules\Post\Services;

use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class GetPostDataService
{
	public static function get(array $urlParams): array|false
	{
		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$post = $postsRepository->findOneBy([
		    "uuid" => $urlParams["postUuid"]
		]);

		if (!$post) {
			return false;
		}

		$parsedown = new \Parsedown();
		$contente = $parsedown->text($post->getContente());

		return [
			"title" => $post->getTitle(),
			"contente" => $contente
		];
	}
}