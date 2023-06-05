<?php

namespace app\Utils;
use Slim\Psr7\Response;

class SendJson
{
	public static function send(array $data, int $statusCode = 200)
	{

		$res = new Response();
		
		$res->getBody()->write(json_encode($data));

		return $res->withHeader("Content-Type", "application/json")
		->withStatus($statusCode);
	}
}