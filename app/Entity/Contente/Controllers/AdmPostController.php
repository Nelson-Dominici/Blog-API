<?php

namespace app\Entity\Contente\Controllers;

use app\Utils\SendJson;
use app\Utils\RenderView;
use app\Entity\Contente\Services\AdmPostServices\AddService;
use app\Entity\Contente\Services\AdmPostServices\DeleteService;

class AdmPostController
{

	public static function postAdmView($req, $res)
	{
	
		if($req->getAttribute("payload")->adm){

			RenderView::view("Templates/contente/admPost/postAdm/template");
			return $res->withStatus(200);
		}
        
        return $res->withHeader("Location", "/home")->withStatus(302);
	}

	public static function add($req, $res)
	{

		if($req->getAttribute("payload")->adm){
		
			AddService::add($req);
			return SendJson::send(["success" => true ]);

		}
        
        return $res->withHeader("Location", "/home")->withStatus(302);
	}

	public static function delete($req, $res, $args)
	{

		if($req->getAttribute("payload")->adm){

			DeleteService::delete($req, $args);
			return SendJson::send(["success" => true ]);

		}
        
        return $res->withHeader("Location", "/home")->withStatus(302);
	}
}