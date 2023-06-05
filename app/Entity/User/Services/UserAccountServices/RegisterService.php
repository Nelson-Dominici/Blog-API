<?php

namespace app\Entity\User\Services\UserAccountServices;

use Ramsey\Uuid\Uuid;
use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class RegisterService
{
	private static function validData($req, array $reqBody)
	{
		
		if (!array_key_exists("name", $reqBody))
			throw new HttpBadRequestException($req, "Name is required");

		if (
			!array_key_exists("email", $reqBody) ||
			!filter_var($reqBody["email"], FILTER_VALIDATE_EMAIL)
		
		) throw new HttpBadRequestException($req, "Email is Invalid");

		else if (
			!array_key_exists("password", $reqBody) || 
			strlen($reqBody["password"]) < 6

		) throw new HttpBadRequestException($req, "Password must be greater than 6 characters");
	}

	public static function execute($req)
	{

		$reqBody = $req->getParsedBody();

		self::validData($req, $reqBody);

		$sql = "SELECT * FROM user WHERE email = :e";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(":e", $reqBody["email"]);
		$pdo->execute();

		if ($pdo->rowCount() > 0)
			throw new HttpBadRequestException($req, "Email already registered");

		$sql = "INSERT INTO user (name, email, uuid, password) VALUES (?, ?, ?, ?)";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $reqBody["name"]);
		$pdo->bindValue(2, $reqBody["email"]);
		$pdo->bindValue(3, Uuid::uuid4());
		$pdo->bindValue(4, password_hash($reqBody["password"], PASSWORD_DEFAULT));
		$pdo->execute();
	}
}