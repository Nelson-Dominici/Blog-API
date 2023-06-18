<?php

namespace app\Entity\User\Account\Services;

use Ramsey\Uuid\Uuid;
use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class RegisterService
{

	public static function execute($req)
	{

		$reqBody = $req->getParsedBody();

		$sql = "SELECT * FROM users WHERE email = :e";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(":e", $reqBody["email"]);
		$pdo->execute();

		if ($pdo->rowCount() > 0)
			throw new HttpBadRequestException($req, "Email already registered");

		$sql = "INSERT INTO users (name, email, userUuid, password) VALUES (?, ?, ?, ?)";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $reqBody["name"]);
		$pdo->bindValue(2, $reqBody["email"]);
		$pdo->bindValue(3, Uuid::uuid4());
		$pdo->bindValue(4, password_hash($reqBody["password"], PASSWORD_DEFAULT));
		$pdo->execute();
	}
}