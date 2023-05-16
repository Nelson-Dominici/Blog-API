<?php

namespace app\Entity\Contente\Controllers;

use app\Framework\Modules\Route\Services\Request\GetReq as Request;
use app\Framework\Modules\Route\Services\Response\GetRes as Response;

use app\Entity\Contente\Services\RegisterService;
use app\Entity\Contente\Services\LoginService;
use app\Utils\RenderView;

class PostsController
{

	public static function postsView(Request $req, Response $res){
		
		RenderView::view("Templates/Contente/posts/allPosts");
	}

}