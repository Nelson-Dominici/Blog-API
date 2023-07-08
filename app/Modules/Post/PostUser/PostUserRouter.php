<?php

namespace app\Modules\Post\PostUser;

$group->get("/getPosts", [PostUserController::class, "getPosts"]);
$group->get("/infos/{postUuid}", [PostUserController::class, "getPostInfos"]);