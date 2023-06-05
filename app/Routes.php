<?php

return function($app): void
{
	$userAccountRouter = require_once("Entity/User/Routes/UserAccountRouter.php");
	$userPostRoutes = require_once("Entity/Contente/Routes/UserPostRoutes.php");
	$admPostRouter = require_once("Entity/Contente/Routes/AdmPostRouter.php");
	
	$userAccountRouter($app);
	$userPostRoutes($app);
	$admPostRouter($app);
	
};