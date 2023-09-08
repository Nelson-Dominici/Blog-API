<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/posts", function(RouteCollectorProxy $group): void
{

	require_once("Modules/Post/Router.php");

	$group->group("", function(RouteCollectorProxy $group): void
	{

		require_once("Modules/Adm/Router.php");

	})->add(new \app\Middlewares\AuthenticateReqToken());	

	$group->group("/comments", function(RouteCollectorProxy $group): void
	{

		require_once("Modules/Comment/Router.php");

	});	

});

$app->group("/users", function(RouteCollectorProxy $group): void
{

	require_once("Modules/User/Router.php");

});	