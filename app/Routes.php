<?php

namespace app;
use app\Framework\App;

return function(App $app): void
{
	$userAccountRouter = require_once("Entity/User/Routes/UserAccountRouter.php");
	$postsRoutes = require_once("Entity/Contente/Routes/PostsRoutes.php");
	
	$userAccountRouter($app);
	$postsRoutes($app);
	
	header("Location: /");
};