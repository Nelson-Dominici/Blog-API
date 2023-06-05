<?php

namespace app\Entity\User\Controllers;

use app\Utils\SendJson;
use app\Utils\RenderView;
use app\Entity\User\Services\UserAccountServices\LoginService;
use app\Entity\User\Services\UserAccountServices\RegisterService;

class UserAccountController
{

	public static function login($req, $res)
	{

		LoginService::execute($req);
		return SendJson::send(["success" => true ]);

	}

	public static function register($req, $res)
	{

		RegisterService::execute($req);
		return SendJson::send(["success" => true ]);
	}

	public static function loginView($req, $res)
	{
		
		RenderView::view("Templates/user/userAccount/form/login");
		return $res->withStatus(200);
	}

	public static function registerView($req, $res)
	{

		RenderView::view("Templates/user/userAccount/form/register");
		return $res->withStatus(200);
	}

}