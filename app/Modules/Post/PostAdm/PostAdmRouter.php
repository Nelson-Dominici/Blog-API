<?php

namespace app\Modules\Post\PostAdm;
use Slim\Routing\RouteCollectorProxy;

$group->post("/addPost", [PostAdmController::class, "addPost"]);

$group->delete(
	"/delete/{postUuid}", 
	[PostAdmController::class, "deletePost"]
);

$group->group("/edit", function(RouteCollectorProxy $group)
{

	$group->patch("/title", [PostAdmController::class, "editPostTitle"]);
	
	$group->patch(
		"/contente", [PostAdmController::class, "editPostContente"]
	);

});