<?php

namespace app\Entity\Contente\Services\UserPostServices;
use app\Utils\ConnectDB;

class GetService
{
	public static function get($queryParams): array
	{
	
		$skipQuery = 0;

		if(array_key_exists("skipQuery", $queryParams)){
			$skipQuery = intval($queryParams["skipQuery"]);
		}

		$skipQuery = $skipQuery * 5;

		$sql = "SELECT title, post_date, id FROM posts ORDER BY id DESC limit 5 offset :offset";

		$pdo = ConnectDB::connect()->prepare($sql);
		$pdo->bindValue(":offset", $skipQuery, \PDO::PARAM_INT);
		$pdo->execute();

		return $pdo->fetchAll(\PDO::FETCH_ASSOC);
	}
}