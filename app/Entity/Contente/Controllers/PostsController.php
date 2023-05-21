<?php

namespace app\Entity\Contente\Controllers;

use app\Framework\Modules\Route\Services\Request\GetReq as Request;
use app\Framework\Modules\Route\Services\Response\GetRes as Response;

use app\Entity\Contente\Services\AddPostService;
use app\Utils\RenderView;

class PostsController
{

	public static function allPostsView(Request $req, Response $res){
		
		RenderView::view("Templates/Contente/posts/allPosts");
	}

	public static function addPostView(Request $req, Response $res){
	
		if($req->payload->adm){
			RenderView::view("Templates/Contente/posts/addPost");
		}else{
			header("Location: /home");
		}
	}

	public static function addPost(Request $req, Response $res){

		if($req->payload->adm){
			AddPostService::add($req->body);

			$res->status(200)->sendJson([
				"success" => true
			]);
		}else{
			header("Location: /home");
		}
	}
}