<?php

namespace app\Entity\Contente\Services;

use app\Utils\AppException;
use app\DataBase\ConnectDB;

class DeletePostService
{
	
	private static function validData($urlParams): void{

		if (
			!array_key_exists("postId", $urlParams) ||
			!$urlParams["postId"]
		){
			throw new AppException("Post id is required", 400);
		}
	}	

	public static function delete($urlParams): void{

		self::validData($urlParams);

		$sql = "DELETE FROM posts WHERE id = ?";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $urlParams["postId"]);
		$pdo->execute();

		if ($pdo->rowCount() <= 0) {
			throw new AppException("Post uuid not found", 400);
		}
	}
}