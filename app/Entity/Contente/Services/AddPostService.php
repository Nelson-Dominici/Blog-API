<?php

namespace app\Entity\Contente\Services;
use app\Utils\AppException;

class AddPostService
{
	
	private static function validData($reqBody){

		if(!array_key_exists("title", $reqBody)){
			throw new AppException("Title required", 400);
	
		}else if(!array_key_exists("postContente", $reqBody)){
			throw new AppException("Post contente is Invalid", 400);
		}
	}	

	public static function add($reqBody){

		self::validData($reqBody);

	}

}