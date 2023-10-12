<?php

namespace app\Helpers;

use Slim\Psr7\Response;

trait ApiResponseTrait
{
	protected function success(mixed $data = false, int $statusCode = 200): Response
	{
		$res = new Response();

		$data = !$data 
			? ['success' => true]
			: ['success' => true, 'data' => $data];

		$res->getBody()->write(json_encode($data));

		return $res
				->withHeader("Content-Type", "application/json")
				->withStatus($statusCode);
	}

	protected function error(string $message, int $statusCode = 400): Response
	{
		$res = new Response();

		$res->getBody()->write(json_encode([
			'success' => false,
			'error' => $message
		]));

		return $res
				->withHeader("Content-Type", "application/json")
				->withStatus($statusCode);
	}
}