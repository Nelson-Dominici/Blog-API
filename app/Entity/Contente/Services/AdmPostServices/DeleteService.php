<?php

namespace app\Entity\Contente\Services\AdmPostServices;

use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class DeleteService
{
	
	private static function validData($req, array $urlParams): void
	{

		if (
			!array_key_exists("postId", $urlParams) ||
			!$urlParams["postId"]
		) throw new HttpBadRequestException($req, "Post id is required");
	}	

	public static function delete($req, array $urlParams): void
	{

		self::validData($req, $urlParams);

		$sql = "DELETE FROM posts WHERE id = ?";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $urlParams["postId"]);
		$pdo->execute();

		if ($pdo->rowCount() <= 0)
		 	throw new HttpBadRequestException($req, "Post uuid not found");
	}
}