<?php

namespace app\Modules\Adm\Services;

use Ramsey\Uuid\Uuid;
use app\Entitys\Posts;
use app\Helpers\EntityManagerHelper;

class AddPostService
{

	public static function add(array $reqBody): void
	{

		$entityManager = EntityManagerHelper::getEntityManager();

		$posts = new Posts(new \DateTime(), Uuid::uuid4());

		$posts->setTitle($reqBody["title"]);
		$posts->setContente($reqBody["contente"]);

		$entityManager->persist($posts);
		$entityManager->flush();
		
	}
	
}