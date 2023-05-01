<?php

namespace app\Entity\User\Services;

use app\Utils\AppException;
use app\DataBase\ConnectDB;
use Ramsey\Uuid\Uuid;

class RegisterService
{
	private static function validData($reqBody){
		
		if(!array_key_exists("name", $reqBody)){
			throw new AppException("Name is required", 400);
		}

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

	public static function execute($reqBody){

		self::validData($reqBody);

		$sql = "SELECT * FROM user WHERE email = :e";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(":e", $reqBody["email"]);
		$pdo->execute();

		if($pdo->rowCount() > 0){
			throw new AppException("Email already registered", 400);
		}

		$sql = "INSERT INTO user (name, email, uuid, password) VALUES (?, ?, ?, ?)";

		$pdo = ConnectDB::connect()->prepare($sql);

		$pdo->bindValue(1, $reqBody["name"]);
		$pdo->bindValue(2, $reqBody["email"]);
		$pdo->bindValue(3, Uuid::uuid4()->toString());
		$pdo->bindValue(4, password_hash($reqBody["password"], PASSWORD_DEFAULT));
		$pdo->execute();
	}
}