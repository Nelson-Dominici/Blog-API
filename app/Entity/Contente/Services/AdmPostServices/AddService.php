<?php

namespace app\Entity\Contente\Services\AdmPostServices;

use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class AddService
{
	
	private static function validData($req, array $reqBody): void
	{

		if (
			!array_key_exists("title", $reqBody) ||
			!$reqBody["title"]
		
		) throw new HttpBadRequestException($req, "Title required");
	
		else if (
			!array_key_exists("postContente", $reqBody) ||
			!$reqBody["postContente"]

		) throw new HttpBadRequestException($req, "Post contente is Invalid");

	}	

	public static function add($req): void
	{
		$reqBody = $req->getParsedBody();

		self::validData($req, $reqBody);

		$sql = "INSERT INTO posts (title, post_date, contente) VALUES (?, ?, ?)";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $reqBody["title"]);
		$pdo->bindValue(2, date("j F Y"));
		$pdo->bindValue(3, $reqBody["postContente"]);
		$pdo->execute();
	}
}