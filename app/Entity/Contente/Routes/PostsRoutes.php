<?php

namespace app\Entity\Contente\Routes;

use app\Entity\Contente\Controllers\PostsController;
use app\Framework\App;

return function(App $app): void
{
	$app->get("/", [PostsController::class, "postsView"]);
};