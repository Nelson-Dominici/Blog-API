<?php

namespace app\Entity\User\Services;

use app\Utils\AppException;
use app\DataBase\ConnectDB;
use Firebase\JWT\JWT;

class LoginService
{
	private static function validData($reqBody){

		if(
			!array_key_exists("email", $reqBody) ||
			!filter_var($reqBody["email"], FILTER_VALIDATE_EMAIL)
		){
			throw new AppException("Email is Invalid", 400);
		}

		else if(
			!array_key_exists("password", $reqBody) || 
			strlen($reqBody["password"]) < 6
		){
			throw new AppException("password must be greater than 6 characters", 400);
		}
	}

	public static function execute(array $reqBody){
		
		self::validData($reqBody);

		$sql = "SELECT * FROM user WHERE email = :email";

		$pdo = ConnectDB::connect()->prepare($sql);
		$pdo->bindValue(":email", $reqBody["email"]);
		$pdo->execute();

		if($pdo->rowCount() < 1)
			throw new AppException("Password or Email are incorrect", 400);

		$user = $pdo->fetch(\PDO::FETCH_ASSOC);

		if(!password_verify($reqBody["password"], $user["password"]))
			throw new AppException("Password or Email are incorrect", 400);

		$payload = [
		    "uuid" => $user["uuid"],
		    "exp" => time() + (8 * 24 * 60 * 60)
		];

		$jwt = JWT::encode($payload, $_ENV["JWT_KEY"], "HS256");

		return $jwt;
	}
}