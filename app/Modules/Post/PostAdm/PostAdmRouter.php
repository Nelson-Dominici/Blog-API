<?php

namespace app\Modules\Post\PostAdm;

$group->post("/addPost", [PostAdmController::class, "addPost"]);
$group->delete("/delete/{postUuid}", [PostAdmController::class, "deletePost"]);