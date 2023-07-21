<?php

namespace app\Modules\Post\PostUser;

$group->get("/all", [PostUserController::class, "getPosts"]);

$group->get(
	"/infos/{postUuid}", 
	[PostUserController::class, "getPostInfos"]
);