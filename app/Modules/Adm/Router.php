<?php

namespace app\Modules\Adm;
use Slim\Routing\RouteCollectorProxy;

$group->post("", [Controller::class, "store"]);
$group->delete("/{postUuid}", [Controller::class, "destroy"]);

$group->group("/edit", function(RouteCollectorProxy $group)
{

	$group->patch("/title", [Controller::class, "editTitle"]);
	$group->patch("/contente", [Controller::class, "editContente"]);

});