<?php

namespace app\Entity\User\Routes;

use app\Entity\User\Controllers\UserAccountController;
use app\Framework\App;

return function(App $app): void
{
	$app->get("/user/login", [UserAccountController::class, "loginView"]);
	$app->get("/user/register", [UserAccountController::class, "registerView"]);

	$app->post("/user/", [UserAccountController::class, "login"]);
	$app->post("/user/register", [UserAccountController::class, "register"]);
};