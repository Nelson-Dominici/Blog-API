<?php

namespace app\Modules\Post\Services;

use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class GetPostInfosService
{

	public static function get(array $urlParams): array|false
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$postUuid = $urlParams["postUuid"];

		$post = $postsRepository->findOneBy([
		    "uuid" => $postUuid
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