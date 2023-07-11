<?php

namespace app\Helpers;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

class EntityManagerHelper
{
	
	public static function getEntityManager(): EntityManager
	{

		$config = ORMSetup::createAttributeMetadataConfiguration(
		   paths: [dirname(__DIR__).DIRECTORY_SEPARATOR."/Entitys"],
		   isDevMode: true,
		);

		$connectionDB = DriverManager::getConnection([
		    "dbname" => $_ENV["DB_NAME"],
		    "user" => $_ENV["DB_USER"],
		    "password" => $_ENV["DB_PASSWORD"],
		    "host" => $_ENV["DB_HOST"],
		    "driver" => "pdo_mysql",
		]);

        return new EntityManager($connectionDB, $config);

	}

}