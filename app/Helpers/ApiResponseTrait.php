<?php

namespace app\Helpers;

use Slim\Psr7\Response;

trait ApiResponseTrait
{
	protected function jsonResponse(array $data = [], int $statusCode = 200): Response
	{
		$res = new Response();

		$res->getBody()->write(json_encode($data));

		return $res
				->withHeader("Content-Type", "application/json")
				->withStatus($statusCode);
	}
}