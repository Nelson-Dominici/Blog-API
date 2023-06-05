<?php

namespace app\Entity\Contente\Routes;

use Slim\Routing\RouteCollectorProxy;
use app\Entity\Contente\Controllers\UserPostController;

return function($app): void
{

	$app->get("/home", [UserPostController::class, "homeView"]);

	$app->group("/post", function(RouteCollectorProxy $group){

		$group->get("/getPosts", [UserPostController::class, "get"]);
		$group->get("/read/{postId}", [UserPostController::class, "read"]);

	});

};