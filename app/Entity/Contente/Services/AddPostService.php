<?php

namespace app\Entity\Contente\Services;

use app\Utils\AppException;
use app\DataBase\ConnectDB;

class AddPostService
{
	
	private static function validData($reqBody): void{

		if(
			!array_key_exists("title", $reqBody) ||
			!$reqBody["title"]
		){
			throw new AppException("Title required", 400);
	
		}else if(
			!array_key_exists("postContente", $reqBody) ||
			!$reqBody["postContente"]
		){
			throw new AppException("Post contente is Invalid", 400);
		}
	}	

	public static function add($reqBody): void{

		self::validData($reqBody);

		$sql = "INSERT INTO posts (title, post_date, contente) VALUES (?, ?, ?)";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $reqBody["title"]);
		$pdo->bindValue(2, date("j F Y"));
		$pdo->bindValue(3, $reqBody["postContente"]);
		$pdo->execute();
	}
}