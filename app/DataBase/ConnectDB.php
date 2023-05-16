<?php

namespace app\DataBase;
use app\Utils\AppException;

class ConnectDB
{
	private static $connection;

	public static function connect(){

		if(!isset(self::$connection)){
			try {
				self::$connection = new \PDO(
					"mysql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_NAME"], $_ENV["DB_USER"], 
					$_ENV["DB_PASSWORD"]);
			
			} catch (\PDOException $e) {
				throw new AppException("Something Went Wrong", 500);
			}

		}
			
		return self::$connection;
	}
}