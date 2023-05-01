<?php

namespace app\Utils;

class AppException extends \Exception{

	public function __construct(
		private String $data,
		private Int $status

	){}

	public function sendException(): void{

		header("Content-Type: application/json; charset=utf-8");
		
		http_response_code($this->status);

		$json = [
			"success" => false,
			"data" => ["message" => $this->data]
		];

		echo json_encode($json);
		exit();
	}

}