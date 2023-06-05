<?php

namespace app\Entity\User\Services\UserAccountServices;

use Firebase\JWT\JWT;
use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class LoginService
{
	private static function validData(array $reqBody, $req)
	{

		if (
			!array_key_exists("email", $reqBody) ||
			!filter_var($reqBody["email"], FILTER_VALIDATE_EMAIL)

		) throw new HttpBadRequestException($req, "Email is Invalid");

		else if (
			!array_key_exists("password", $reqBody) || 
			strlen($reqBody["password"]) < 6
		
		) throw new HttpBadRequestException($req, 
			"Password must be greater than 6 characters"
		);
	}

	public static function execute($req)
	{
		
		$reqBody = $req->getParsedBody();
		
		self::validData($reqBody, $req);

		$sql = "SELECT * FROM user WHERE email = :email";

		$pdo = ConnectDB::connect()->prepare($sql);
		$pdo->bindValue(":email", $reqBody["email"]);
		$pdo->execute();

		$msg = "Password or Email are incorrect";

		if ($pdo->rowCount() < 1)
			throw new HttpBadRequestException($req, $msg);

		$user = $pdo->fetch(\PDO::FETCH_ASSOC);

		if (!password_verify($reqBody["password"], $user["password"]))
			throw new HttpBadRequestException($req, $msg);

		$payload = [
		    "uuid" => $user["uuid"],
		    "adm" => $user["adm"],
		    "exp" => time() + (8 * 24 * 60 * 60)
		];

		$jwt = JWT::encode($payload, $_ENV["JWT_KEY"], "HS256");

		setcookie("token", $jwt, time() + (8 * 24 * 60 * 60), "/");
	}
}