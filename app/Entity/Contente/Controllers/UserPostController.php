<?php

namespace app\Entity\Contente\Controllers;

use app\Utils\SendJson;
use app\Utils\RenderView;
use app\Entity\Contente\Services\UserPostServices\GetService;
use app\Entity\Contente\Services\UserPostServices\ReadService;

class UserPostController
{

	public static function homeView($req, $res)
	{
		
		RenderView::view("Templates/contente/userPost/home/template");
		return $res->withStatus(200);
	}

	public static function get($req, $res)
	{

		$posts = GetService::get($req->getQueryParams());
		
		return SendJson::send([
		    "success" => true,
			"data" => $posts
		]);
		
	}

	public static function read($req, $res, $args)
	{

		$postContente = ReadService::read($args);

		if($postContente){
			RenderView::view("Templates/contente/userPost/post/template", 
			$postContente);
			return $res->withStatus(200);
		}
		
		return $res->withHeader("Location", "/home")->withStatus(302);
	}
}