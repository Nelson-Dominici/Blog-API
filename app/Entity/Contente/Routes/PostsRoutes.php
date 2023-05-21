<?php

namespace app\Entity\Contente\Routes;

use app\Entity\Contente\Controllers\PostsController;
use app\Utils\Middleware\CheckTokenCookie;
use app\Framework\App;

return function(App $app): void
{
	$app->get("/home", [PostsController::class, "allPostsView"]);

	$app->get("/addPost", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "addPostView"]
	);

	$app->post("/addPost", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "addPost"]
	);
};