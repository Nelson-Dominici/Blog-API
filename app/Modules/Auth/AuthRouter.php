<?php

namespace app\Modules\Auth;

$group->post("/login", [AuthController::class, "login"]);
$group->post("/me/verify", [AuthController::class, "checkJWT"]);