<?php

namespace app\Helpers;
use Slim\Psr7\Response;

class SendJson
{

	static public function send(array $data, int $statusCode = 200): Response
	{

		$res = new Response();

		$res->getBody()->write(json_encode($data));
		return $res
				->withHeader("Content-Type", "application/json")
				->withStatus($statusCode);

	}
	
}