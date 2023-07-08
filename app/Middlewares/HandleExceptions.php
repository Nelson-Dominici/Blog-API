<?php

namespace app\Middlewares;

use Slim\Psr7\Response;
use app\Helpers\SendJson;
use app\Helpers\AppException;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;

class HandleExceptions
{

    public function __invoke(Request $request, \Throwable $exception): Response
    {

		if ($exception instanceof AppException) {

			return SendJson::send([
				"success" => false,
				"data" => ["message" => $exception->getAppMessage()]
			], $exception->getStatusCode());
	    }

	   	if ($exception instanceof NestedValidationException) {

			return SendJson::send([
				"success" => false,
				"data" => ["message" => array_values($exception->getMessages())[0]]
			], 400);
	    }

	    var_dump($exception);
	    return $res;
		// return $this->sendJson([
		// 	"success" => false,
		// 	"data" => ["message" => "Fatal Error"]
		// ], 500);    

   }

}