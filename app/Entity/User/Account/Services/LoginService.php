<?php

namespace app\Entity\User\Account\Services;

use Firebase\JWT\JWT;
use app\Utils\ConnectDB;
use Slim\Exception\HttpBadRequestException;

class LoginService
{

	public static function execute($req)
	{
		
		$reqBody = $req->getParsedBody();
		
		$sql = "SELECT * FROM users WHERE email = :email";

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
		    "userUuid" => $user["userUuid"],
		    "name" => $user["name"],
		    "adm" => $user["adm"],
		    "exp" => time() + (8 * 24 * 60 * 60)
		];

		$jwt = JWT::encode($payload, $_ENV["JWT_KEY"], "HS256");

		setcookie("token", $jwt, time() + (8 * 24 * 60 * 60), "/");
	}
}