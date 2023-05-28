<?php

namespace app\Entity\Contente\Routes;

use app\Entity\Contente\Controllers\PostsController;
use app\Utils\Middleware\CheckTokenCookie;
use app\Framework\App;

return function(App $app): void
{

	$app->get("/home",
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "home"]
	);

	$app->get("/post/:id", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "seePost"]
	);

	$app->get("/postAdm", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "postAdm"]
	);

	$app->post("/addPost", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "addPost"]
	);

	$app->delete("/deletePost/:postId", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "deletePost"]
	);

	$app->get("/getPosts", 
		[CheckTokenCookie::class, "check"],
		[PostsController::class, "getPosts"]
	);

};