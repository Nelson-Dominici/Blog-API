<?php

namespace app;
use app\Framework\App;

return function(App $app): void
{
	$userAccountRouter = require_once("Entity/User/Routes/UserAccountRouter.php");
	$userAccountRouter($app);
};