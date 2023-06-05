<?php

namespace app\Utils;

class ConnectDB
{
	private static $connection;

	public static function connect()
	{

		if (!isset(self::$connection)){

			self::$connection = new \PDO(
				"mysql:host=".$_ENV["DB_HOST"].";
				dbname=".$_ENV["DB_NAME"], 
				$_ENV["DB_USER"], 
				$_ENV["DB_PASSWORD"]
			);
		}
			
		return self::$connection;
	}
}