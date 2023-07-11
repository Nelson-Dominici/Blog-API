<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/post", function(RouteCollectorProxy $group): void
{

	require_once("Modules/Post/PostUser/PostUserRouter.php");

	$group->group("/adm", function(RouteCollectorProxy $group): void
	{

		require_once("Modules/Post/PostAdm/PostAdmRouter.php");

	})->add(new \app\Middlewares\AuthenticateReqToken());	

	$group->group("/comment", function(RouteCollectorProxy $group): void
	{

		require_once("Modules/Post/Comment/PostCommentRouter.php");

	});	

});

$app->group("/user", function(RouteCollectorProxy $group): void
{

	$group->group("/account", function($group): void
	{

		require_once("Modules/User/Account/UserAccountRouter.php");
		
	});

});	