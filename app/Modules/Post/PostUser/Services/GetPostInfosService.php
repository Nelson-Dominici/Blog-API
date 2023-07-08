<?php

namespace app\Modules\Post\PostUser\Services;

use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class GetPostInfosService
{

	public static function getInfos(array $urlParams): array|false
	{

		$entityManager = EntityManagerHelper::getEntityManager();
		$postsRepository = $entityManager->getRepository(Posts::class);

		$postUuid = $urlParams["postUuid"];

		$post = $postsRepository->findOneBy([
		    "postUuid" => $postUuid
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