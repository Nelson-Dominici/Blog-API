<?php

namespace app\Helpers;

class AppException extends \Exception 
{
	function __construct( 
		protected string $appMessage, 
		protected int $statusCode = 400 
	){}

	public function getAppMessage(): string
	{
		return $this->appMessage;
	}

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}
}