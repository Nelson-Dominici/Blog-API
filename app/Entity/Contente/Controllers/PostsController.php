<?php

namespace app\Entity\Contente\Controllers;

use app\Framework\Modules\Route\Services\Request\GetReq as Request;
use app\Framework\Modules\Route\Services\Response\GetRes as Response;

use app\Entity\Contente\Services\SeePostService;
use app\Entity\Contente\Services\AddPostService;
use app\Entity\Contente\Services\GetPostsService;
use app\Entity\Contente\Services\DeletePostService;
use app\Utils\RenderView;

class PostsController
{

	public static function home(Request $req, Response $res): void{
		
		RenderView::view("Templates/Contente/posts/home");
	}

	public static function postAdm(Request $req, Response $res): void{
	
		if($req->middlewareData["payload"]->adm){

			RenderView::view("Templates/Contente/posts/postAdm");
			
		}else{
			header("Location: /home");
		}
	}

	public static function addPost(Request $req, Response $res): void{

		if($req->middlewareData["payload"]->adm){
		
			AddPostService::add($req->body);

			$res->status(200)->sendJson([
				"success" => true
			]);

		}else{
			header("Location: /home");
		}
	}

	public static function deletePost(Request $req, Response $res): void{

		if($req->middlewareData["payload"]->adm){

			DeletePostService::delete($req->urlParams);

			$res->status(200)->sendJson([
				"success" => true
			]);

		}else{
			header("Location: /home");
		}
	}

	public static function getPosts(Request $req, Response $res): void{

		$posts = GetPostsService::get($req->queryParams);

		$res->status(200)->sendJson([
			"success" => true,
			"data" => $posts
		]);

	}

	public static function seePost(Request $req, Response $res): void{

		$postContente = SeePostService::execute($req->urlParams);

		if(!$postContente){
			header("Location: /home");

		}else{
			RenderView::view("Templates/Contente/posts/post", $postContente);	
		}
	}
}