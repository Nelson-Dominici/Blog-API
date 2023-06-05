<?php

use app\Utils\SendJson;
use Slim\Exception\HttpBadRequestException;

return function ($request, Throwable $exception)
{
	
	$res = new Slim\Psr7\Response();

	if ($exception instanceof HttpBadRequestException) {

		return SendJson::send([
			"success" => false,
			"data" => ["message" => $exception->getMessage()]
		], 400);
    }

   	if ($exception instanceof \PDOException) {

		return SendJson::send([
			"success" => false,
			"data" => ["message" => "Fatal error"]
		], 500);
    }


	return $res->withHeader("Location", "/home")->withStatus(302);
};