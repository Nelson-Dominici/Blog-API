<?php

use Slim\App;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function($app) {
	$app->group("/api", function(Group $group): void {

		$group->group("/v1/users", function(Group $group): void {
			$userRouter = require_once("Modules/User/UserRouter.php");
			$authRouter = require_once("Modules/Auth/AuthRouter.php");
			
			$userRouter($group);
			$authRouter($group);
		});

		$group->group("/v1/posts", function(Group $group): void {
			$postRouter = require_once("Modules/Post/PostRouter.php");
			$commentRouter = require_once("Modules/Comment/CommentRouter.php");
		
			$postRouter($group);
			$commentRouter($group);
		}); 

	});	
};