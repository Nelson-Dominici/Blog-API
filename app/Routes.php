<?php

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

$app->group("/api", function(Group $group): void {

	$group->group("/v1/users", function(Group $group): void {
		require_once("Modules/User/UserRouter.php");
		require_once("Modules/Auth/AuthRouter.php");
	});

	$group->group("/v1/posts", function(Group $group): void {
		require_once("Modules/Post/PostRouter.php");
		require_once("Modules/Comment/CommentRouter.php");
	}); 

});	