<?php

namespace app\Modules\Post\PostAdm\Services;

use Ramsey\Uuid\Uuid;
use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class AddPostService
{

	public static function addPost(array $reqBody): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();

		$posts = new Posts(new \DateTime(), Uuid::uuid4());

		$posts->setTitle($reqBody["title"]);
		$posts->setContente($reqBody["postContente"]);

		$entityManager->persist($posts);
		$entityManager->flush();
		
	}
	
}