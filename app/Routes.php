<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/api", function(RouteCollectorProxy $group): void {

	$group->group("/v1/users", function(RouteCollectorProxy $group): void {
		require_once("Modules/User/UserRouter.php");
	});

	$group->group("/v1/posts", function(RouteCollectorProxy $group): void {
		require_once("Modules/Post/PostRouter.php");
		require_once("Modules/Comment/CommentRouter.php");
	}); 

});	