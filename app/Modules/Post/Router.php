<?php

namespace app\Modules\Post;

$group->get("", [Controller::class, "index"]);
$group->get("/{postUuid}", [Controller::class, "show"]);