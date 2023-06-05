<?php

namespace app\Entity\Contente\Routes;

use Slim\Routing\RouteCollectorProxy;
use app\Entity\Contente\Controllers\AdmPostController;

$checkTokenCookie = require_once("app/Middlewares/checkTokenCookie.php");

return function($app) use ($checkTokenCookie): void
{

	$app->group("/post", function(RouteCollectorProxy $group){

		$group->post("/addPost", [AdmPostController::class, "add"]);
		$group->get("/adm", [AdmPostController::class, "postAdmView"]);
		$group->delete("/delete/{postId}", [AdmPostController::class, "delete"]);

	})->add($checkTokenCookie);

};