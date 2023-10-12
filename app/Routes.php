<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/api", function(RouteCollectorProxy $group): void {

	$group->group("/v1/users", function(RouteCollectorProxy $group): void {
		require_once("Modules/User/Router.php");
	});

	$group->group("/v1/posts", function(RouteCollectorProxy $group): void {
		require_once("Modules/Post/Router.php");
		require_once("Modules/Comment/Router.php");
	}); 

});	