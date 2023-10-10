<?php

namespace app\Helpers;

use Slim\Psr7\Response;

trait ApiResponseTrait
{
	public function success(mixed $data = false, int $statusCode = 200): Response
	{
		$res = new Response();

		if (!$data) {
			
			$res->getBody()->write(json_encode([
				'success' => true,
				'data' => $data
			]));
		}

		return $res
				->withHeader("Content-Type", "application/json")
				->withStatus($statusCode);
	}

	public function error(string $message, int $statusCode = 400): Response
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