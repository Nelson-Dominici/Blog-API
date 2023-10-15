<?php

namespace app\Middlewares;

use app\Helpers\{
	AppException, 
	ApiResponseTrait
};


use Slim\Psr7\Response;

use Firebase\JWT\JWTException;

use Psr\Http\Message\ServerRequestInterface as Request;

use Respect\Validation\Exceptions\NestedValidationException;

class HandleExceptions
{
	use ApiResponseTrait;

    public function __invoke(Request $request, \Throwable $exception): Response
    {
		if ($exception instanceof AppException) {

			return $this->jsonResponse([
				"success" => false,
				"error" => $exception->getAppMessage()
			], $exception->getStatusCode());
	    }

	   	if ($exception instanceof NestedValidationException) {

			return $this->jsonResponse([
				"success" => false,
				"error" => array_values($exception->getMessages())[0]
			], 400);
	    }

	    var_dump($exception);
		// return $this->error("Fatal Error", 500);
   }
}